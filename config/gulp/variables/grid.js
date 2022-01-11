import c from './constants';

export const grid = values => {
    let content = '';
    content += c.gen + c.n;
    content += `${c.c3}@access public${c.n}`;
    content += `${c.c3}@group layout${c.n}`;
    content += `${c.c3}@type map${c.n}`;
    content += `$grid-breakpoints: (${c.n}`;
    let y = 1;
    const gridL = Object.keys(values).length;
    for (const bp in values) {
        if (Object.prototype.hasOwnProperty.call(values, bp)) {
            let comma = ',';
            if (y === gridL) {
                comma = '';
            }
            content += `${c.q + bp + c.q}: ${values[bp]}px${comma}${c.n}`;
            y++;
        }
    }
    content += `);${c.n}${c.n}`;
    return content;
};

export const container = values => {
    let content = '';
    content += c.gen + c.n;
    content += `${c.c3}@access public${c.n}`;
    content += `${c.c3}@group layout${c.n}`;
    content += `${c.c3}@type map${c.n}`;
    content += `$container-max-widths: (${c.n}`;
    let y = 1;
    const contL = Object.keys(values).length;
    for (const bp in values) {
        if (Object.prototype.hasOwnProperty.call(values, bp)) {
            let comma = ',';
            if (y === contL) {
                comma = '';
            }
            content += `${c.q + bp + c.q}: ${values[bp]}px${comma}${c.n}`;
            y++;
        }
    }
    content += `);${c.n}${c.n}`;
    return content;
};

export const gutters = values => {
    let content = '';
    content += c.gen + c.n;
    content += `${c.c3}@access public${c.n}`;
    content += `${c.c3}@group layout${c.n}`;
    content += `${c.c3}@type map${c.n}`;
    content += `$gutters-grid: (${c.n}`;
    let y = 1;
    const guttersL = Object.keys(values).length;
    for (const bp in values) {
        if (Object.prototype.hasOwnProperty.call(values, bp)) {
            let comma = ',';
            if (y === guttersL) {
                comma = '';
            }
            content += `${c.q + bp + c.q}: ${values[bp]}rem${comma}${c.n}`;
            y++;
        }
    }
    content += `);${c.n}`;
    return content;
};
