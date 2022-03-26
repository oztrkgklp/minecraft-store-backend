const moment = require('moment');
const writeLog = require('../../infrastructure/repositories/requestLog.repository');

let requestLogger = (req, res, next) => {
	
	// Fetch request parameters
    const method = req.method;
    const endpoint = req.originalUrl;
    const reqBody = req.body ? JSON.stringify(req.body) : null;
    const query = req.query ? JSON.stringify(req.query) : null;
    const params = req.params ? JSON.stringify(req.params) : null;
    const reqHeaders = req.headers ? JSON.stringify(req.headers) : null;
    const host = req.headers.host;
    const userAgent = req.headers['user-agent'];
    const ip = req.ip;
    const path = req.path;
    const requestStart = moment();

    // Next step
    next();
  
    // On response finish
    res.on('finish', () => {
        Promise
            .resolve()
            .then(() => {

                // Fetch response parameters
                const status = res.statusCode;
                const resHeaders = res.getHeaders() ? JSON.stringify(res.getHeaders()) : null;
                const requestFinish = moment();
                const requestDuration = moment(requestFinish).diff(requestStart, 'milliseconds');

                // Save request
                return writeLog({
                    method,
                    endpoint,
                    reqBody,
                    query,
                    params,
                    reqHeaders,
                    host,
                    userAgent,
                    ip,
                    status,
                    resHeaders,
                    requestDuration,
                    resBody: res.customBody ? JSON.stringify(res.customBody) : null
                });
            })
            .catch(e => {
                console.log('Failed while logging to database. Error: ', e);
            });

    });
	
};

// Export
module.exports = requestLogger;