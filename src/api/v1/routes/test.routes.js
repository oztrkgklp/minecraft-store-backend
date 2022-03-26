const { defineRoutes } = require("../../../utils/helper");

const routes = [
    {
        controller: "test",
        description: "Test controller",
        fallbackVersion: "v1",
        handlers: [],
        path: "/",
        userAuthentication: false,
        // authorization: [USER_TYPE.SUPER_ADMIN],
        type: "post",
        versions: ["v1"],
    },
];

module.exports = (version) => defineRoutes(routes, version);
