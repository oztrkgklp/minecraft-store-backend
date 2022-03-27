const { VERIFY, PERMISSION, AUTHENTICATION_STATUS } = require("../../utils/constants");

module.exports = (sequelize, DataTypes) => {
    let User = sequelize.define(
        "User",
        {
            id: {
                allowNull: false,
                defaultValue: DataTypes.UUIDV4,
                primaryKey: true,
                type: DataTypes.UUID,
            },
            username: {
                allowNull: false,
                type: DataTypes.TEXT,
            },
            realname: {
                allowNull: false,
                type: DataTypes.TEXT,
            },
            email: {
                type: DataTypes.STRING,
            },
            password: {
                allowNull: false,
                type: DataTypes.STRING,
            },
            verify: {
                allowNull: false,
                type: DataTypes.ENUM(VERIFY),
            },
            lastLogin: {
                type: DataTypes.DATE,
            },
            x: {
                allowNull: false,
                type: DataTypes.DOUBLE,
            },
            y: {
                allowNull: false,
                type: DataTypes.DOUBLE,
            },
            z: {
                allowNull: false,
                type: DataTypes.DOUBLE,
            },
            world: {
                type: DataTypes.TEXT,
            },
            isLogged: {
                allowNull: false,
                type: DataTypes.BOOLEAN,
            },
            hasSession: {
                allowNull: false,
                type: DataTypes.BOOLEAN,
            },
            credit: {
                allowNull: false,
                type: DataTypes.INTEGER.UNSIGNED,
            },
            permission: {
                allowNull: false,
                type: DataTypes.ENUM(PERMISSION),
            },
            authStatus: {
                allowNull: false,
                type: DataTypes.ENUM(AUTHENTICATION_STATUS),
            },
            creationIp: {
                allowNull: false,
                type: DataTypes.STRING,
            },
            ip: {
                allowNull: false,
                type: DataTypes.STRING,
            },
            regDate: {
                allowNull: false,
                type: DataTypes.DATE,
            },
            regIp: {
                type: DataTypes.STRING,
            },
            yaw: {
                type: DataTypes.DOUBLE,
            },
            pitch: {
                type: DataTypes.DOUBLE,
            },
        },
        {
            paranoid: true,
            timestamps: true,
        }
    );

    // Model association
    User.associate = (models) => {
        User.hasOne(models.userToken, { as: "userToken", foreignKey: "userId", onDelete: "cascade" });
    };

    require("../model.helpers/user.model.helper")(User);

    return User;
};
