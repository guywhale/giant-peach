import c from './constants';

export default values => {
    let content = '';
    for (const prop in values) {
        if (Object.prototype.hasOwnProperty.call(values, prop)) {
            let value = values[prop];
            let output = '';
            if (typeof value === 'string') {
                value = value.split('-');
                output = `color('${value[0]}', '${value[1]}')`;
            } else {
                output = `${value / 10}rem`;
            }
            content += c.c3 + c.n;
            content += `$core-${prop}: ${output};${c.n}`;
        }
    }
    return content;
};
