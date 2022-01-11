import c from './constants';

export const colors = values => {
    let content = '';
    content += c.c4 + c.n;
    content += `${c.c3}@access public${c.n}`;
    content += `${c.c3}@group colors${c.n}`;
    content += c.c4 + c.n + c.n;
    for (const color in values) {
        if (Object.prototype.hasOwnProperty.call(values, color)) {
            content += c.gen + c.n;
            content += `${c.c3}@type color${c.n}`;
            content += `$${color}: ${values[color]};${c.n}`;
        }
    }
    content += c.n;
    return content;
};

export const palette = values => {
    let content = '';
    content += c.gen + c.n;
    content += `${c.c3}@type map${c.n}`;
    content += `$light-colors: (${c.n}`;
    let i = 1;
    let comma = ',';
    const colorL = Object.keys(values).length;
    for (const col in values) {
        if (Object.prototype.hasOwnProperty.call(values, col)) {
            if (typeof values[col] === 'object' && values[col] !== null) {
                content += `${c.q + col + c.q}: (${c.n}`;
                for (const hue in values[col]) {
                    if (Object.prototype.hasOwnProperty.call(values[col], hue)) {
                        let str = values[col][hue];
                        if (values[col][hue].match(c.regex) !== null) {
                            str = `$${str}`;
                        }
                        content += `${c.q + hue + c.q}: ${str},${c.n}`;
                    }
                }
                if (i === colorL) {
                    comma = '';
                }
                content += `)${comma}${c.n}`;
                i++;
            } else {
                if (i === colorL) {
                    comma = '';
                }
                let str = values[col];
                if (values[col].match(c.regex) !== null) {
                    str = `$${str}`;
                }
                content += `${c.q + col + c.q}: ${str}${comma}${c.n}`;
                i++;
            }
        }
    }
    content += `);${c.n}`;
    return content;
};
