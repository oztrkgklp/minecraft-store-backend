require("dotenv").config({ path: "env/.env." + process.env.NODE_ENV });

const express = require("express");
const cors = require("cors");
const bodyParser = require("body-parser");
const boolParser = require("express-query-boolean");
const helmet = require("helmet");
const listEndpoints = require("express-list-endpoints");

const constants = require("./utils/constants");

const initializeSwagger = require("./utils/swagger.v1");
const models = require("./infrastructure/models");
const routes = require("./api/v1/routes");
const middlewareDefaults = require("./api/middlewares/defaults.middleware");
const { expressResult } = require("./api/middlewares/expressResult.middleware");
const requestLog = require("./api/middlewares/requestLog.middleware");

const app = express();

app.use(cors({ exposedHeaders: constants.EXPOSED_HEADERS }));
app.enable("trust proxy");
app.use(helmet());
app.use(bodyParser.json());
app.use(boolParser());

// Initialize swagger
initializeSwagger(app);

// Middleware defaults
app.use(middlewareDefaults);

// Request logger
app.use(requestLog);

app.get("/", (req, res, next) => res.send("<h1>OK</h1>"));

// Define routes
Object.keys(routes).forEach((key) => {
    // Versioning
    constants.AVAILABLE_VERSIONS.forEach((version) => {
        app.use(`/api/${version}/` + key, routes[key](version));
    });
});

// Result handler
app.use(expressResult);

/** List endpoints */
// console.log(listEndpoints(app));

/** Sequelize ORM sync method
 * synchronizes database programmatically
 * CAUTION!: do not use alter or force option in production
 */
models.sequelize.sync({ alter: true /* force: true */ }).then(() => console.log("Database synchronized"));

const server = app.listen(constants.PORT, () => {
    console.log(`App started: http://localhost:${constants.PORT}`);
});

// Export for testing
module.exports = { app };
