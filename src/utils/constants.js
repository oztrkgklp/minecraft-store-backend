const ERROR = require("../domain/error.codes/error.codes");

module.exports = {
    // API url
    API_URL: process.env.API_URL,
    // Port
    PORT: process.env.PORT || 5000,
    // Exposed Headers
    EXPOSED_HEADERS: ["x-auth", "x-lang", "Origin", "X-Requested-With", "Content-Type", "Accept"],
    // Response status
    RESPONSE_STATUS: {
        FAIL: "Fail",
        SUCCESS: "Success",
        AUTHENTICATION_FAILED: "Authentication failed",
    },
    // Response type
    RESPONSE_TYPE: {
        FILE: "File",
        BUFFERED_STREAM: "Buffered Stream",
    },
    // Response headers
    HEADER: {
        AUTHENTICATION: "x-auth",
        LANGUAGE: "x-lang",
    },
    // Available versions
    AVAILABLE_VERSIONS: ["v1"],
    // Environment
    ENVIRONMENT: {
        TEST: "test",
        DEVELOPMENT: "dev",
        PRODUCTION: "prod",
    },
    // Languages
    LANGUAGES: ["en", "tr"],
    // Default language
    DEFAULT_LANGUAGE: "tr",
    // User type
    USER_TYPE: {
        USER: 0,
    },
    // Errors
    ERROR,
};
