import { series } from 'gulp';

import { variables, variablesFix } from './variables-tasks';

export default series(
    variables,
    variablesFix
);
