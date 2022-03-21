require("dotenv").config({ path: "env/.env." + process.env.NODE_ENV });

module.exports = {

    // Port
    PORT: process.env.PORT || 5000,
    // Exposed Headers
    EXPOSED_HEADERS: ['x-auth', 'x-2fa-auth', 'x-lang', 'Origin', 'X-Requested-With', 'Content-Type', 'Accept'],

}