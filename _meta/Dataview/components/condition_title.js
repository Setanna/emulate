let name = dv.current().file?.name ?? "Untitled";

let h1 = dv.el("h1", "");
h1.appendText(name);

await dv.view("_meta/Dataview/Scripts/traits", dv.current());

dv.container.appendChild(document.createElement("hr"));

await dv.view("_meta/Dataview/Scripts/flavor_text", dv.current());

dv.container.appendChild(document.createElement("br"));
