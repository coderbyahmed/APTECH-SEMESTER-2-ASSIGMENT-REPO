
// This is a menu data string in XML format
var xmlData = `
<menu>
    <item>
        <name>laptop</name>
        <price>10,000</price>
        <qty>6</qty>
        <description>this is a laptop</description>
    </item>
    <item>
        <name>mobile</name>
        <price>5,000</price>
        <qty>10</qty>
        <description>this is a mobile</description>
    </item>
    <item>
        <name>tablet</name>
        <price>7,000</price>
        <qty>8</qty>
        <description>this is a tablet</description>
    </item>
    <item>
        <name>pc</name>
        <price>10,000</price>
        <qty>6</qty>
        <description>this is a pc</description>
    </item>
    <item>
        <name>headphone</name>
        <price>1,000</price>
        <qty>12</qty>
        <description>this is a headphone</description>
    </item>
    <item>
        <name>speaker</name>
        <price>2,000</price>
        <qty>5</qty>
        <description>this is a speaker</description>
    </item>
    <item>
        <name>monitor</name>
        <price>3,000</price>
        <qty>7</qty>
        <description>this is a monitor</description>
    </item>
    <item>
        <name>keyboard</name>
        <price>500</price>
        <qty>15</qty>
        <description>this is a keyboard</description>
    </item>
</menu>`

// Create new DOMParser object to convert XML string
var parser = new DOMParser();

// Convert XML string to XML document so we can use DOM methods
var parserDataConvertToString = parser.parseFromString(xmlData, "text/xml");

// Find h1 element in the HTML page
var heading = document.getElementById("h1");

// Get all item tags from XML
var items = parserDataConvertToString.getElementsByTagName("item");

// Get all name tags from XML
var names = parserDataConvertToString.getElementsByTagName("name");

// Get all price tags from XML
var price = parserDataConvertToString.getElementsByTagName("price");

// Get all qty tags from XML
var qty = parserDataConvertToString.getElementsByTagName("qty");

// Get all description tags from XML
var description = parserDataConvertToString.getElementsByTagName("description");

// Loop through each item
for (var i = 0; i < items.length; i++) {
    // Add product name to heading
    heading.innerHTML += `<h2> Name: ${names[i].textContent}</h2>`;

    // Add price to heading
    heading.innerHTML += `<p>Price: ${price[i].textContent}</p>`;

    // Add quantity to heading
    heading.innerHTML += `<p>Quantity: ${qty[i].textContent}</p>`;

    // Add description to heading
    heading.innerHTML += `<p>Description: ${description[i].textContent}</p>`;

    // Add line break to separate items
    heading.innerHTML += `<hr>`;
}


