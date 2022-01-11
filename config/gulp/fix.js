import { styleFix } from './style-tasks';

export default function fix(cb) {
    styleFix();

    cb();
}
