function showFarmerProducts(pid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/showFarmerProducts.php", true);
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
            var allDiscount = json.discounts;
            var displayDiscount = "";
            var displayRating = json.rating;
            var displayOrganic = json.organic;
            if(json.organic==0){
                displayOrganic = "No";
            }
            if(json.organic==1){
                displayOrganic = "Yes";
            }
            if(json.rating==null){
                displayRating = "This product currently has no rating";
            }
            for(var x=0; x<allDiscount.length; x++){
                var minQuan = allDiscount[x][0];
                var rate = allDiscount[x][1];
                displayDiscount += "<li>Rate:"+rate+" - Minimum quantity: "+minQuan+"</li>";
            }
            content.innerHTML = "";
           content.innerHTML += "<div> <label>Crop name: </label> "+json.cropName+"</div>";
            content.innerHTML += "<div> <label>Remaining: </label> "+json.remaining+"</div>";
            content.innerHTML += "<div> <label>Price per Unit: </label> "+json.pricePerUnit+"</div>";
            content.innerHTML += "<div> <label>Organic: </label> "+displayOrganic+"</div>";
            content.innerHTML += "<div> <label>Discount rates on Product: </label></div>";
            content.innerHTML += "<div> <ul>"+displayDiscount+"</ul></div>";
            content.innerHTML += "<div> <label>Product rating: </label> "+displayRating+"</div>";
            content.innerHTML += "<div> <label>Product is ordered by ("+json.subscriberNum+"): </label> "+allSubscriber+"</div>";
            content.innerHTML += "<button onclick=\"delete_product("+pid+");\" style=\"background-color:red;width:200px;text-align:center;color:white;\">Delete Product</button><br>";
          }
    }
    xhr.send("pid="+pid);
}

function delete_product(postid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/delete_product.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var answer = xhr.responseText;
            if(answer == "success"){
                alert("Successfully Deleted Product");
                location.reload();
            }
            else{
                alert("ERROR");
            }
        }
    }
    xhr.send("postid="+postid);
}