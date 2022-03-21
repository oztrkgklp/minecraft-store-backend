require("dotenv").config({ path: "env/.env." + process.env.NODE_ENV });
const express = require("express");
const cors = require("cors");
const bodyParser = require("body-parser");
const boolParser = require("express-query-boolean");
const helmet = require("helmet");

const constants = require("./utils/constants");

const app = express();
const port = process.env.PORT || 5000;

app.use(cors({ exposedHeaders: constants.EXPOSED_HEADERS }));
app.enable("trust proxy");
app.use(helmet());
app.use(bodyParser.json());
app.use(boolParser());

app.get("/", (req, res, next) => res.send("<h1>OK</h1>"));

const server = app.listen(port, () => {
    console.log(`App started on port http://localhost:${port}`);
});
