function search(){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../app/renderPosts.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    // Join data
    var cropType =  document.getElementById("cropType");
    var cropName =  document.getElementById("cropName");
    cropType = cropType.value;
    cropName = cropName.value;
    var data = JSON.stringify({"cropType":cropType,"cropName":cropName});
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var posts = document.getElementById("posts");
            posts.innerHTML = "";
            // render posts
            for(var data in json['posts']){
                var contents = {author:data.author, cropName:data.cropName};
                if(data.title.length > 19){
                    posts.innerHTML += formLearningPostFarmer(data.title.substring(0,19) + "...", contents, data.postid);
                }
                else{
                    posts.innerHTML += formLearningPostFarmer(data.title, contents, data.postid);
                }
            }           
        }
    }
    xhr.send("data="+data);
}