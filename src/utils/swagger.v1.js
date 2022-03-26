const swaggerJSDoc = require("swagger-jsdoc");
const swaggerUi = require("swagger-ui-express");
const { HEADER, API_URL } = require("./constants");

// swagger definition
const swaggerDefinition = {
    info: {
        title: "Minecraft Store Node Swagger API",
        version: "1.0.0",
        description: "Minecraft Store Swagger",
    },
    host: API_URL.replace("http://", "").replace("https://", ""),
    basePath: "/",
    securityDefinitions: {
        jwt: {
            type: "apiKey",
            description: "JWT authorization token",
            name: HEADER.AUTHENTICATION,
            in: "header",
        },
    },
    security: [{ jwt: [] }],
};

// Options for the swagger docs
var options = {
    // import swaggerDefinitions
    swaggerDefinition: swaggerDefinition,
    // path to the API docs
    apis: ["**/v1/controllers/*.js"],
};

// initialize swagger-jsdoc
const swaggerSpec = swaggerJSDoc(options);

module.exports = (app) => {
    // Swagger.json get
    app.get("/swagger.json", (req, res) => {
        res.setHeader("Content-Type", "application/json");
        res.send(swaggerSpec);
    });

    // Initialize ui
    app.use("/api/v1/docs", swaggerUi.serve, swaggerUi.setup(swaggerSpec));
};
