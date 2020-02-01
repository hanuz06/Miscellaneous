// const person: {
//   name: string;
//   age: number;
// } = {
// const person: {
//   name: string;
//   age: number;
//   hobbies: string[];
//   role: [number, string]
// } = {
//   name: "Andrey",
//   age: 44,
//   hobbies: ["Sports", "Cooking"],
//   role: [2, "author"]
// };

enum Role {
  ADMIN = 1,
  READ_ONLY,
  AUTHOR
}

const person = {
  name: "Andrey",
  age: 44,
  hobbies: ["Sports", "Cooking"],
  role: Role.AUTHOR
};

// person.role.push("admin");
// person.role[1] = 10;
console.log(person);
// person.role = [0, 'admin', 'user'];

let favoriteActivities: string[];
favoriteActivities = ["sport"];

console.log(person.name);

for (const hobby of person.hobbies) {
  console.log(hobby.toUpperCase());
}

if (person.role === Role.ADMIN) {
  console.log("is admin");
} else if (person.role === Role.AUTHOR) {
  console.log("is author");
} else {
  console.log("is read only");
}
