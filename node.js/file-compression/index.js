const zlib = require("zlib");
const fs = require("fs");

const compressFile = (file) => {
  if (!fs.existsSync(file)) {
    console.error(`${file} does not exists`);
    return process.exit(0);
  }

  fs.createReadStream(file)
    .pipe(zlib.createGzip())
    .pipe(fs.createWriteStream(file + ".gz"));
};

const decompressFile = (file) => {
  if (!fs.existsSync(file)) {
    console.error(`${file} does not exists`);
    return process.exit(0);
  }

  fs.createReadStream(file)
    .pipe(zlib.createGunzip())
    .pipe(fs.createWriteStream(file.replace(/\.gz/, "")));
};

// compressFile("file");
// decompressFile("file.gz");
