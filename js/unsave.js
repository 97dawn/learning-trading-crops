function unsave(postid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/unsave.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var answer = xhr.responseText;
            if(answer == "success"){
                alert("Unsave post successfully");
            }
            else{
                alert("ERROR");
            }
        }
    }
    xhr.send("postid="+postid);
}