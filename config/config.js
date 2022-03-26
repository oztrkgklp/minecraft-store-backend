const Sequelize = require("sequelize");
const cls = require("cls-hooked");

// Configure sequelize namespace
const namespace = cls.createNamespace("sequelize-transaction-namespace");
Sequelize.useCLS(namespace);

const sequelize = new Sequelize(process.env.DATABASE_DB, process.env.DATABASE_USER, process.env.DATABASE_PASSWORD, {
    host: process.env.DATABASE_HOST,
    dialect: process.env.DATABASE_DIALECT,
    timezone: process.env.DATABASE_TIMEZONE,
    operatorsAliases: "",
    // logging: console.log,
    logging: false,
    minifyAliases: true,
    port: process.env.DATABASE_PORT
    // pool: {
    //     max: 5,
    //     min: 0,
    //     acquire: 30000,
    //     idle: 10000
    // }
});

// Test the connection to database
sequelize
    .authenticate()
    .then(() => {
        console.log("Connection has been established successfully.");
    })
    .catch((err) => {
        console.log("Unable to connect to the database:", err);
    });

// Export
module.exports = sequelize;
