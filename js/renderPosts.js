function search(){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/renderPosts.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    // Join data
    var cropType =  document.getElementById("cropType");
    var cropName =  document.getElementById("cropName");

    if(cropType.innerHTML.split(" ▼")[0] =="Doesn't matter"){
        cropType = "null";
    }
    else{
        cropType = cropType.innerHTML.split(" ▼")[0].toLowerCase();
    }
    if(cropName.innerHTML.split(" ▼")[0] =="Doesn't matter"){
        cropName = "null";
    }
    else{
        cropName = cropName.innerHTML.split(" ▼")[0];
    }
    
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var posts = document.getElementById("posts");
            posts.innerHTML = "";
            // render posts
            for(var data in json['posts']){
                var contents = {author:json['posts'][data].author, cropName:json['posts'][data].cropName};
                if(json['posts'][data].title.length > 19){
                    posts.innerHTML += formLearningPost(json['posts'][data].title.substring(0,19) + "...", contents, json['posts'][data].postid);
                }
                else{
                    posts.innerHTML += formLearningPost(json['posts'][data].title, contents, json['posts'][data].postid);
                }
            }
            if(json['posts'].length == 0){
                posts.innerHTML += "Nothing to show";
            }           
        }
    }
    xhr.send("cropType="+cropType+"&cropName="+cropName);
}