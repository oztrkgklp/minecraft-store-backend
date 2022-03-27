module.exports = (sequelize, DataTypes) => {
    let UserToken = sequelize.define(
        "UserTokens",
        {
            id: {
                allowNull: false,
                defaultValue: DataTypes.UUIDV4,
                primaryKey: true,
                type: DataTypes.UUID,
            },
            access: {
                allowNull: false,
                notEmpty: true,
                type: DataTypes.STRING,
            },
            refresh: {
                allowNull: false,
                notEmpty: true,
                type: DataTypes.STRING,
            },
            accessExpirationDate: {
                allowNull: false,
                notEmpty: true,
                type: DataTypes.DATE,
            },
            refreshExpirationDate: {
                allowNull: false,
                notEmpty: true,
                type: DataTypes.DATE,
            },
        },
        {
            paranoid: true,
            timestamps: true,
            indexes: [
                { unique: true, fields: ["access"] },
                { unique: true, fields: ["refresh"] },
                { unique: false, fields: ["userId"] },
            ],
        }
    );

    // Model association
    UserToken.associate = (models) => {
        UserToken.belongsTo(models.user, { as: "user", onDelete: "cascade" });
    };

    require("../model.helpers/userToken.model.helper")(UserToken);

    // Return model
    return UserToken;
};
