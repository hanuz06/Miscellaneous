class G964 {
  public static nbDig(n: number, d: number) {
    // your code
    //let count: number = 0;
    let squaredString: string = "";
    for (let i = 0; i <= n; i++) {
      squaredString += (i * i).toString();
    }
    console.log(squaredString)
    //Another solution
    // squaredString.split("").map((i: string) => {
    //   i === d.toString() ? (count += 1) : 0;
    // });
    // console.log(count);
    console.log(squaredString.split("" + d).length-1);
    return squaredString.split("" + d).length-1;
  }
}

G964.nbDig(10, 1);

let myAdd: (x: number, y: number) => number =
    function(x: number, y: number): number { return x + y; };
