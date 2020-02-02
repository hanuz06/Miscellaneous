"use strict";
function accum(s) {
    const resultArray = [];
    s.split("").map((i, index) => {
        resultArray.push(i.toUpperCase() + i.toLowerCase().repeat(index));
    });
    console.log(resultArray.join("-"));
    return resultArray.join("-");
}
accum("ZpglnRxqenU");
