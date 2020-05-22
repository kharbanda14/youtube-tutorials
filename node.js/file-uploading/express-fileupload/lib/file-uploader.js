const path = require("path");
const config = require("../config/upload");

/**
 * File Uploader
 */
module.exports = (file) => {
  return new Promise(function (resolve, reject) {
    
    /**
     * Check for allowed file types.
     */
    if (config.allowed_types.indexOf(file.mimetype) == -1) {
      return reject(new Error("File type not supported."));
    }

    file.mv(path.join(__dirname, "../uploads", file.name), function (err) {
      if (err) {
        return reject(err);
      }
      return resolve({
        name: file.name,
        size: file.size,
      });
    });
  });
};
