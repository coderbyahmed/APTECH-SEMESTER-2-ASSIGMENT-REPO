var xmlData =`<Products>
    <product category="electronic">
        <name>fridge</name>
        <price>3000</price>
       
    </product>
    <product  category="wooden">
        <name>table</name>
        <price>300</price>
     
    </product>
    <product  category="electronic">
        <name>Ac</name>
        <price>4000</price>
         
    </product>
   
</Products>`


var parser = new DOMParser();
// var p=document.getElementById('p1')

var parsedData = parser.parseFromString(xmlData, "text/xml")

var xpath = parsedData.evaluate('/Products/product[@category="electronic"]/name', parsedData, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null)


for (let i = 0; i < xpath.snapshotLength; i++){
    console.log(xpath.snapshotItem(i).textContent)
   
}