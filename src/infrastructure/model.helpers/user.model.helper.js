const _ = require("lodash");

module.exports = (Model) => {
    Model.prototype.toUserObject = () => {
        return this.toJSON();
    };
};
