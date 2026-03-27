// condition1 

let age = 18;

let result = age >= 18 ? "Adult" : "Child";

console.log(result);

// condition2

var userLoggin1 = true;

var userUpdate1 = userLoggin1 == true ? "userLoggin" : "userLogOut";

console.log(userUpdate1);

// condition3 

var userLoggin2 = true;

var userUpdate2 = userLoggin2 == true ? "userLoggin" : userLoggin2 !== false ? "userLogOut" : 'user to gaya';

console.log(userUpdate2);

// condition4

let marks = 85;

let grade = marks >= 90 ? "A" : marks >= 75 ? "B" : marks >= 50 ? "C" : "Fail";
  
console.log(grade);

// condition5

let isLoggedIn = true;

let message = isLoggedIn !== false ? "Welcome Back!" : "Please Login";

console.log(message);