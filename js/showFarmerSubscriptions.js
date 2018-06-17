function showFarmerSubscription(subid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/showFarmerSubscriptions.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var content = document.getElementById("content");
            var allSubscriber = "";
            var displaySubscriber = json.subscribers;
            for (var i=0; i<displaySubscriber.length; i++){
                allSubscriber += displaySubscriber[i];
                if(displaySubscriber.length>1){
                    allSubscriber+=", ";
                }
            }
            content.innerHTML = "";
           content.innerHTML += "<div> <label>Crop name: </label> "+json.cropName+"</div>";
            content.innerHTML += "<div> <label>Quantity per subscription: </label> "+json.quantityPerSub+"</div>";
            content.innerHTML += "<div> <label>Price: </label> "+json.price+"</div>";
            content.innerHTML += "<div> <label>Subscription Period: </label> "+json.subPeriod+"</div>";
            content.innerHTML += "<div> <label>Currently Subscribed by ("+json.subscriberNum+"): </label> "+allSubscriber+"</div>";
            content.innerHTML += "<button onclick=\"delete_subscription("+subid+");\" style=\"background-color:red;width:200px;text-align:center;color:white;\">Delete Subscription</button><br>";
          }
    }
    xhr.send("subid="+subid);
}

function delete_subscription(subid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/delete_subscription.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var answer = xhr.responseText;
            if(answer == "success"){
                alert("Successfully Deleted Subscription");
                location.reload();
            }
            else{
                alert("ERROR");
            }
        }
    }
    xhr.send("subid="+subid);
}