await dv.view("_meta/Dataview/scripts/gear_title", dv.current());
await dv.view("_meta/Dataview/scripts/traits", dv.current());
await dv.view("_meta/Dataview/scripts/uses", dv.current());

dv.container.appendChild(document.createElement("hr"));

await dv.view("_meta/Dataview/Scripts/flavor_text", dv.current());

dv.container.appendChild(document.createElement("br"));