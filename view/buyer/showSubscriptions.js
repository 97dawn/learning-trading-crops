function showSubscriptions(subid, cropName, farmer){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/showSubscriptions.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var content = document.getElementById("content");
            content.innerHTML = "";
            content.innerHTML += "<div> <label>Subscribing crop: </label> "+json.cropName+"</div>";
            content.innerHTML += "<div> <label>Producer: </label> "+json.farmer+"</div>";
            content.innerHTML += "<div> <label>Subscription start date: </label> "+json.startDate+"</div>";
            content.innerHTML += "<div> <label>Subscription amount: </label> "+json.quantity+" "+json.unit+" </div>";
            content.innerHTML += "<div> <label>Subscription price: </label> "+json.price+" won</div>";
            content.innerHTML += "<div> <label>Frequency: </label> Once per "+json.subPeriod+" "+ json.periodUnit+"</div>";
            content.innerHTML += "<button onclick=\"finishSubscription("+subid+");\" style=\"background-color:red;width:100px;text-align:center;color:white;\">Finish</button>";
          }
    }
    xhr.send("subid="+subid);
}
