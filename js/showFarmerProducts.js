function showOrders(pid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/showFarmerProducts.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var content = document.getElementById("content");
            content.innerHTML = "";
           content.innerHTML += "<div> <label>Crop name: </label> "+json.cropName+"</div>";
            content.innerHTML += "<div> <label>Remaining: </label> "+json.remaining+"</div>";
            content.innerHTML += "<div> <label>Price per Unit: </label> "+json.pricePerUnit+"</div>";
            content.innerHTML += "<div> <label>Organic: </label> "+json.organic+"</div>";
            content.innerHTML += "<div> <label>Average rating: </label> "+json.rating+"</div>";
            content.innerHTML += "<div> <label>Product rating: </label> "+json.rating+"</div>";
          }
    }
    xhr.send("pid="+pid);
}