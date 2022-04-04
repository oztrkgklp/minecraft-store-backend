const repository = require("../../../infrastructure/repositories/csrf.repository");
const { RESPONSE_STATUS } = require("../../../utils/constants");

module.exports = (req, res, next, command) => {
    return repository.getNewCSRFToken(command)
    .then(result => next({
        data: result,
        message: `New CSRF token has been generated for the user with id: ${command.id}`,
        status: RESPONSE_STATUS.SUCCESS
    }))
    // Fail
    .catch(error => next({
        data: error,
        message: `New CSRF token could not be generated for the user with id: ${command.id}`,
        status: RESPONSE_STATUS.FAIL
    }));
};
