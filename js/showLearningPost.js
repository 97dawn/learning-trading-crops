function showLearningPost(post){
    var postid = post.value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/showLearningPost.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var texts ="<div class=\"row\" >";
            texts +="<button onclick=\"saveLearningPost(this)\" value=\""+postid+"\"style=\"float:right; background-color:#B2CFEF;color:black;\">Save</button>";
            texts +="</div>";
            texts += "<div class=\"row\">";
            texts += "<label id=\"label\">Title</label>";
            texts += "<div id=\"content\">"+json.title+"</div>";
            texts += "</div>";
            texts += "<div class=\"row\">";
            texts += "<label id=\"label\">Post date</label>";
            texts += "<div id=\"content\">"+json.date+"</div>";
            texts += "</div>";
            texts += "<div class=\"row\">";
            texts += "<label id=\"label\">Crop</label>";
            texts += "<div id=\"content\">"+json.cropName+"</div>";
            texts += "</div>";
            texts += "<div class=\"row\">";
            texts += "<label id=\"label\">Author name</label>";
            texts += "<div id=\"content\">"+json.authorName+"</div>";
            texts += "</div>";
            texts += "<div class=\"row\">";
            texts += "<label id=\"label\">How to grow</label>";
            texts += "<div id=\"content\">"+json.cropInfo+"</div>";
            texts += "</div>";
            texts += "<div class=\"row\">";
            texts += "<label id=\"label\">Usages</label>";
            texts += "<div id=\"content\">"+json.uses+"</div>";
            texts += "</div>";
            texts += "<div class=\"row\">";
            texts += "<label id=\"label\">Diseases</label>";
            texts += "<div id=\"content\">"+json.disease+"</div>";
            texts += "</div>";
            var comments = "";
            for (var comment in json.comments){
                comments +="<div class=\"row\">";
                comments += "<label id=\"label\">Commenter</label>";
                comments += "<div id=\"content\">"+json.comments[comment].commenterName+"</div>";
                comments += "</div>";
                comments +="<div class=\"row\" style=\"margin-bottom:30px;\">";
                comments += "<label id=\"label\">Comment</label>";
                comments += "<div id=\"content\">"+json.comments[comment].commentBody+"</div>";
                comments += "</div>";
            }
            comments += "</div>";
            var modal = document.getElementById('myModal');
            document.getElementById('texts').innerHTML = texts;
            document.getElementById('comments').innerHTML = comments;
            document.getElementById("submit").value=postid;
            modal.style.display = "block";
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    }
    xhr.send("postid="+postid);
}