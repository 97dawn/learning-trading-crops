function showSavedPosts(postid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/showSavedPosts.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var content = document.getElementById("content");
            content.innerHTML = "";
            content.innerHTML += "<div> <label>Title: </label> "+json.title+"</div>";
            content.innerHTML += "<div> <label>Post date: </label> "+json.postDate+"</div>";
            content.innerHTML += "<div> <label>Author name: </label> "+json.authorName+"</div>";
            content.innerHTML += "<div> <label>Crop: </label> "+json.cropName+"</div>";
            content.innerHTML += "<div> <label>How to grow: </label> "+json.cropInfo+"</div>";
            content.innerHTML += "<div> <label>Usages: </label> "+json.uses+"</div>";
            content.innerHTML += "<div> <label>Diseases: </label> "+json.disease+"</div>";
            content.innerHTML += "<button onclick=\"unsave("+postid+");\" style=\"background-color:red;width:100px;text-align:center;color:white;\">Unsave</button><br>";
          }
    }
    xhr.send("postid="+postid);
}