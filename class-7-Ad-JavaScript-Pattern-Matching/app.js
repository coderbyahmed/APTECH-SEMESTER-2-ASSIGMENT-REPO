    function extractEmails() {
        let text = document.getElementById("text").value;

        let pattern = /[\w.-]+@[\w.-]+\.\w+/g;

        let emails = text.match(pattern);

        let resultDiv = document.getElementById("result");
        let countDiv = document.getElementById("count");

        if (emails) {
            // remove duplicates
            let uniqueEmails = [...new Set(emails)];

            resultDiv.innerHTML = uniqueEmails.map(e => `<div class="email">${e}</div>`).join("");

            countDiv.innerText = `Found ${uniqueEmails.length} email(s)`;
        } else {
            resultDiv.innerHTML = "No emails found";
            countDiv.innerText = "";
        }
    }