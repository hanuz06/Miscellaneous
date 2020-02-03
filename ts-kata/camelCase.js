"use strict";
const pascalCase = (str) => str
    .trim()
    .split(" ")
    .map(word => (word ? word[0].toUpperCase() + word.slice(1) : ""))
    .join("");
pascalCase("test case"); //"TestCase"
pascalCase(""); //""
pascalCase("camel case method"); //"CamelCaseMethod"
pascalCase("say hello "); //"SayHello"
pascalCase(" camel case word"); //"CamelCaseWord"
