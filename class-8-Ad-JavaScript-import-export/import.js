// ye export default import ho raha hai, 
import calculation from './app.js';

console.log(calculation(20, 30));


// // ye named export import ho raha hai,
import { calculation, sum } from './app.js';

console.log(calculation(20, 30));
console.log(sum(20, 30));

// // CommonJS module system import ho raha hai,
const { calculation, sum } = require('./app.js');

console.log(calculation(20, 30)); // 50
console.log(sum(20, 30));         // -10