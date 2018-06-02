function showLearningPostFarmer(post){
    var postid = post.value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../app/showLearningPost.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
                pageHTML ="<div class=\"row\" >";
                pageHTML +="<button onclick=\"saveLearningPost(this)\" value=\""+postid+"\" style=\"float:right; background-color:#B2CFEF;color:black;\">Save</button>";
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
                pageHTML += "<div id=\"content\">"+json.author+"</div>";
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
                pageHTML += "<div id=\"content\">"+json.diseases+"</div>";
                pageHTML += "</div>";
            //var myWindow = window.open("https://thegreatestfarmer.000webhostapp.com/view/farmer/showPost.php", "_self");
            var myWindow = window.open("localhost/305fp/view/farmer/showPost.php", "_self");
            myWindow.document.getElementById("post").write(pageHTML);
        }
    }
    xhr.send("postid="+postid);
}