const n = '\r\n';

export default (values, mapName) => {
    let content = '';
    content += `$${mapName}: (`;
    for (const prop in values) {
        if (Object.prototype.hasOwnProperty.call(values, prop)) {
            const propValue = values[prop];
            if (prop !== 'transition') {
                if (typeof propValue === 'string') {
                    content += `${n}'${prop}': ${parse(propValue)},`;
                } else if (typeof propValue === 'object') {
                    content += `${n}'${prop}': (`;
                    content += createScssVariables(propValue);
                    content += `${n}),`;
                }
            }
        }
    }
    //* Check for transition
    content += transition(values);
    content += `${n});${n}`;
    return content;
};

function createScssVariables(obj) {
    if (obj) {
        let content = '';
        for (const prop in obj) {
            if (Object.prototype.hasOwnProperty.call(obj, prop)) {
                const propValue = obj[prop];
                if (prop !== 'transition') {
                    if (typeof propValue === 'string') {
                        content += `${n}'${prop}': ${parse(propValue)},`;
                    } else if (typeof propValue === 'object') {
                        content += `${n}'${prop}': (`;
                        content += createScssVariables(propValue);
                        content += `${n}),`;
                    }
                }
            }
        }
        //* Check for transition
        content += transition(obj);
        return content;
    }
    return '';
}

function transition(values) {
    let content = '';
    if (Object.keys(values).includes('transition')) {
        const props = values.transition.join(', ');
        content += `${n}'transition': transition(${props}),`;
    }
    return content;
}

function parse(value) {
    const reg = /(\w+)(-)(\d{1,2}$)/gm;
    const sub = "color('$1', '$3')";
    if (reg.test(value)) {
        return value.replace(reg, sub);
    }
    return value;
}

// export default {
//     createScssVariables
// };
