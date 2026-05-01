let page = input;

let price = page.price ?? 0;
let name = page.file?.name ?? "Untitled";

// Create <h1>
let h1 = dv.el("h1", "");

// Left side (name)
h1.appendText(name);

// Right side (price)
let span = document.createElement("span");
span.style.marginLeft = "auto";

let label;

if (price <= 99) {
    label = `${price} CC`;
} else if (price <= 9999) {
    label = `${(price / 100).toFixed(2).replace(/\.?0+$/, "")} SC`;
} else {
    label = `${(price / 10000).toFixed(4).replace(/\.?0+$/, "")} GC`;
}

span.textContent = label;

h1.appendChild(span);