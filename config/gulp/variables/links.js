import c from './constants';

export default values => {
    let content = '';
    for (const prop in values) {
        if (Object.prototype.hasOwnProperty.call(values, prop)) {
            let value = values[prop];
            value = value.split('-');
            const output = `color('${value[0]}', '${value[1]}')`;
            content += c.c3 + c.n;
            content += `$link-${prop}: ${output};${c.n}`;
        }
    }
    return content;
};
