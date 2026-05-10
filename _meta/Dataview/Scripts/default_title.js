let page = input;

let value = page.value ?? 0;
let name = page.file?.name ?? "Untitled";

// If the value has a min and max write "min to max"
if (value.min !== undefined && value.max !== undefined) {
    const min = value.min ?? "";
    const max = value.max ?? "";

    value = `${min} to ${max}`;
}

// Create <h1>
let h1 = dv.el("h1", "");

// Left side (name)
h1.appendText(name);

// Right side (value)
let span = document.createElement("span");
span.style.marginLeft = "auto";
span.textContent = `${value}`;

h1.appendChild(span);