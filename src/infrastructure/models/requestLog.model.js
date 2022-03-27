module.exports = (sequelize, DataTypes) => {
    // Model configuration
    let RequestLog = sequelize.define("RequestLog", {
        id: {
            allowNull: false,
            defaultValue: DataTypes.UUIDV4,
            primaryKey: true,
            type: DataTypes.UUID,
        },
        endpoint: {
            type: DataTypes.TEXT,
        },
        method: {
            type: DataTypes.STRING,
        },
        host: {
            type: DataTypes.STRING,
        },
        userAgent: {
            type: DataTypes.TEXT,
        },
        reqBody: {
            type: DataTypes.TEXT,
        },
        query: {
            type: DataTypes.TEXT,
        },
        params: {
            type: DataTypes.TEXT,
        },
        reqHeaders: {
            type: DataTypes.TEXT,
        },
        ip: {
            type: DataTypes.STRING,
        },
        requestDuration: {
            type: DataTypes.INTEGER,
        },
        status: {
            type: DataTypes.STRING,
        },
        resHeaders: {
            type: DataTypes.TEXT,
        },
        resBody: {
            type: DataTypes.TEXT,
        },
    }, {
        paranoid: true,
        timestamps: true,
    });

    // Model association
    RequestLog.associate = (models) => {};

    // Return model
    return RequestLog;
};
