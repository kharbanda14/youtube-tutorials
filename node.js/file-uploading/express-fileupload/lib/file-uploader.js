const path = require('path');

/**
 * File Uploader
 */
module.exports = (file) => {
    return new Promise(function(resolve, reject) {
    file.mv(path.join(__dirname, "../uploads", file.name), function(err) {
      if (err) {
        return reject(err);
      }
      return resolve({
        name: file.name,
        size: file.size
      });
    });
  });
}