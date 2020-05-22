const path = require("path");
const fileUploader = require("../lib/file-uploader");

module.exports = {
  home: (req, res) => {
    res.sendFile(path.join(__dirname, "../views/index.html"));
  },

  upload: async (req, res, next) => {
    /**
     * Image Object
     */
    const images = req.files.images;

    /**
     * Array of images that are uploaded.
     */
    let uploaded = [];

    try {
      if (Array.isArray(images)) {
        for (let image of images) {
          uploaded.push(await fileUploader(image));
        }
      } else {
        uploaded.push(await fileUploader(images));
      }
      res.sendFile(path.join(__dirname, "../views/success.html"));
    } catch (error) {
      next(error);
    }
  },
};
