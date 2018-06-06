function search(){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/renderSubs.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    // Join data
    var cropType =  document.getElementById("cropType");
    var cropName =  document.getElementById("cropName");
    var priceRange =  document.getElementById("priceRange");
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
    var data = JSON.stringify({"cropType":cropType,"cropName":cropName,"minPrice":minPrice,"maxPrice":maxPrice});
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var subs = document.getElementById("subs");
            // render subscriptions
            subs.innerHTML = "";
            for(var data in json['subs']){
                var contents = {price:json['subs'][data].price, 
                unit:json['subs'][data].unit,quantityPerSub:json['subs'][data].quantityPerSub,
                 period:json['subs'][data].period, cropName:json['subs'][data].cropName, farmer:json['subs'][data].farmer};
                var title = json['subs'][data].cropName + " from " + json['subs'][data].farmer;
                if(title.length > 15){
                    subs.innerHTML += formSubscriptionPost(title.substring(0,15) + "...", contents, json['subs'][data].subid);
                }
                else{
                    subs.innerHTML += formSubscriptionPost(title, contents, json['subs'][data].subid);
                }
            } 
            if(json['subs'].length == 0){
                subs.innerHTML += "Nothing to show";
            }  
        }
    }
    xhr.send("data="+data);
}