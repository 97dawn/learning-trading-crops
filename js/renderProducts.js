function search(){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../app/renderProducts.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    // Join data
    var cropType =  document.getElementById("cropType");
    var cropName =  document.getElementById("cropName");
    var priceRange =  document.getElementById("priceRange");
    var rating =  document.getElementById("rating");
    var isOrganic =  document.getElementById("isOrganic");
    cropType = cropType.value;
    cropName = cropName.value;
    priceRange = priceRange.value;
    rating = rating.value;
    if(!isNaN(rating)){
        rating = parseInt(rating);
    }
    isOrganic = isOrganic.value;
    var minPrice = 0;
    var maxPrice = -1;
    if(priceRange.includes("-")){
        priceRange = priceRange.split("-");
        minPrice = parseInt(priceRange[0]);
        maxPrice = parseInt(priceRange[1]);
    }
    else{
        if(priceRange.includes("below")){
            priceRange = priceRange.split(" ");
            maxPrice = parseInt(priceRange[1]);
        }
        else if(priceRange.includes("above")){
            priceRange = priceRange.split(" ");
            minPrice = parseInt(priceRange[0]);
        }
        else{
            minPrice = -1;
        }
    }
    var data = JSON.stringify({"cropType":cropType,"cropName":cropName,"minPrice":minPrice,"maxPrice":maxPrice, "rating":rating, "isOrganic":isOrganic});
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var products = document.getElementById("products");
            // render products
        }
    }
    xhr.send("data="+data);
}