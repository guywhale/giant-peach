import c from './constants';

export default values => {
    let content = '';
    content += c.gen + c.n;
    content += `${c.c3}Map used to generate easy to access sizes${c.n}`;
    content += `${c.c3}@access public${c.n}`;
    content += `${c.c3}@group layout${c.n}`;
    content += `${c.c3}@type map${c.n}`;
    content += `$sizes: (${c.n}`;
    const b = 1;
    const sizesL = Object.keys(values).length;
    let comma = ',';
    for (const size in values) {
        if (Object.prototype.hasOwnProperty.call(values, size)) {
            if (b === sizesL) {
                comma = '';
            }
            let sz = values[size];
            sz /= 10;
            content += `${c.q + size + c.q}: ${sz}${c.r}${comma}${c.n}`;
        }
    }
    content += `);${c.n}`;
    return content;
};
