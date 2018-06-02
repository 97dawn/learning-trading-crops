function saveLearningPost(post){
    var postid = post.value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../app/saveLearningPost.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var answer = xhr.responseText;
            if(answer == "true"){
                alert("Successfully saved the post.");
            }
            else{
                alert("ERROR");
            }
        }
    }
    xhr.send("postid="+postid);
}