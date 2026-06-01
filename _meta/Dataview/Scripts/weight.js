let page = input;

let weight = page.weight;

// Format text safely
let text;

if (weight !== null && weight !== undefined && weight !== "") {

    // Create container
    let el = dv.el("div", "");

    text = `**Weight:** ${weight} kg`;

    dv.paragraph(text);
}
