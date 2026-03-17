fetch("data.json")
  .then(res => res.json())
  .then(data => {

    let html = `
      <table border="1" cellpadding="9">
        <tr>
          <th>Name</th>
          <th>Father Name</th>
          <th>Age</th>
          <th>City</th>
          <th>Address</th>
        </tr>
    `;

    data.studentData.forEach(s => {
      html += `
        <tr>
          <td>${s.name}</td>
          <td>${s.fathername}</td>
          <td>${s.age}</td>
          <td>${s.city}</td>
          <td>${s.address}</td>
        </tr>
      `;
    });

    html += `</table>`;

    document.getElementById("students").innerHTML = html;

  });