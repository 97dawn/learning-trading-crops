function showWrittenPosts(postid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/showWrittenPosts.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var content = document.getElementById("content");
            var allSubscriber = "";
            var displaySubscriber = json.subscribers;
            for (var i=0; i<displaySubscriber.length; i++){
                if(displaySubscriber.length==1 || i==(displaySubscriber.length-1)){
                    allSubscriber += displaySubscriber[i];
                }
                else{
                    allSubscriber += displaySubscriber[i]+", ";
                }
            }
            content.innerHTML = "";
            content.innerHTML += "<div> <label>Title: </label> "+json.title+"</div>";
            content.innerHTML += "<div> <label>Post date: </label> "+json.postDate+"</div>";
            content.innerHTML += "<div> <label>Author name: </label> "+json.authorName+"</div>";
            content.innerHTML += "<div> <label>Crop: </label> "+json.cropName+"</div>";
            content.innerHTML += "<div> <label>How to grow: </label> "+json.cropInfo+"</div>";
            content.innerHTML += "<div> <label>Usages: </label> "+json.uses+"</div>";
            content.innerHTML += "<div> <label>Diseases: </label> "+json.disease+"</div>";
            content.innerHTML += "<div> <label>Currently Saved by ("+json.subscriberNum+"): </label> "+allSubscriber+"</div>";
            content.innerHTML += "<button onclick=\"delete_post("+postid+");\" style=\"background-color:red;width:200px;text-align:center;color:white;\">Delete post</button><br>";
          }
    }
    xhr.send("postid="+postid);
}

function delete_post(postid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/delete_post.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var answer = xhr.responseText;
            if(answer == "success"){
                alert("Delete post successfully");
                location.reload();
            }
            else{
                alert("ERROR");
            }
        }
    }
    xhr.send("postid="+postid);
}