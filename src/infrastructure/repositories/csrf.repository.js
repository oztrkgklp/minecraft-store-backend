const models = require("../models");

const getNewCSRFToken = (obj) => {
    return models.userToken.getNewCSRFToken(obj.id, obj.expiredToken);
};

module.exports = {
    getNewCSRFToken
};
