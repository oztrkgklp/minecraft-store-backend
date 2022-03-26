const commandHandler = require("../../../application/use.cases/test/test.command.handler");
const command = require("../../../domain/commands/test.command");

module.exports = (req, res, next) => {
    return commandHandler(req, res, next, new command(req.body.name));
};


/**
 * @swagger
 * definitions:
 *   test:
 *     properties:
 *       name:
 *         type: string
 *     example: {
 *       "name": "test",
 *     }
 */

/**
 * @swagger
 * /api/v1/test:
 *   post:
 *     tags:
 *       - Test
 *     description: Test endpoint
 *     produces:
 *       - application/json
 *     parameters:
 *       - name: test
 *         in: body
 *         schema:
 *           $ref: '#/definitions/test'
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