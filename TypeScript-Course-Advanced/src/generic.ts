// const cars: string[] = ["Ford", "Audi"];
// const cars2: Array<string> = ["Ford", "Audi"];

// const promise: Promise<string> = new Promise(resolve => {
//   setTimeout(() => {
//     resolve("Promise resolved");
//   }, 2000);
// });

// promise.then(data => {
//   console.log(
//     data
//       .toLowerCase()
//       .trim()
//       .toUpperCase()
//   );
// });

// function mergeObjects<T extends object, R extends object>(a: T, b: R) {
//   return Object.assign({}, a, b);
// }

// const merged = mergeObjects({ name: "Andrey" }, { sex: "male" });
// const merged2 = mergeObjects({ model: "Ford" }, { year: 2010 });

// console.log(merged2.model);

// ====================

// interface ILength {
//   length: number;
// }

// function withCount<T extends ILength>(value: T): { value: T; count: string } {
//   return {
//     value,
//     count: `This object contains ${value.length} symbols`
//   };
// }

// console.log(withCount("Hello TypeScript"));
// console.log(withCount(["I", "am", "array"]));
// console.log(withCount({ length: 25 }));
// // console.log(withCount(20));

// ======================
// function getObjectValue<T extends object, R extends keyof T>(obj: T, key: R) {
//   return obj[key]
// }

// const person = {
//   name: 'Andrey',
//   age: 44,
//   job: 'Javascript',
// }
// console.log(getObjectValue(person, 'name'))
// console.log(getObjectValue(person, 'age'))
// console.log(getObjectValue(person, 'job'))

// ======================

// class Collection<T extends number | string | boolean> {
//   constructor(private _items: T[] = []) {}

//   add(item: T) {
//     this._items.push(item);
//   }

//   remove(item: T) {
//     this._items = this._items.filter(i => i !== item);
//   }

//   get items(): T[] {
//     return this._items;
//   }
// }

// const strings = new Collection<string>(["I", "am", "a", "developer"]);
// strings.add("!");
// strings.remove("am");
// console.log(strings.items);

// const numbers = new Collection<number>([1, 3, 45, 65]);
// numbers.add(44);
// numbers.remove(3);
// console.log(numbers.items);

// const objs = new Collection([{ a: 2 }, { b: 23 }]);
// objs.remove({ b: 23 });
// console.log(objs.items);

// =========================================

interface ICar {
  model: string;
  year: number;
}

function createAndValidateCar(model: string, year: number): ICar {
  const car: Partial<ICar> = {};

  if (model.length > 3) {
    car.model = model;
  }

  if (year > 2000) {
    car.year = year;
  }

  return car as ICar;
}
//=========================================

const cars: Readonly<Array<string>> = ["Ford", "Audi"];
// cars.shift();
// cars[1]

const ford: Readonly<ICar> = {
  model: "Ford",
  year: 2020
};

// ford.model = 'Ferrari';

//=========================================

