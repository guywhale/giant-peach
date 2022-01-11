/**
 * This function returns an object filled with passed process variables
 * E.g. if a variable --foo 'bar' was passed
 * returned envArgs object would have a foo: bar key pair value
 */
export default (argList => {
    const envArgs = {};
    let a;
    let opt;
    let thisOpt;
    let curOpt;
    for (a = 0; a < argList.length; a++) {
        thisOpt = argList[a].trim();
        opt = thisOpt.replace(/^-+/, '');
        if (opt === thisOpt) {
            //* argument value
            if (curOpt) envArgs[curOpt] = opt;
            curOpt = null;
        } else {
            //* argument name
            curOpt = opt;
            envArgs[curOpt] = true;
        }
    }
    return envArgs;
})(process.argv);
