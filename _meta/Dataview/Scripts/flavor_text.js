let page = input;

if (!page) return;

let flavor = page.flavor_text;

if (!flavor || !Array.isArray(flavor)) return;

// merge array of objects into one object
let merged = Object.assign({}, ...flavor);

let text = merged.text;
let quotee = merged.quotee;

if (!text) return;

let out;

if (quotee) {
    out = `*“${text}”*\n\n*— ${quotee}*`;
} else {
    out = `*${text}*`;
}

dv.paragraph(out);