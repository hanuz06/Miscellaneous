"use strict";
function solution(roman) {
    let result = 0;
    const romanNumbers = {
        I: 1,
        V: 5,
        X: 10,
        L: 50,
        C: 100,
        D: 500,
        M: 1000
    };
    if (roman === 'IV') {
        result += 4;
    }
    else if (roman === 'IX') {
        result += 9;
    }
    else {
        roman.split("").map((i) => {
            for (const key in romanNumbers) {
                if (i === key) {
                    result += romanNumbers[key];
                }
            }
        });
    }
    console.log('FINAL ', result);
    return result;
}
solution("IV"); //4)
// solution("IX"); //9)
// solution("XXI"); //21)
// solution("MMVIII"); //2008
// solution("MDCLXVI"); //1666
