function writeReview(review, reviewBody, rating){
    var pid = review.value;
    reviewBody = reviewBody.value;
    rating = rating.innerHTML.split(" ▼")[0];
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/writeReview.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var pageHTML = "";
            var reviews = document.getElementById("reviews");
            if(json.reviews.length > 0){
                reviews.innerHTML = "";
                for (var r in json.reviews){
                    pageHTML +="<div class=\"row\">";
                    pageHTML += "<label id=\"label\">Reviewer</label>";
                    pageHTML += "<div id=\"content\">"+json.reviews[r].reviewAuthor+"</div>";
                    pageHTML += "</div>";
                    pageHTML +="<div class=\"row\">";
                    pageHTML += "<label id=\"label\">Product rating</label>";
                    pageHTML += "<div id=\"content\">"+json.reviews[r].rating+"</div>";
                    pageHTML += "</div>";
                    pageHTML +="<div class=\"row\" style=\"margin-bottom:30px;\">";
                    pageHTML += "<label id=\"label\">Review</label>";
                    pageHTML += "<div id=\"content\">"+json.reviews[r].reviewBody+"</div>";
                    pageHTML += "</div>";
                }
                reviews.innerHTML=pageHTML;
            }
            else{
                alert("You already left the review");
            }          
        }
    }
    xhr.send("pid="+pid+"&reviewBody="+reviewBody+"&rating="+rating);
}