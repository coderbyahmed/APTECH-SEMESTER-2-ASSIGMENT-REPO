// ye export default hai, isme sirf ek hi cheez export kar sakte hain
function calculation(a, b) {
    return a + b;
}

export default calculation;


// ye named export hai, isme multiple cheeze export kar sakte hain
function calculation(a, b) {
    return a + b;
}

function sum(a, b) {
    return a - b;
}

export { calculation, sum };

// // CommonJS module system
function calculation(a, b) {
    return a + b;
}

function sum(a, b) {
    return a - b;
}

// export کرنا
module.exports = {
    calculation,
    sum
};