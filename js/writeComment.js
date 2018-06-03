function writeComment(comment, commentBody){
    var postid = comment.value;
    commentBody = commentBody.value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/writeComment.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var pageHTML = "";
            var comments = document.getElementById("comments");
            if(json.comments.length > 0){
                comments.innerHTML = "";
                for (var comment in json.comments){
                    pageHTML +="<div class=\"row\">";
                    pageHTML += "<label id=\"label\">Commenter</label>";
                    pageHTML += "<div id=\"content\">"+json.comments[comment].commenterName+"</div>";
                    pageHTML += "</div>";
                    pageHTML +="<div class=\"row\" style=\"margin-bottom:30px;\">";
                    pageHTML += "<label id=\"label\">Comment</label>";
                    pageHTML += "<div id=\"content\">"+json.comments[comment].commentBody+"</div>";
                    pageHTML += "</div>";
                }
                comments.innerHTML=pageHTML;
            }
            else{
                alert("You already left the comment");
            }          
        }
    }
    xhr.send("postid="+postid+"&commentBody="+commentBody);
}