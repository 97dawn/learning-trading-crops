function formLearningPost(title, contents, id){
    var postStart = "<div class=\"post\">";
    var postTitle = "<button style=\"overflow-wrap: break-word;width:100%;\" onclick=\"showLearningPost(this)\" value=\""+id+"\">"+title+"</button>";
    var postContent = "";
    var postEnd = "</div>";
    postContent += "<h5> Author: "+contents.author+"</h5>";
    postContent += "<h5> Crop: "+contents.cropName+"</h5>"; 
    postContent += "<button style=\"overflow-wrap: break-word;width:100%;background-color:#B2CFEF\" onclick=\"saveLearningPost(this)\" value=\""+id+"\">Save</button>";
    return postStart + postTitle + postContent + postEnd;
}
function formLearningPostFarmer(title, contents, id){
    var postStart = "<div class=\"post\">";
    var postTitle = "<button style=\"overflow-wrap: break-word;width:100%;\" onclick=\"showLearningPostFarmer(this)\" value=\""+id+"\">"+title+"</button>";
    var postContent = "";
    var postEnd = "</div>";
    postContent += "<h5> Author: "+contents.author+"</h5>";
    postContent += "<h5> Crop: "+contents.cropName+"</h5>"; 
    postContent += "<button style=\"overflow-wrap: break-word;width:100%;background-color:#B2CFEF\" onclick=\"saveLearningPost(this)\" value=\""+id+"\">Save</button>";
    return postStart + postTitle + postContent + postEnd;
}
function formProductPost(title, contents, id){
    var postStart = "<div class=\"post\">";
    var postTitle = "<h3>"+title+"</h3>";
    var postContent = "";
    var postEnd = "</div>";
    postContent += "<h5> Farmer Reputation: "+contents.freputation+"</h5>";
    postContent += "<h5> Product Reputation: "+contents.preputation+"</h5>";
    postContent += "<h5> Unit: "+contents.unit+"</h5>";
    postContent += "<h5 id=\"pricePerUnit\" value=\""+contents.price+"\"> Price Per Unit: "+contents.price+" won </h5>"; 
    postContent += "<div><label> Quanitity: </label>";
    if(contents.unit == "kg"){
        postContent += "<input id=\"quantity\" type=\"text\"></div>";
    }
    else{
        postContent += "<input id=\"quantity\" type=\"number\"></div>";
    }
    postContent += "<div><button style=\"overflow-wrap: break-word;width:60%;float:left;background-color:#EFB2B4\" onclick=\"addToCart(this)\" value=\""+id+"\">Add to Cart</button>";
    postContent += "<button style=\"overflow-wrap: break-word;width:40%;float:left;background-color:#B2CFEF\" onclick=\"order(this)\" value=\""+id+"\">Order</button></div>";
    return postStart + postTitle + postContent + postEnd;
}
function formSubscriptionPost(title, contents, id){
    var postStart = "<div class=\"post\">";
    var postTitle = "<h3>"+title+"</h3>";
    var postContent = "";
    var postEnd = "</div>";
    postContent += "<h5> Farmer Reputation: "+contents.reputation+" </h5>";
    postContent += "<h5> Price: "+contents.price+" won </h5>";
    postContent += "<h5> Quantity Per Subscription: "+contents.quantityPerSub+" "+contents.unit+" </h5>";
    postContent += "<h5> Period: once per "+contents.period+" month(s) </h5>";
    postContent += "<button style=\"overflow-wrap: break-word;width:100%;background-color:#B2CFEF\" value=\""+id+"\" onclick=\"subscribe(this)\">Subscribe</button>";
    return postStart + postTitle + postContent + postEnd;
}