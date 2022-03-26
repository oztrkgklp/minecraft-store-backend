const repository = require("../../../infrastructure/repositories/test.repository");
const { RESPONSE_STATUS } = require("../../../utils/constants");

module.exports = (req, res, next, command) => {
    return repository.testQuery(command)
    .then(result => next({
        data: result,
        message: `Test query executed with name: ${command.name}`,
        status: RESPONSE_STATUS.SUCCESS
    }))
    // Fail
    .catch(error => next({
        data: error,
        message: `Test query could not be executed`,
        status: RESPONSE_STATUS.FAIL
    }));
};
