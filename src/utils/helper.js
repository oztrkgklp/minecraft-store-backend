const authorization = require("../api/middlewares/authorization.middleware");
const { userAuthentication, /* externalAuthentication */ } = require("../api/middlewares/authentication.middleware");

const defineRoutes = (routes, version) => {
    // Define router
    const router = require("express").Router();

    // Create all routes
    routes.forEach((endpoint) => {
        // Set version if endpoint doesn't support
        if (!endpoint.versions.includes(version)) version = endpoint.fallbackVersion;

        // Set handlers
        let handlers = [];
        if (endpoint.userAuthentication) handlers.push(userAuthentication);
        // if (endpoint.externalAuthentication) handlers.push(externalAuthentication);
        if (endpoint.authorization) handlers.push(authorization(endpoint.authorization));
        handlers = handlers.concat(endpoint.handlers);

        // Set controller
        router[endpoint.type](endpoint.path, handlers, require(`../api/${version}/controllers/${endpoint.controller}.controller`));
    });

    // Return router
    return router;
};

module.exports = {
    defineRoutes,
};
