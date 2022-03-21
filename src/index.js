const express = require("express");
const cors = require("cors");
const bodyParser = require("body-parser");
const boolParser = require("express-query-boolean");
const helmet = require("helmet");

const constants = require("./utils/constants");

const app = express();

app.use(cors({ exposedHeaders: constants.EXPOSED_HEADERS }));
app.enable("trust proxy");
app.use(helmet());
app.use(bodyParser.json());
app.use(boolParser());

app.get("/", (req, res, next) => res.send("<h1>OK</h1>"));

const server = app.listen(constants.PORT, () => {
    console.log(`App started on port http://localhost:${constants.PORT}`);
});
