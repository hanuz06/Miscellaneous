"use strict";
// const cars: string[] = ["Ford", "Audi"];
// const cars2: Array<string> = ["Ford", "Audi"];
function createAndValidateCar(model, year) {
    const car = {};
    if (model.length > 3) {
        car.model = model;
    }
    if (year > 2000) {
        car.year = year;
    }
    return car;
}
//=========================================
const cars = ["Ford", "Audi"];
// cars.shift();
// cars[1]
const ford = {
    model: "Ford",
    year: 2020
};
// ford.model = 'Ferrari';
//=========================================
//# sourceMappingURL=generic.js.map