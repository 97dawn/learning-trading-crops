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
            // render posts
        }
    }
    xhr.send("data="+data);
}