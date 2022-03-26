const stream = require("stream");
const { ERROR, RESPONSE_STATUS, RESPONSE_TYPE } = require("../../utils/constants");

let expressResult = (result, req, res, next) => {
    console.log(JSON.stringify(result));
    
    // If headers set before skip
    if (res.headersSent) {
        console.log("Internal servor error. Error: Headers sent.");
        return res.status(500).send({
            code: ERROR.INTERNAL_SERVER_ERROR.code,
            message: ERROR.INTERNAL_SERVER_ERROR.message[req.language],
        });
    } else if (!result) {
        // The result didn't come for any reason
        console.log("Internal servor error. Error: " + result);
        return res.status(500).send({
            code: ERROR.INTERNAL_SERVER_ERROR.code,
            message: ERROR.INTERNAL_SERVER_ERROR.message[req.language],
        });
    }

    const data = result.data;

    // SUCCESS

    // Was it a successful process?
    if (result.status === RESPONSE_STATUS.SUCCESS) {
        // Set headers if exists
        if (result.headers) res.header(result.headers);

        // Download if it is a file
        if (result.type === RESPONSE_TYPE.FILE) {
            return res.download(data.data, data.fileName, (err) => {
                if (err) console.log(JSON.stringify(err, null, 2));
                else console.log(JSON.stringify(result, null, 2));
            });
        }
        // Buffered stream data
        else if (result.type === RESPONSE_TYPE.BUFFERED_STREAM) {
            var readStream = new stream.PassThrough();
            readStream.end(data.data);
            // res.set('Content-disposition', 'attachment; filename=' + 'fileName.xlsx');
            // res.set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            return readStream.pipe(res);
        }

        // Log warning
        console.log(JSON.stringify(result, null, 2));

        // Set custom body
        res.customBody = data;

        // Return success
        return res.status(200).send(data);
    }

    // Was it Authentication fail
    if (result.status === RESPONSE_STATUS.AUTHENTICATION_FAILED) {
        // Error
        const returnObject = { code: ERROR.AUTHENTICATION_FAILED.code, message: ERROR.AUTHENTICATION_FAILED.message[req.language] };

        // Log warning
        console.log((result.data.stack ? result.data.stack : "") + "\n" + JSON.stringify(returnObject, null, 2));

        // Set custom body
        res.customBody = returnObject;

        // Error
        return res.status(401).send(returnObject);
    }

    // ERROR

    // Is there error object?
    if (data) {
        // Find the error
        const err = Object.values(ERROR).find((item) => item.code === data.code);
        let returnObject;

        // Known error
        if (err) returnObject = { code: err.code, message: err.message[req.language] };
        // Unknown error
        else returnObject = { code: ERROR.UNKNOWN.code, message: ERROR.UNKNOWN.message[req.language] };

        // Log warning
        console.log((result.data.stack ? result.data.stack : "") + "\n" + JSON.stringify(returnObject, null, 2));

        // Set custom body
        res.customBody = returnObject;

        // Error
        return res.status(400).send(returnObject);
    } else {
        // Unknown error
        let returnObject = { code: ERROR.INTERNAL_SERVER_ERROR.code, message: ERROR.INTERNAL_SERVER_ERROR.message[req.language] };

        // Log error
        console.log(result.stack + "\n" + JSON.stringify(returnObject, null, 2));

        // Set custom body
        res.customBody = returnObject;

        // Multer error
        if (result && result.code === "LIMIT_FILE_SIZE") return res.status(400).send({ code: ERROR.IMAGE_TOO_LARGE.code, message: ERROR.IMAGE_TOO_LARGE.message[req.language] });
        // Multer error
        if (result && result.code === "LIMIT_UNEXPECTED_FILE") return res.status(400).send({ code: ERROR.INCORRECT_FIELD_NAME.code, message: ERROR.INCORRECT_FIELD_NAME.message[req.language] });
        // Unknown error
        else return res.status(500).send(returnObject);
    }
};

// Export
module.exports = { expressResult };
