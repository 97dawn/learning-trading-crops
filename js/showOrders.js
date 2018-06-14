function showOrders(orid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/showOrders.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var content = document.getElementById("content");
            content.innerHTML = "";
            content.innerHTML += "<div> <label>Ordered crop: </label> "+json.cropName+"</div>";
            content.innerHTML += "<div> <label>Producer: </label> "+json.farmer+"</div>";
            content.innerHTML += "<div> <label>Order date: </label> "+json.orderDate+"</div>";
            content.innerHTML += "<div> <label>Ordered amount: </label> "+json.amount+" "+json.unit+"</div>";
            content.innerHTML += "<div> <label>Raw total price: </label> "+json.rawTotalPrice+" won</div>";
            content.innerHTML += "<div> <label>Discount rate: </label> "+json.discountRate+"%</div>";
            content.innerHTML += "<div> <label>Extra charge: </label> "+json.extraCharge+" won</div>";
            content.innerHTML += "<div> <label>Final total price: </label> "+json.totalPrice+" won</div>";
            content.innerHTML += "<div> <label>Product rating: </label> "+json.avgRating+"</div>";
          }
    }
    xhr.send("orid="+orid);
}