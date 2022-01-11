import c from './constants';

export default values => {
    let content = '';
    content += c.c4 + c.n;
    content += `${c.c3}@access public${c.n}`;
    content += `${c.c3}@group layout${c.n}`;
    content += c.c4 + c.n + c.n;
    content += c.gen + c.n;
    content += `${c.c3}Space single unit${c.n}`;
    content += `${c.c3}@type string${c.n}`;
    content += `$space: ${values.unit + c.r};${c.n + c.n}`;
    content += c.gen + c.n;
    content += `${c.c3}Leap single unit${c.n}`;
    content += `${c.c3}@type string${c.n}`;
    content += `$leap: ${values.leap + c.r};${c.n + c.n}`;
    content += c.gen + c.n;
    content += `${c.c3}# Map storing all length sizes as defined in the json.${c.n}`;
    content += `${c.c3}Starting from 0, using \`$space\` as a base unit${c.n}`;
    content += `${c.c3}and following by \`$leap\` times an integer number.${c.n}`;
    content += `${c.c3}@type map${c.n}`;
    content += `$spaces: (${c.n}`;
    content += `${c.q}0${c.q}: 0,${c.n}`;
    let comma = ',';
    for (let z = 1; z < values.amount; z++) {
        if (values.amount - 1 === z) {
            comma = '';
        }
        if (z === 1) {
            content += `${c.q + (values.unit * 10) + c.q}: $space${comma + c.n}`;
        } else {
            let num = (values.unit + values.leap * (z - 1));
            num = num.toPrecision(2);
            num = `${num}`;
            let xSp = ' ';
            if (num.match(/\./) !== null) {
                num = num.replace('.', '');
                xSp = '';
            }
            content += `${c.q + num + c.q}: ${xSp}($space + $leap * ${(z - 1)})${comma + c.n}`;
        }
    }
    content += `);${c.n}`;
    return content;
};
