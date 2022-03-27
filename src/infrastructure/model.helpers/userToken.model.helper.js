const jwt = require("jsonwebtoken");
const moment = require("moment");
const { TokenIsNotValid } = require("../../domain/exceptions/exceptions");

module.exports = (Model) => {
    Model.prototype.toUserTokenObject = () => {
        return this.toJSON();
    };

    Model.getNewAccessToken = (userId, expiredAccessToken, refreshToken, language) => {
        return this.findOne({ where: { userId: userId, acces: expiredAccessToken, refresh: refreshToken } }).then((result) => {
            if (result) {
                const newAccessToken = jwt.sign({ id: userId }, process.env.JWT_ACCESS_SECRET, { expiresIn: "600s" }).toString();
                return this.update({ access: newAccessToken, accessExpirationDate: moment().add(600, "seconds") }, { where: { userId: userId } });
            } else {
                throw new TokenIsNotValid("Token is not valid");
            }
        });
    };

    Model.getNewRefreshToken = (userId, expiredRefreshToken, language) => {
        return this.findOne({ where: { userId: userId, refresh: expiredRefreshToken } }).then((result) => {
            if (result) {
                const newRefreshToken = jwt.sign({ id: userId }, process.env.JWT_REFRESH_SECRET, { expiresIn: "365d" }).toString();
                return this.update({ refresh: newRefreshToken, refreshExpirationDate: moment().add(365, "days") }, { where: { userId: userId } });
            }
            else {
                throw new TokenIsNotValid("Token is not valid");
            }
        });
    };

    Model.createTokens = (userId, transaction) => {
        // Create tokens
        const access = jwt.sign({ id: userId }, process.env.JWT_ACCESS_SECRET, { expiresIn: "600s" }).toString();
        const refresh = jwt.sign({ id: userId }, process.env.JWT_REFRESH_SECRET, { expiresIn: "365d" }).toString();

        return this.create(
            {
                access: access,
                refresh: refresh,
                accessExpirationDate: moment().add(600, "seconds"),
                refreshExpirationDate: moment().add(365, "days"),
            },
            { transaction }
        ).then(() => ({ access, refresh }));
    };
};
