let page = input;

let uses = page.uses;

// Format text safely
let text;

if (uses !== null && uses !== undefined && uses !== "") {

    // Create container
    let el = dv.el("div", "");

    text = `**Uses:** ${uses}`;

    dv.paragraph(text);
}
