const { Plugin, PluginSettingTab, Setting } = require('obsidian');

const DEFAULT_SETTINGS = {
  enabled: true,
  filterGroups: [
    { label: 'Default', tags: [] }
  ],
  tagMode: 'any'
};

class ProjectManagerTagCountPatch extends Plugin {
  async onload() {
    await this.loadSettings();
    this.projectManagerPlugin = null;
    this.patchRetryCount = 0;
    this.patchProjectManagerPlugin();

    if (this.app.workspace.on) {
      this.registerEvent(this.app.workspace.on('layout-change', () => this.patchDashboardLeaves()));
      this.registerEvent(this.app.workspace.on('active-leaf-change', () => this.patchDashboardLeaves()));
    }

    this.registerInterval(window.setInterval(() => this.patchProjectManagerPlugin(), 1000));
    this.addSettingTab(new TagCountPatchSettingTab(this.app, this));
  }

  onunload() {
    if (this.projectManagerPlugin) {
      this.projectManagerPlugin = null;
    }
  }

  async loadSettings() {
    const raw = await this.loadData();
    const settings = Object.assign({}, DEFAULT_SETTINGS, raw);

    if (!settings.filterGroups && Array.isArray(raw?.filterTags)) {
      settings.filterGroups = [
        {
          label: 'Default',
          tags: raw.filterTags,
        },
      ];
    }

    if (!Array.isArray(settings.filterGroups)) {
      settings.filterGroups = [
        { label: 'Default', tags: [] },
      ];
    }

    this.settings = settings;
  }

  async saveSettings() {
    await this.saveData(this.settings);
    this.refreshAllDashboardCounts();
  }

  patchProjectManagerPlugin() {
    if (this.projectManagerPlugin) {
      this.patchDashboardLeaves();
      return;
    }

    const pm = this.app.plugins.plugins['project-manager'];
    if (pm) {
      this.projectManagerPlugin = pm;
      this.patchDashboardLeaves();
      return;
    }

    if (this.patchRetryCount < 20) {
      this.patchRetryCount += 1;
    }
  }

  patchDashboardLeaves() {
    if (!this.projectManagerPlugin) {
      return;
    }

    const leaves = this.app.workspace.getLeavesOfType?.('pm-dashboard') || [];
    for (const leaf of leaves) {
      this.patchDashboardLeaf(leaf);
    }
  }

  patchDashboardLeaf(leaf) {
    const view = leaf.view;
    if (!view || typeof view.getViewType !== 'function') {
      return;
    }

    if (view.getViewType() !== 'pm-dashboard') {
      return;
    }

    const viewCtor = view.constructor;
    if (viewCtor.prototype.__pmTagCountPatched) {
      this.scheduleUpdateFromView(view);
      return;
    }

    const originalRender = viewCtor.prototype.render;
    const self = this;

    viewCtor.prototype.render = function (...args) {
      const result = originalRender.apply(this, args);
      self.scheduleUpdateFromView(this);
      return result;
    };

    viewCtor.prototype.__pmTagCountPatched = true;
    this.scheduleUpdateFromView(view);
  }

  scheduleUpdateFromView(view) {
    if (!view || view.__pmTagCountScheduled) {
      return;
    }

    view.__pmTagCountScheduled = true;
    window.setTimeout(async () => {
      view.__pmTagCountScheduled = false;
      await this.updateDashboardCounts(view);
    }, 30);
  }

  async refreshAllDashboardCounts() {
    const leaves = this.app.workspace.getLeavesOfType?.('pm-dashboard') || [];
    for (const leaf of leaves) {
      if (leaf.view) {
        await this.updateDashboardCounts(leaf.view);
      }
    }
  }

  async updateDashboardCounts(view) {
    if (!this.settings.enabled || !view || !view.bodyEl || !this.projectManagerPlugin) {
      return;
    }

    const cards = Array.from(view.bodyEl.querySelectorAll('.pm-project-card'));
    if (!cards.length) {
      return;
    }

    const projects = await this.projectManagerPlugin.store.loadAllProjects(this.projectManagerPlugin.settings.projectsFolder);
    if (!projects || !projects.length) {
      return;
    }

    const projectMap = new Map();
    const titleMap = new Map();

    for (const project of projects) {
      const key = this.projectKey(project);
      if (!projectMap.has(key)) {
        projectMap.set(key, project);
      }

      const title = (project.title || '').trim();
      if (title && !titleMap.has(title)) {
        titleMap.set(title, project);
      }
    }

    for (const card of cards) {
      const title = card.querySelector('.pm-project-card-title')?.textContent?.trim() || '';
      const icon = card.querySelector('.pm-project-card-icon')?.textContent?.trim() || '';
      const bar = card.querySelector('.pm-progress') || card.querySelector('.pm-progress-bar');
      const barColor = bar?.style?.background || card.querySelector('.pm-project-card-bar')?.style?.background || '';
      const key = `${title}||${icon}||${barColor}`;
      let project = projectMap.get(key) || titleMap.get(title);
      if (!project) {
        continue;
      }

      const groups = this.getFilterGroups();
      const sortedGroups = groups.sort((a, b) => a.label.localeCompare(b.label));
      const counts = sortedGroups.length
        ? sortedGroups.map((group) => ({
            label: group.label || 'Group',
            ...this.countProjectTaskTags(project.tasks, group.tags || []),
          }))
        : [{ label: 'Tasks', ...this.countProjectTaskTags(project.tasks, []) }];

      this.updateCardDisplay(card, counts);
    }
  }

  getFilterGroups() {
    return (this.settings.filterGroups || []).map((group) => ({
      label: String(group.label || 'Group').trim() || 'Group',
      tags: (Array.isArray(group.tags) ? group.tags : String(group.tags || '').split(','))
        .map((tag) => String(tag || '').trim().replace(/^#/, '').toLowerCase())
        .filter(Boolean),
    }));
  }

  projectKey(project) {
    const title = (project.title || '').trim();
    const icon = (project.icon || '').trim();
    const color = (project.color || '').trim();
    return `${title}||${icon}||${color}`;
  }

  countProjectTaskTags(tasks = [], filterTags = []) {
    let done = 0;
    let total = 0;

    for (const task of tasks || []) {
      const matchesTags = this.taskMatchesFilter(task, filterTags);
      if (matchesTags) {
        total += 1;
        if (task.status === 'done' || task.status === 'completed' || task.status === 'complete') {
          done += 1;
        }
      }

      if (Array.isArray(task.subtasks) && task.subtasks.length) {
        const subCounts = this.countProjectTaskTags(task.subtasks, filterTags);
        done += subCounts.done;
        total += subCounts.total;
      }
    }

    return { done, total };
  }

  taskMatchesFilter(task, filterTags) {
    if (!filterTags.length) {
      return true;
    }

    const taskTags = (task.tags || []).map((tag) => String(tag || '').trim().replace(/^#/, '').toLowerCase()).filter(Boolean);
    if (!taskTags.length) {
      return false;
    }

    if (this.settings.tagMode === 'all') {
      return filterTags.every((filterTag) => taskTags.includes(filterTag));
    }

    return filterTags.some((filterTag) => taskTags.includes(filterTag));
  }

  updateCardDisplay(card, counts) {
    const countEl = card.querySelector('.pm-project-card-tasks');

    if (countEl) {
      let filteredCounts = Array.isArray(counts)
        ? counts.filter((count) => count.total !== 0 || count.done !== 0)
        : [counts];

      if (Array.isArray(counts) && counts.length > 1) {
        if (!filteredCounts.length) {
          countEl.textContent = '';
          return;
        }

        countEl.innerHTML = filteredCounts
          .map((count) => `${count.label}: ${count.done}/${count.total}`)
          .join('<br>');
      } else {
        const count = Array.isArray(counts) ? counts[0] : counts;
        if (count.total === 0 && count.done === 0) {
          countEl.textContent = '';
          return;
        }
        countEl.textContent = `${count.done}/${count.total} tasks`;
      }
    }
  }
}

class TagCountPatchSettingTab extends PluginSettingTab {
  constructor(app, plugin) {
    super(app, plugin);
    this.plugin = plugin;
  }

  display() {
    const { containerEl } = this;
    containerEl.empty();

    containerEl.createEl('h2', { text: 'Project Manager Count Groups' });

    new Setting(containerEl)
      .setName('Enable patched counts')
      .setDesc('If enabled, dashboard counts will use the configured tag groups.')
      .addToggle((toggle) =>
        toggle
          .setValue(this.plugin.settings.enabled)
          .onChange(async (value) => {
            this.plugin.settings.enabled = value;
            await this.plugin.saveSettings();
          })
      );

    new Setting(containerEl)
      .setName('Tag match mode')
      .setDesc('Any = group tags match if a task has any listed tag. All = task must have every listed tag in the group.')
      .addDropdown((dropdown) =>
        dropdown
          .addOption('any', 'Any tag')
          .addOption('all', 'All tags')
          .setValue(this.plugin.settings.tagMode)
          .onChange(async (value) => {
            this.plugin.settings.tagMode = value;
            await this.plugin.saveSettings();
          })
      );

    containerEl.createEl('h3', { text: 'Count groups' });
    this.renderGroups(containerEl);

    new Setting(containerEl)
      .setName('Add group')
      .setDesc('Add a named tag group to count on each project card.')
      .addButton((button) =>
        button.setButtonText('Add group').onClick(async () => {
          this.plugin.settings.filterGroups.push({ label: 'New group', tags: [] });
          await this.plugin.saveSettings();
          this.display();
        })
      );
  }

  renderGroups(containerEl) {
    const groups = this.plugin.settings.filterGroups || [];
    groups.forEach((group, index) => {
      const groupContainer = containerEl.createDiv({ cls: 'pm-tag-count-group' });
      new Setting(groupContainer)
        .setName(`Group ${index + 1} label`)
        .setDesc('This label appears before the counts.')
        .addText((text) =>
          text
            .setValue(group.label)
            .onChange(async (value) => {
              this.plugin.settings.filterGroups[index].label = value;
              await this.plugin.saveSettings();
            })
        );

      new Setting(groupContainer)
        .setName('Tags')
        .setDesc('Comma-separated tags for this group, without the leading #.')
        .addText((text) =>
          text
            .setValue((group.tags || []).join(', '))
            .setPlaceholder('e.g. archetype, idea')
            .onChange(async (value) => {
              this.plugin.settings.filterGroups[index].tags = value
                .split(',')
                .map((tag) => tag.trim())
                .filter(Boolean);
              await this.plugin.saveSettings();
            })
        );

      new Setting(groupContainer)
        .addButton((button) =>
          button.setButtonText('Remove group').onClick(async () => {
            this.plugin.settings.filterGroups.splice(index, 1);
            await this.plugin.saveSettings();
            this.display();
          })
        );
    });

    if (!groups.length) {
      containerEl.createEl('p', { text: 'No groups configured yet. Add one to start counting tags separately.' });
    }
  }
}

module.exports = ProjectManagerTagCountPatch;
