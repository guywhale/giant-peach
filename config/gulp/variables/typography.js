import c from './constants';

export const fonts = values => {
    let content = '';
    content += c.c4 + c.n;
    content += `${c.c3}@access public${c.n}`;
    content += `${c.c3}@group typography${c.n}`;
    content += c.c4 + c.n + c.n;
    for (const font in values) {
        if (Object.prototype.hasOwnProperty.call(values, font)) {
            content += c.gen + c.n;
            content += `${c.c3}@type string${c.n}`;
            content += `$${font}: ${c.q + values[font].name + c.q}, ${
                values[font].category
            };${c.n}`;
        }
    }
    content += c.n;
    return content;
};

export const headings = values => {
    let content = '';
    const tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'body'];
    for (const h in values) {
        if (Object.prototype.hasOwnProperty.call(values, h)) {
            content += c.c3 + c.n;
            content += `%${h} {${c.n}`;
            let sz = values[h].size;
            let line = values[h].line || sz * 1.5;
            const ff = values[h].family;
            const fw = values[h].weight;
            const lsp = values[h].spacing;
            const resp = values[h].respond;
            sz /= 10;
            line /= 10;

            const typoContent = [sz, 'rem, ', line];
            if (ff) {
                typoContent.push('rem, ', `$${ff}`);
            } else {
                typoContent.push('rem');
            }
            content += '@include typography(';
            for (const el of typoContent) {
                content += el;
            }
            content += `);${c.n}`;
            if (fw) {
                content += `font-weight: ${fw};${c.n}`;
            }
            if (lsp) {
                content += `letter-spacing: ${lsp}px;${c.n}`;
            }
            if (resp) {
                content += parseRespond(resp);
            }
            content += `}${c.n}`;
        }
    }

    content += c.c3 + c.n;
    content += `$headings: (${c.n}`;
    for (const h in values) {
        if (Object.prototype.hasOwnProperty.call(values, h)) {
            if (tags.includes(h)) {
                content += `${c.q}${h}${c.q},${c.n}`;
            }
        }
    }
    content += `);${c.n}`;
    content += c.c3 + c.n;
    content += `$custom-headings: (${c.n}`;
    for (const h in values) {
        if (Object.prototype.hasOwnProperty.call(values, h)) {
            if (!tags.includes(h)) {
                content += `${c.q}${h}${c.q},${c.n}`;
            }
        }
    }
    content += `);${c.n}`;
    return content;
};

const parseRespond = values => {
    let content = '';
    let count = 0;
    const bpNum = Object.keys(values).length;
    for (const bp in values) {
        if (Object.prototype.hasOwnProperty.call(values, bp)) {
            count++;
            content += `@include respond('${bp}') {${c.n}`;
            let sz = values[bp].size;
            let line = values[bp].line || sz * 1.5;
            const fw = values[bp].weight;
            const lsp = values[bp].spacing;
            sz /= 10;
            line /= 10;
            const typoContent = [sz, 'rem, ', line];
            typoContent.push('rem');
            content += '@include typography(';
            for (const el of typoContent) {
                content += el;
            }
            content += `);${c.n}`;
            if (fw) {
                content += `font-weight: ${fw};${c.n}`;
            }
            if (lsp) {
                content += `letter-spacing: ${lsp}px;${c.n}`;
            }
            content += count === bpNum ? `}${c.n}` : `}${c.n}${c.n}`;
        }
    }
    return content;
};
