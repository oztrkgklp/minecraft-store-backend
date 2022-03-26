const models = require("../models");

const writeRequestLog = (obj) => {
    return models.requestLog.create(obj);
};

module.exports = writeRequestLog;
