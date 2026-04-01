// ===============================
// 1. FOR LOOP
// ===============================

console.log("FOR LOOP:");

for (let i = 1; i <= 5; i++) {
    console.log("For Loop:", i);
}


// ===============================
// 2. WHILE LOOP
// ===============================

console.log("\nWHILE LOOP:");

let j = 1;

while (j <= 5) {
    console.log("While Loop:", j);
    j++;
}


// ===============================
// 3. DO WHILE LOOP
// ===============================

console.log("\nDO WHILE LOOP:");

let k = 1;

do {
    console.log("Do While Loop:", k);
    k++;
} while (k <= 5);


// ===============================
// 4. FOR...IN LOOP (Object)
// ===============================

console.log("\nFOR...IN LOOP:");

let student = {
    name: "Ahmed",
    age: 18,
    city: "Karachi",
    education: {
        school: "ABC School",
        class: "10th"
    },
    skills: {
        programming: "JavaScript",
        design: "Photoshop"
    },
    hobies: {
        sports: "Football",
        music: "Guitar"
    }
};


for (let key in student) {

    if (typeof student[key] === "object") {
        console.log(key + ":");

        for (let inderKey in student[key]) {
            console.log("  " + inderKey + ":" + student[key][inderKey]);
        }
    } else {
        console.log(key + ":" + student[key]);
    }

}

// ===============================
// 5. FOR...OF LOOP (Array)
// ===============================

console.log("\nFOR...OF LOOP:");

let numbers = [10, 20, 30, 40, 50,];

for (let value of numbers) {
    console.log("For Of Loop:", value);
}

// ===============================
// 5. FOR...OF LOOP (String)
// ===============================

console.log("\nFOR...OF LOOP:");

let string = "Hello World";

for (let value of string) {
    console.log("For Of Loop:", value);
}