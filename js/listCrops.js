function showCropName(cropName){
    var showCropName = document.getElementById("cropName");
    showCropName.innerText = "";
    showCropName.innerText=cropName.value;
}
function listCrops(cropType){
    var cropNames = document.getElementById("cropNames");
    cropNames.innerHTML="";
    document.getElementById("cropName").innerText="Crop Name";
    var showCropType =  document.getElementById("cropType");
    showCropType.innerText = "";
    showCropType.innerText=cropType.value;
    if(cropType.value == "Vegetable"){
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Tomato\">Tomato</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Potato\">Potato</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Kale\">Kale</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Cabbage\">Cabbage</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Carrot\">Carrot</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Celery\">Celery</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Pumpkin\">Pumpkin</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Eggplant\">Eggplant</button></li>";
    }
    else if(cropType.value == "Fruit"){
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Watermelon\">Watermelon</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Strawberry\">Strawberry</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Mango\">Mango</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Lemon\">Lemon</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Grapefruit\">Grapefruit</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Kiwi\">Kiwi</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Apple\">Apple</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Apricot\">Apricot</button></li>";
        cropNames.innerHTML += "<li><button onclick=\"showCropName(this);\" value=\"Avocado\">Avocado</button></li>";
    }
    else if(cropType.value == "Herb"){
        cropNames.innerHTML += "<li><button value=\"Dill\">Dill</button></li>";
    }
    else if(cropType.value == "Nut"){
        cropNames.innerHTML += "<li><button value=\"Pecan\">Pecan</button></li>";
    }
    else if(cropType.value == "Grain"){
        cropNames.innerHTML += "<li><button value=\"Rice\">Rice</button></li>";
    }
}
