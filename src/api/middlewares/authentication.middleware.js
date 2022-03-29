const { HEADER, ERROR, EXPIRATION, LANGUAGES } = require("../../utils/constants");
const logger = require("../../utils/logger");
const models = require("../../infrastructure/models");

const userAuthentication = (req, res, next) => {
    let user;

    /** Get Tokens */
    const access = req.header(HEADER.AUTHENTICATION.ACCESS);
    const refresh = req.header(HEADER.AUTHENTICATION.REFRESH);

    /** If tokens do not exist in the header */
    if (!access || !refresh) {
        logger.warn("Authentication failed: Tokens do not exist");
        const returnObject = { code: ERROR.AUTHENTICATION_FAILED.code, message: ERROR.AUTHENTICATION_FAILED.message[req.language] };
        res.customBody = returnObject;
        return res.status(401).send(returnObject);
    }

    return models.userToken
        .findOne({
            where: { access: access, refresh: refresh },
            include: [
                {
                    association: "user",
                    required: true,
                },
            ],
        })
        .then((userToken) => {
            /** If tokens do not contained in the database */
            if (!userToken) {
                logger.warn("Authentication failed for tokens: " + '{ "access": ' + access + ', "refresh": ' + refresh);
                return Promise.reject(ERROR.AUTHENTICATION_FAILED);
            }

            /** Set user */
            user = userToken.user;

            /** Check that tokens match with the ones in db */
            const isAccessTrue = access === userToken.access;
            const isRefreshTrue = refresh === userToken.refresh;

            if (!isAccessTrue || !isRefreshTrue) {
                logger.warn("Authentication failed for tokens: " + '{ "access": ' + access + ', "refresh": ' + refresh);
                return Promise.reject(ERROR.AUTHENTICATION_FAILED);
            }

            return userToken;
        })
        .then((userToken) => {
            let promises = [];

            /** If tokens are expired */
            const isAccessExpired = moment().isAfter(moment(userToken.accessExpirationDate));
            const isRefreshExpired = moment().isAfter(moment(userToken.refreshExpirationDate));

            if (!isRefreshExpired) {
                promises.push(models.userToken.getNewRefreshToken(user.id, refresh, req.language).then((token) => (refresh = token)));
            }

            if (!isAccessExpired) {
                promises.push(models.getNewAccessToken(user.id, access, req.language).then((token) => (access = token)));
            }

            return Promise.all(promises);
        })
        .then(() => {
            /** Set auth info */
            req.auth = user;

            /** Set response headers */
            res.setHeader(HEADER.AUTHENTICATION.ACCESS, access);
            res.setHeader(HEADER.AUTHENTICATION.REFRESH, refresh);

            return Promise.resolve(next());
        })
        .catch((e) => {
            logger.warn("Authentication failed. Error: " + e);
            const returnObject = { code: ERROR.AUTHENTICATION_FAILED.code, message: ERROR.AUTHENTICATION_FAILED.message[req.language] };
            res.customBody = returnObject;
            return res.status(401).send(returnObject);
        });
};
