const { Plugin, PluginSettingTab, Setting, Menu, setIcon } = require('obsidian');

const HIDEABLE_COLUMNS = [
  { id: 'status',    label: 'Status',    index: 4,    modalLabels: ['Status'] },
  { id: 'priority',  label: 'Priority',  index: 5,    modalLabels: ['Priority'] },
  { id: 'assignees', label: 'Assignees', index: 6,    modalLabels: ['Assignees'] },
  { id: 'due',       label: 'Due',       index: 7,    modalLabels: ['Due', 'Date'] },
  { id: 'progress',  label: 'Progress',  index: 8,    modalLabels: ['Progress'] },
  { id: 'time',      label: 'Time',      index: 9,    modalLabels: null },
  { id: 'start',     label: 'Start',     index: null, modalLabels: ['Start'] },
  { id: 'repeat',    label: 'Repeat',    index: null, modalLabels: ['Repeat'] },
];

const DEFAULT_SETTINGS = {
  enabled: true,
  filterGroups: [
    { label: 'Default', tags: [] }
  ],
  tagMode: 'any',
  hideGanttButton: false,
  hiddenColumns: [],
  skipSaveIfUnchanged: false,
};

class ProjectManagerTagCountPatch extends Plugin {
  async onload() {
    await this.loadSettings();
    this.projectManagerPlugin = null;
    this.patchRetryCount = 0;
    this.taskSnapshots = new Map();
    this.patchProjectManagerPlugin();
    this.setupTaskModalSnapshotPatch();

    if (this.app.workspace.on) {
      this.registerEvent(this.app.workspace.on('layout-change', () => { this.patchDashboardLeaves(); this.patchProjectLeaves(); }));
      this.registerEvent(this.app.workspace.on('active-leaf-change', () => { this.patchDashboardLeaves(); this.patchProjectLeaves(); }));
    }

    this.registerInterval(window.setInterval(() => this.patchProjectManagerPlugin(), 1000));
    this.addSettingTab(new TagCountPatchSettingTab(this.app, this));
    this.applyColumnCSS();
    this.setupModalObserver();
  }

  onunload() {
    if (this.projectManagerPlugin?.store) {
      const store = this.projectManagerPlugin.store;
      if (store.__pmDirtyCheckPatched) {
        delete store.updateTask;
        delete store.__pmDirtyCheckPatched;
      }
    }
    if (this.projectManagerPlugin) {
      this.projectManagerPlugin = null;
    }
    this.taskSnapshots = null;
    if (this._patchedTaskModalProto?.__pmRenderPatched) {
      this._patchedTaskModalProto.render = this._patchedTaskModalProto._pmOriginalRender;
      delete this._patchedTaskModalProto.__pmRenderPatched;
      delete this._patchedTaskModalProto._pmOriginalRender;
      this._patchedTaskModalProto = null;
    }
    const { Modal } = require('obsidian');
    if (Modal.prototype.__pmTaskSnapshotPatched && this._originalModalOpen) {
      Modal.prototype.open = this._originalModalOpen;
      delete Modal.prototype.__pmTaskSnapshotPatched;
      this._originalModalOpen = null;
    }
    document.getElementById('pm-patch-column-css')?.remove();
    this.modalObserver?.disconnect();
    this.modalObserver = null;
  }

  async loadSettings() {
    const raw = await this.loadData();
    const settings = Object.assign({}, DEFAULT_SETTINGS, raw);

    if (!settings.filterGroups && Array.isArray(raw?.filterTags)) {
      settings.filterGroups = [{ label: 'Default', tags: raw.filterTags }];
    }

    if (!Array.isArray(settings.filterGroups)) {
      settings.filterGroups = [{ label: 'Default', tags: [] }];
    }

    if (!Array.isArray(settings.hiddenColumns)) {
      settings.hiddenColumns = [];
    }

    this.settings = settings;
  }

  async saveSettings() {
    await this.saveData(this.settings);
    this.refreshAllDashboardCounts();
    this.applyColumnCSS();
    this.applyGanttButtonSetting();
    this.applyModalColumnHidingAll();
  }

  // --- Column visibility (table CSS) ---

  applyColumnCSS() {
    const id = 'pm-patch-column-css';
    let styleEl = document.getElementById(id);
    if (!styleEl) {
      styleEl = document.createElement('style');
      styleEl.id = id;
      document.head.appendChild(styleEl);
    }

    // Always hide the "Custom fields" heading and make its rows flush with regular fields.
    // The custom field rows sit inside an extra nested pm-modal-props (inside pm-modal-section
    // inside the outer pm-modal-props), giving them an extra 24px of horizontal padding.
    // Zeroing out the wrapper section and the inner pm-modal-props horizontal padding fixes that.
    const permanentCSS = [
      `.pm-task-modal .pm-modal-section > h4.pm-modal-section-title { display: none; }`,
      `.pm-task-modal .pm-modal-section:has(> h4.pm-modal-section-title) { border-top: none; padding: 0; }`,
      `.pm-task-modal .pm-modal-section:has(> h4.pm-modal-section-title) > .pm-modal-props { padding-left: 0; padding-right: 0; }`,
    ].join('\n');

    const hidden = this.settings.hiddenColumns || [];
    const columnCSS = hidden
      .map(colId => {
        const col = HIDEABLE_COLUMNS.find(c => c.id === colId);
        if (!col || col.index == null) return '';
        return `.pm-table th:nth-child(${col.index}), .pm-table td:nth-child(${col.index}) { display: none !important; }`;
      })
      .filter(Boolean)
      .join('\n');

    styleEl.textContent = permanentCSS + '\n' + columnCSS;
  }

  addColumnToggleButton(view) {
    if (!view || !view.containerEl) return;
    const toolbarRight = view.containerEl.querySelector('.pm-toolbar-right');
    if (!toolbarRight) return;
    if (toolbarRight.querySelector('.pm-patch-col-toggle')) return;

    const btn = toolbarRight.createEl('button', {
      cls: 'pm-patch-col-toggle clickable-icon',
      attr: { 'aria-label': 'Toggle columns' },
    });
    setIcon(btn, 'eye');

    btn.addEventListener('click', (evt) => {
      evt.stopPropagation();
      const menu = new Menu();
      for (const col of HIDEABLE_COLUMNS) {
        const isHidden = (this.settings.hiddenColumns || []).includes(col.id);
        menu.addItem(item =>
          item
            .setTitle(col.label)
            .setChecked(!isHidden)
            .onClick(async () => {
              if (!Array.isArray(this.settings.hiddenColumns)) this.settings.hiddenColumns = [];
              if (isHidden) {
                this.settings.hiddenColumns = this.settings.hiddenColumns.filter(c => c !== col.id);
              } else {
                this.settings.hiddenColumns.push(col.id);
              }
              await this.saveSettings();
            })
        );
      }
      menu.showAtMouseEvent(evt);
    });
  }

  // --- Column visibility (task edit modal) ---

  setupModalObserver() {
    let pending = false;
    this.modalObserver = new MutationObserver(() => {
      if (pending) return;
      pending = true;
      window.setTimeout(() => {
        pending = false;
        this.applyModalColumnHidingAll();
      }, 10);
    });
    this.modalObserver.observe(document.body, { childList: true, subtree: true });
  }

  applyModalColumnHidingAll() {
    const hidden = this.settings.hiddenColumns || [];
    const modals = document.querySelectorAll('.pm-task-modal');
    for (const modal of modals) {
      this.applyModalColumnHiding(modal, hidden);
    }
  }

  applyModalColumnHiding(modalEl, hidden) {
    if (!hidden) hidden = this.settings.hiddenColumns || [];

    for (const row of modalEl.querySelectorAll('.pm-prop-row')) {
      const labelEl = row.querySelector('.pm-prop-label');
      if (!labelEl) continue;
      const labelText = labelEl.textContent.trim();

      const shouldHide = hidden.some(colId => {
        const col = HIDEABLE_COLUMNS.find(c => c.id === colId);
        return col?.modalLabels?.includes(labelText);
      });

      row.style.display = shouldHide ? 'none' : '';
    }

    // Time tracking is a separate section, not a pm-prop-row
    for (const section of modalEl.querySelectorAll('.pm-modal-section')) {
      const title = section.querySelector('.pm-modal-section-title');
      if (title?.textContent.includes('Time tracking')) {
        section.style.display = hidden.includes('time') ? 'none' : '';
      }
    }
  }

  // --- Project view patching ---

  applyGanttButtonSetting() {
    const leaves = this.app.workspace.getLeavesOfType?.('pm-project') || [];
    for (const leaf of leaves) {
      const view = leaf.view;
      if (!view) continue;
      if (this.settings.hideGanttButton) {
        this.patchProjectLeaf(leaf);
      } else if (typeof view.renderProjectToolbar === 'function') {
        view.renderProjectToolbar();
      }
    }
  }

  patchProjectLeaves() {
    const leaves = this.app.workspace.getLeavesOfType?.('pm-project') || [];
    for (const leaf of leaves) {
      this.patchProjectLeaf(leaf);
    }
  }

  patchProjectLeaf(leaf) {
    const view = leaf.view;
    if (!view || typeof view.getViewType !== 'function') return;
    if (view.getViewType() !== 'pm-project') return;

    const viewCtor = view.constructor;
    if (!viewCtor.prototype.__pmGanttBtnPatched) {
      const originalRenderToolbar = viewCtor.prototype.renderProjectToolbar;
      if (typeof originalRenderToolbar === 'function') {
        const self = this;
        viewCtor.prototype.renderProjectToolbar = function (...args) {
          const result = originalRenderToolbar.apply(this, args);
          self.scheduleProjectPatch(this);
          return result;
        };
        viewCtor.prototype.__pmGanttBtnPatched = true;
      }
    }

    this.scheduleProjectPatch(view);
  }

  scheduleProjectPatch(view) {
    if (!view || view.__pmProjectPatchScheduled) return;
    view.__pmProjectPatchScheduled = true;
    window.setTimeout(() => {
      view.__pmProjectPatchScheduled = false;
      if (this.settings.hideGanttButton) {
        this.removeGanttButtonFromView(view);
      }
      this.addColumnToggleButton(view);
    }, 50);
  }

  removeGanttButtonFromView(view) {
    if (!view || !view.containerEl) return;
    const btn = view.containerEl.querySelector('.pm-view-btn[aria-label="Gantt"]');
    if (btn) btn.remove();
  }

  // --- Skip save if unchanged ---

  setupTaskModalSnapshotPatch() {
    const { Modal } = require('obsidian');
    if (Modal.prototype.__pmTaskSnapshotPatched) return;

    const self = this;
    const originalOpen = Modal.prototype.open;
    this._originalModalOpen = originalOpen;

    Modal.prototype.open = function () {
      const result = originalOpen.call(this);

      if (this.contentEl?.classList.contains('pm-task-modal') && this.task?.id) {
        // Snapshot the task for the dirty check (updatedAt intentionally excluded).
        self.taskSnapshots.set(this.task.id, JSON.parse(JSON.stringify(this.task)));

        // Patch render() on this modal's prototype so column hiding is applied
        // synchronously at the end of every re-render, before the browser paints.
        // This prevents the visible jump caused by the MutationObserver's 10ms delay.
        const proto = Object.getPrototypeOf(this);
        if (!proto.__pmRenderPatched) {
          const originalRender = proto.render;
          proto.render = function (...args) {
            const r = originalRender.apply(this, args);
            if (this.contentEl) {
              self.applyModalColumnHiding(this.contentEl, self.settings.hiddenColumns || []);
            }
            return r;
          };
          proto.__pmRenderPatched = true;
          proto._pmOriginalRender = originalRender;
          self._patchedTaskModalProto = proto;
        }
      }

      return result;
    };

    Modal.prototype.__pmTaskSnapshotPatched = true;
  }

  patchStore(store) {
    if (!store || store.__pmDirtyCheckPatched) return;

    const self = this;
    const originalUpdateTask = store.updateTask.bind(store);

    store.updateTask = async function (project, taskId, updates) {
      if (self.settings.skipSaveIfUnchanged) {
        const snapshot = self.taskSnapshots.get(taskId);
        self.taskSnapshots.delete(taskId);
        if (snapshot && !self.taskHasChanges(snapshot, updates)) {
          return;
        }
      }
      return originalUpdateTask(project, taskId, updates);
    };

    store.__pmDirtyCheckPatched = true;
  }

  taskHasChanges(snapshot, updates) {
    // Explicitly skip updatedAt/createdAt — PM stamps these on every save
    // and they must not influence the dirty check.
    const fields = [
      'title', 'description', 'status', 'priority', 'type',
      'assignees', 'tags', 'due', 'start', 'progress', 'completed',
      'recurrence', 'timeEstimate', 'timeLogs', 'dependencies',
      'customFields', 'archived',
    ];
    for (const field of fields) {
      if (!(field in updates)) continue;
      if (JSON.stringify(snapshot[field]) !== JSON.stringify(updates[field])) {
        return true;
      }
    }
    return false;
  }

  // --- Dashboard patching ---

  patchProjectManagerPlugin() {
    const pm = this.app.plugins.plugins['project-manager'];
    if (!pm) {
      if (this.patchRetryCount < 20) this.patchRetryCount += 1;
      return;
    }

    this.projectManagerPlugin = pm;
    this.patchDashboardLeaves();
    this.patchProjectLeaves();

    // Retry store patch each tick until it sticks (pm.store may not exist yet
    // on the very first detection if PM is still mid-load).
    if (pm.store) this.patchStore(pm.store);
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

    containerEl.createEl('h2', { text: 'Project Manager Patch' });

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
      .setName('Hide Gantt button')
      .setDesc('If enabled, removes the Gantt view button from project toolbars.')
      .addToggle((toggle) =>
        toggle
          .setValue(this.plugin.settings.hideGanttButton)
          .onChange(async (value) => {
            this.plugin.settings.hideGanttButton = value;
            await this.plugin.saveSettings();
          })
      );

    new Setting(containerEl)
      .setName('Only save tasks on actual changes')
      .setDesc('When enabled, closing the task editor without making any changes will not write to disk or update timestamps. Keeps git history clean.')
      .addToggle((toggle) =>
        toggle
          .setValue(this.plugin.settings.skipSaveIfUnchanged)
          .onChange(async (value) => {
            this.plugin.settings.skipSaveIfUnchanged = value;
            await this.plugin.saveSettings();
          })
      );

    containerEl.createEl('h3', { text: 'Column visibility' });
    containerEl.createEl('p', { text: 'Toggle columns in the project table and matching fields in the task editor. You can also click the eye button in any open project\'s toolbar.' });

    for (const col of HIDEABLE_COLUMNS) {
      const isHidden = (this.plugin.settings.hiddenColumns || []).includes(col.id);
      new Setting(containerEl)
        .setName(col.label)
        .addToggle(toggle =>
          toggle
            .setValue(!isHidden)
            .onChange(async (value) => {
              if (!Array.isArray(this.plugin.settings.hiddenColumns)) this.plugin.settings.hiddenColumns = [];
              if (!value) {
                if (!this.plugin.settings.hiddenColumns.includes(col.id)) {
                  this.plugin.settings.hiddenColumns.push(col.id);
                }
              } else {
                this.plugin.settings.hiddenColumns = this.plugin.settings.hiddenColumns.filter(c => c !== col.id);
              }
              await this.plugin.saveSettings();
            })
        );
    }

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
