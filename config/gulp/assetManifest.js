import fs from 'fs';
import dirTree from 'directory-tree';

import config from '../config';

export default function manifest(cb) {
    const nodes = dirTree(config.paths.base.dest);
    const tree = crawlTree(nodes);

    fs.writeFile(
        config.paths.base.dest + config.paths.manifest,
        JSON.stringify(tree),
        {},
        err => {
            if (err) {
                throw err;
            }
        }
    );

    cb();
}

function crawlTree(node, path = '') {
    if (node.type === 'directory') {
        const tree = {};

        node.children.forEach(childNode => {
            const key = stripChunk(childNode.name);
            tree[key] = crawlTree(childNode, `${path}/${node.name}`);
        });

        return tree;
    }

    return (`${path}/${node.name}`).replace(`/${config.paths.base.dest}`, '');
}

function stripChunk(name) {
    if (name.includes('.css') || name.includes('.js') || name.includes('.mjs')) {
        const parts = name.split('.');

        if (parts.length > 2) {
            parts.splice(parts.length - 2, 1);
            return parts.join('.');
        }
    }

    return name;
}
