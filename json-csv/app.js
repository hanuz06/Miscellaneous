const fs = require("fs");
const path = require("path");
// const student = require("./one.json");

fs.writeFile("one.txt", "andrey li", (err) => {
  if (err) console.log("Error");
});
