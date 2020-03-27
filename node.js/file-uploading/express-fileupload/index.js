const express = require("express");
const app = express();
const path = require("path");
const controller = require("./controllers/index");

app.use(require("express-fileupload")({}));

app.get("/", controller.home);
app.post("/upload", controller.upload);


app.listen(3000, () => {
  console.log("Server Started");
});
