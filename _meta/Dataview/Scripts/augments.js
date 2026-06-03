let page = input;

function formatAugments(list) {
    if (!Array.isArray(list) || list.length === 0) return null;

    if (list.length === 1) return list[0];
    if (list.length === 2) return `${list[0]} and ${list[1]}`;

    return `${list.slice(0, -1).join(", ")} and ${list.at(-1)}`;
}

let augments = formatAugments(page.augments);

if (augments) {
    dv.el("div", `**Augments:** ${augments}`);
}