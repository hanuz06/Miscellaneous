/* Given an array (arr) as an argument complete the function countSmileys that should return the total number of smiling faces.
Rules for a smiling face:
-Each smiley face must contain a valid pair of eyes. Eyes can be marked as : or ;
-A smiley face can have a nose but it does not have to. Valid characters for a nose are - or ~
-Every smiling face must have a smiling mouth that should be marked with either ) or D.
No additional characters are allowed except for those mentioned.
Valid smiley face examples:
:) :D ;-D :~)
Invalid smiley faces:
;( :> :} :] 
Note: In case of an empty array return 0. You will not be tested with invalid input (input will always be an array). Order of the face (eyes, nose, mouth) elements will always be the same*/

//return the total number of smiling faces in the array
function countSmileys(arr: string[]) {
  let count: number = 0;
  arr.map(face => {
    let face1: string = "";
    if (face.length === 3) {
      face[0] === ":" || face[0] === ";" ? (face1 += ":") : face1;
      face[1] === "-" || face[1] === "~" ? (face1 += "-") : face1;
      face[2] === ")" || face[2] === "D" ? (face1 += ")") : face1;
    } else {
      face[0] === ":" || face[0] === ";" ? (face1 += ":") : face1;
      face[1] === ")" || face[1] === "D" ? (face1 += ")") : face1;
    }
    face.length === face1.length ? count++ : count;
  });
  console.log(count);
  return count;
}

countSmileys([]); //0
countSmileys([":D", ":~)", ";~D", ":)"]); //4
countSmileys([":)", ":(", ":D", ":O", ":;"]); //2
countSmileys([";]", ":[", ";*", ":$", ";-D"]); //1
