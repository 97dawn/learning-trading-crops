function showLearningPost(post){
    var postid = post.value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/showLearningPost.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var pageHTML ="<div class=\"row\" >";
            pageHTML +="<button onclick=\"saveLearningPost(this)\" value=\""+postid+"\"style=\"float:right; background-color:#B2CFEF;color:black;\">Save</button>";
            pageHTML +="</div>";
            pageHTML += "<div class=\"row\">";
            pageHTML += "<label id=\"label\">Title</label>";
            pageHTML += "<div id=\"content\">"+json.title+"</div>";
            pageHTML += "</div>";
            pageHTML += "<div class=\"row\">";
            pageHTML += "<label id=\"label\">Post date</label>";
            pageHTML += "<div id=\"content\">"+json.date+"</div>";
            pageHTML += "</div>";
            pageHTML += "<div class=\"row\">";
            pageHTML += "<label id=\"label\">Crop</label>";
            pageHTML += "<div id=\"content\">"+json.cropName+"</div>";
            pageHTML += "</div>";
            pageHTML += "<div class=\"row\">";
            pageHTML += "<label id=\"label\">Author name</label>";
            pageHTML += "<div id=\"content\">"+json.authorName+"</div>";
            pageHTML += "</div>";
            pageHTML += "<div class=\"row\">";
            pageHTML += "<label id=\"label\">How to grow</label>";
            pageHTML += "<div id=\"content\">"+json.cropInfo+"</div>";
            pageHTML += "</div>";
            pageHTML += "<div class=\"row\">";
            pageHTML += "<label id=\"label\">Usages</label>";
            pageHTML += "<div id=\"content\">"+json.uses+"</div>";
            pageHTML += "</div>";
            pageHTML += "<div class=\"row\">";
            pageHTML += "<label id=\"label\">Diseases</label>";
            pageHTML += "<div id=\"content\">"+json.disease+"</div>";
            pageHTML += "</div>";
            var modal = document.getElementById('myModal');
            var text = document.getElementById('texts');
            text.innerHTML = pageHTML;
            var btn = document.getElementById(post.getAttribute('id'));
            btn.onclick = function() {
                modal.style.display = "block";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    }
    xhr.send("postid="+postid);
}