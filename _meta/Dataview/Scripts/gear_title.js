let page = input;

let price = page.price ?? 0;
let name = page.file?.name ?? "Untitled";

// Create <h1>
let h1 = dv.el("h1", "");

// Left side (name)
h1.appendText(name);

// -----------------------------
// Helpers
// -----------------------------

function isNumber(v) {
    return typeof v === "number" && !isNaN(v);
}

function getUnit(value) {
    if (value <= 99) return "cc";
    if (value <= 9999) return "sc";
    return "gc";
}

function toBase(value, unit) {
    if (unit === "cc") return value;
    if (unit === "sc") return value / 100;
    if (unit === "gc") return value / 10000;
    return value;
}

function formatRange(min, max) {
    let unit = getUnit(Math.max(min, max));

    let minVal = toBase(min, unit);
    let maxVal = toBase(max, unit);

    return `${minVal.toFixed(2).replace(/\.?0+$/, "")} to ${maxVal.toFixed(2).replace(/\.?0+$/, "")} ${unit}`;
}

function formatSingle(value) {
    if (!isNumber(value)) return value;

    if (value <= 99) return `${value} cc`;
    if (value <= 9999) return `${(value / 100).toFixed(2).replace(/\.?0+$/, "")} sc`;
    return `${(value / 10000).toFixed(4).replace(/\.?0+$/, "")} gc`;
}

// -----------------------------
// Right side (price)
// -----------------------------
let span = document.createElement("span");
span.style.marginLeft = "auto";

let label;

// Handle range object
if (price && typeof price === "object" && !Array.isArray(price)) {
    let min = price.min;
    let max = price.max;

    let minIsNum = isNumber(min);
    let maxIsNum = isNumber(max);

    // Case 1: both numeric → convert properly
    if (minIsNum && maxIsNum) {
        label = formatRange(min, max);

    // Case 2: both non-numeric → return raw text range
    } else if (!minIsNum && !maxIsNum && min != null && max != null) {
        label = `${min} to ${max}`;

    // Case 3: mixed or single values
    } else if (minIsNum) {
        label = formatSingle(min);
    } else if (maxIsNum) {
        label = formatSingle(max);
    } else {
        label = "0 cc";
    }

} else {
    label = formatSingle(price);
}

span.textContent = label;

h1.appendChild(span);