await dv.view("_meta/Dataview/Scripts/resource_title", dv.current());
await dv.view("_meta/Dataview/Scripts/traits", dv.current());

dv.container.appendChild(document.createElement("hr"));

await dv.view("_meta/Dataview/Scripts/flavor_text", dv.current());

dv.container.appendChild(document.createElement("br"));