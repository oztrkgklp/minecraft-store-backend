const TokenIsNotValid = (message) => {
    const error = new Error(message);
    return error;
}

TokenIsNotValid.prototype = Object.create(Error.prototype);

module.exports = {
    TokenIsNotValid
}