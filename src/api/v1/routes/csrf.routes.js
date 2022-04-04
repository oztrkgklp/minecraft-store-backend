const { defineRoutes } = require("../../../utils/helper");

const routes = [
    {
        controller: "getCSRFToken",
        description: "CSRF Token endpoints",
        fallbackVersion: "v1",
        handlers: [],
        path: "/",
        userAuthentication: true,
        // authorization: [USER_TYPE.SUPER_ADMIN],
        type: "get",
        versions: ["v1"],
    },
];

module.exports = (version) => defineRoutes(routes, version);
