function search(){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/renderProducts.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    // Join data
    var cropType =  document.getElementById("cropType");
    var cropName =  document.getElementById("cropName");
    var priceRange =  document.getElementById("priceRange");
    var rating =  document.getElementById("rating");
    var isOrganic =  document.getElementById("isOrganic");
    if(cropType.innerHTML.split(" ▼")[0] =="Doesn't matter"){
        cropType = "null";
    }
    else{
        cropType = cropType.innerHTML.split(" ▼")[0].toLowerCase();
    }
    if(cropName.innerHTML.split(" ▼")[0] =="Doesn't matter"){
        cropName = "null";
    }
    else{
        cropName = cropName.innerHTML.split(" ▼")[0];
    }
    if(priceRange.innerHTML.split(" ▼")[0] =="Doesn't matter"){
        priceRange = "null";
    }
    else{
        priceRange = priceRange.innerHTML.split(" ▼")[0];
        priceRange = priceRange.split(" won")[0];
    }
    if(rating.innerHTML.split(" ▼")[0] =="Doesn't matter"){
        rating = "null";
    }
    else{
        rating = rating.innerHTML.split(" ");
        rating = parseInt(rating[rating.length-2]);
    }
    
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
    if(isOrganic.innerHTML.split(" ▼")[0] =="Doesn't matter"){
        isOrganic = "null";
    }
    else{
        isOrganic = isOrganic.innerHTML.split(" ▼")[0];
        if(isOrganic == "yes")isOrganic = true;
        else isOrganic = false;
    }
    var data = JSON.stringify({"cropType":cropType,"cropName":cropName,"minPrice":minPrice,"maxPrice":maxPrice, "rating":rating, "isOrganic":isOrganic});
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var products = document.getElementById("products");
            // render products
            products.innerHTML = "";
            for(var data in json['products']){
                isOrganic = "yes";
                if(json['products'][data].isOrganic == 0){
                    isOrganic = "no";
                }
                var contents = {remaining:json['products'][data].remaining,isOrganic:isOrganic,farmer:json['products'][data].farmer,price:json['products'][data].price, preputation:json['products'][data].preputation,freputation:json['products'][data].freputation, unit:json['products'][data].unit};
                var title = json['products'][data].cropName + " from " + json['products'][data].farmer;
                
                if(title.length > 15){
                    products.innerHTML += formProductPost(title.substring(0,15) + "...", contents, json['products'][data].pid);
                }
                else{
                    products.innerHTML += formProductPost(title, contents, json['products'][data].pid);
                }
            }   
            if(json['products'].length == 0){
                products.innerHTML += "Nothing to show";
            }  
        }
    }
    xhr.send("data="+data);
}