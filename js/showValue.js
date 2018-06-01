function showPriceRange(priceRange){
    var showPriceRange = document.getElementById("priceRange");
    showPriceRange.innerText = "";
    showPriceRange.innerText=priceRange.innerText+" ▼";
}
function showRating(rating){
    var showRating = document.getElementById("rating");
    showRating.innerText = "";
    showRating.innerText=rating.innerText+" ▼";
}
function showCropType(ct){
    var showCropType = document.getElementById("ct");
    showCropType.innerText = "";
    showCropType.innerText=rating.innerText+" ▼";
}
function showOrganic(o){
    var showOrganic = document.getElementById("isOrganic");
    showOrganic.innerText = "";
    showOrganic.innerText=o.innerText+" ▼";
}