function showStores(cartid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/showStores.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var content = document.getElementById("content");
            content.innerHTML = "";
            content.innerHTML += "<div> <label>Saved crop: </label> "+json.cropName+"</div>";
            content.innerHTML += "<div> <label>Producer: </label> "+json.farmer+"</div>";
            content.innerHTML += "<div> <label>Saved amount: </label> "+json.amount+" "+json.unit+"</div>";
            content.innerHTML += "<div> <label>Raw total price: </label> "+json.rawTotalPrice+" won</div>";
            content.innerHTML += "<div> <label>Discount rate: </label> "+json.discountRate+"%</div>";
            content.innerHTML += "<div> <label>Extra charge: </label> "+json.extraCharge+" won</div>";
            content.innerHTML += "<div> <label>Expected final total price: </label> "+json.totalPrice+" won</div>";
            content.innerHTML += "<div> <label>Product rating: </label> "+json.avgRating+"</div>";
            content.innerHTML += "<button onclick=\"orderInCart("+cartid+");\" style=\"background-color:red;width:100px;text-align:center;color:white;\">Order</button>";
          }
    }
    xhr.send("cartid="+cartid);
}
