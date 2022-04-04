const commandHandler = require("../../../application/use.cases/csrf/getCSRFToken.command.handler");
const command = require("../../../domain/commands/getCSRFToken.command");
const { HEADER } = require("../../../utils/constants");

module.exports = (req, res, next) => {
    return commandHandler(req, res, next, new command(req.auth.id, req.header[HEADER.AUTHENTICATION.CSRF]));
};

/**
 * @swagger
 * /api/v1/csrf:
 *   get:
 *     tags:
 *       - Security
 *     description: Get CSRF Token
 *     produces:
 *       - application/json
 *     responses:
 *       200:
 *         headers:
 *           x-auth:
 *             schema:
 *               type: string
 *             description: Authentication token
 *         schema:
 *           type: object
 *       400:
 *         description: Code = 3000
 *         schema:
 *           type: object
 *           $ref: '#/definitions/error'
 *       401:
 *         description: Code = 1000
 *         schema:
 *           type: object
 *           $ref: '#/definitions/error'
 *       403:
 *         description: Code = 1011
 *         schema:
 *           type: object
 *           $ref: '#/definitions/error'
 *       500:
 *         description: Code = 4000
 *         schema:
 *           type: object
 *           $ref: '#/definitions/error'
 */
