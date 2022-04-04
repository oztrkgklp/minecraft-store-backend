const jwt = require("jsonwebtoken");
const moment = require("moment");
const { TokenIsNotValid } = require("../../domain/exceptions/exceptions");
const constants = require("../../utils/constants");
const { EXPIRATION } = require("../../utils/constants");

module.exports = (Model) => {
    Model.prototype.toUserTokenObject = () => {
        return this.toJSON();
    };

    Model.validateAccessToken = (token) => {
        try {
            var decoded = jwt.verify(token, process.env.JWT_ACCESS_SECRET);
            return true;
        } catch (err) {
            return false;
        }
    };

    Model.validateRefreshToken = (token) => {
        try {
            var decoded = jwt.verify(token, process.env.JWT_REFRESH_SECRET);
            return true;
        } catch (err) {
            return false;
        }
    };

    Model.getNewAccessToken = (userId, expiredAccessToken, refreshToken, language = constants.DEFAULT_LANGUAGE) => {
        return this.findOne({ where: { userId: userId, acces: expiredAccessToken, refresh: refreshToken } }).then((result) => {
            if (result) {
                const newAccessToken = jwt.sign({ id: userId }, process.env.JWT_ACCESS_SECRET, { expiresIn: EXPIRATION.ACCESS_TOKEN.STR }).toString();
                return this.update({ access: newAccessToken, accessExpirationDate: moment().add(EXPIRATION.ACCESS_TOKEN.VALUE, EXPIRATION.ACCESS_TOKEN.UNIT) }, { where: { userId: userId } }).then(
                    () => newAccessToken
                );
            } else {
                throw new TokenIsNotValid("Token is not valid");
            }
        });
    };

    Model.getNewRefreshToken = (userId, expiredRefreshToken, language = constants.DEFAULT_LANGUAGE) => {
        return this.findOne({ where: { userId: userId, refresh: expiredRefreshToken } }).then((result) => {
            if (result) {
                const newRefreshToken = jwt.sign({ id: userId }, process.env.JWT_REFRESH_SECRET, { expiresIn: EXPIRATION.REFRESH_TOKEN.STR }).toString();
                return this.update(
                    { refresh: newRefreshToken, refreshExpirationDate: moment().add(EXPIRATION.REFRESH_TOKEN.VALUE, EXPIRATION.REFRESH_TOKEN.UNIT) },
                    { where: { userId: userId } }
                ).then(() => newRefreshToken);
            } else {
                throw new TokenIsNotValid("Token is not valid");
            }
        });
    };

    Model.getNewCSRFToken = (userId, expiredCSRFToken, language = constants.DEFAULT_LANGUAGE) => {
        return this.findOne({ where: { userId: userId, csrf: expiredCSRFToken } }).then((result) => {
            if (result) {
                const newCSRFToken = jwt.sign({ id: userId }, process.env.JWT_CSRF_SECRET, { expiresIn: EXPIRATION.CSRF_TOKEN.STR }).toString();
                return this.update(
                    { csrf: newCSRFToken },
                    { where: { userId: userId } }
                ).then(() => newCSRFToken);
            } else {
                throw new TokenIsNotValid("Token is not valid");
            }
        });
    };

    Model.createTokens = (userId, transaction) => {
        // Create tokens
        const access = jwt.sign({ id: userId }, process.env.JWT_ACCESS_SECRET, { expiresIn: EXPIRATION.ACCESS_TOKEN.STR }).toString();
        const refresh = jwt.sign({ id: userId }, process.env.JWT_REFRESH_SECRET, { expiresIn: EXPIRATION.REFRESH_TOKEN.STR }).toString();

        return this.create(
            {
                access: access,
                refresh: refresh,
                accessExpirationDate: moment().add(EXPIRATION.ACCESS_TOKEN.VALUE, EXPIRATION.ACCESS_TOKEN.UNIT),
                refreshExpirationDate: moment().add(EXPIRATION.REFRESH_TOKEN.VALUE, EXPIRATION.REFRESH_TOKEN.UNIT),
            },
            { transaction }
        ).then(() => ({ access, refresh }));
    };
};
