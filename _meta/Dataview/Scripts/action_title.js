let page = input;

let seconds = page.seconds;
let name = page.file?.name ?? "Untitled";

// Create <h1>
let h1 = dv.el("h1", "");

// Left side (name)
h1.appendText(name);

// Right side (value)
if (seconds || seconds === 0) {
    let span = document.createElement("span");
    span.style.marginLeft = "auto";

    // Pluralization logic
    let label;

    if (seconds === -2) {
      label = "Any number of Seconds";
    } else if (seconds === -1) {
      label = "Split Second";
    } else if (seconds === 1) {
      label = "1 Second";
    } else {
      label = `${seconds} Seconds`;
    }

    span.textContent = label;

    h1.appendChild(span);
}