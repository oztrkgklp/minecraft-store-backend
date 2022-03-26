module.exports = {
    AUTHENTICATION_FAILED: {
        code: 1000,
        message: {
            tr: "Lütfen sisteme giriş yapın",
            en: "Please login to the system",
        },
    },
    SHORT_PASSWORD: {
        code: 1001,
        message: {
            tr: "Şifre çok kısa",
            en: "Password is too short",
        },
    },
    LONG_PASSWORD: {
        code: 1002,
        message: {
            tr: "Şifre çok uzun",
            en: "Password is too long",
        },
    },
    BADLY_FORMATTED_EMAIL: {
        code: 1003,
        message: {
            tr: "Geçersiz bir email adresi girdiniz",
            en: "You entered an invalid email address",
        },
    },
    USER_ALREADY_EXISTS: {
        code: 1004,
        message: {
            tr: "Bu kullanıcı zaten mevcut",
            en: "This user already exists",
        },
    },
    MISSING_FIELDS: {
        code: 1005,
        message: {
            tr: 'Bazı alanlar eksik',
            en: 'Some fields are missing'
        }
    },
    USER_NOT_FOUND: {
        code: 1006,
        message: {
            tr: 'Kullanıcı bulunamadı',
            en: 'User not found'
        }
    },
    INCORRECT_CREDENTIALS: {
        code: 1007,
        message: {
            tr: 'E-posta veya şifre yanlış',
            en: 'Email or password is incorrect'
        }
    },
    AUTHORIZATION_FAILED: {
        code: 1008,
        message: {
            tr: 'Bu eylem için yetkiniz yok',
            en: 'You are not authorized for this action'
        }
    },
    IMAGE_UPLOAD_FAILED: {
        code: 1009,
        message: {
            tr: 'Resim yüklenirken hata oluştu',
            en: 'Failed while uploading the image'
        }
    },
    INCORRECT_FILE_TYPE: {
        code: 1010,
        message: {
            tr: 'Geçersiz dosya formatı',
            en: 'Invalid file format'
        }
    },
    IMAGE_TOO_LARGE: {
        code: 1011,
        message: {
            tr: 'Lütfen daha küçük boyutta bir dosya yükleyin',
            en: 'Please upload a smaller file in size'
        }
    },
    INCORRECT_FIELD_NAME: {
        code: 1012,
        message: {
            tr: 'Hatalı alan adı',
            en: 'Incorrect field name'
        }
    },
    INCORRECT_USER_TYPE: {
        code: 1013,
        message: {
            tr: 'Bu kullanıcı için bu işlemi yapamazsınız',
            en: 'The process cannot be done for this user'
        }
    },
    UNKNOWN: {
        code: 3000,
        message: {
            tr: "Bilinmeyen bir hata",
            en: "Unknown error",
        },
    },
    INTERNAL_SERVER_ERROR: {
        code: 4000,
        message: {
            tr: "Sunucu hatası",
            en: "Internal server error",
        },
    },
};
