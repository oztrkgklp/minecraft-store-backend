const { ERROR, USER_TYPE } = require('../../utils/constants');

let authorize = (authorizationList) => {

	return (req, res, next) => {

		// Authorized
		if (authorizationList.includes(req.auth.type)) {

			return next();

		}
		// Authorized as super operator admin
		else if (authorizationList.includes(USER_TYPE.SUPER_OPERATOR_ADMIN) && req.auth.type === USER_TYPE.OPERATOR_ADMIN && req.auth.canAccessTowTruck) {
			return next();
		}
		// Not authorized
		else {
			const returnObject = { code: ERROR.AUTHORIZATION_FAILED.code, message: ERROR.AUTHORIZATION_FAILED.message[req.language] };
			// Set custom body
			res.customBody = returnObject;
			return res.status(403).send(returnObject);
		}

	};

};

// Export
module.exports = (authorizationList) => {
	return authorize(authorizationList);
};