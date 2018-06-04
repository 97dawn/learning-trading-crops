function seeReviews(product){
    var pid = product.value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/seeReviews.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var json = JSON.parse(xhr.responseText);
            var reviews = "";
            for (var r in json.reviews){
                reviews +="<div class=\"row\">";
                reviews += "<label id=\"label\">Reviewer</label>";
                reviews += "<div id=\"content\">"+json.reviews[r].reviewer+"</div>";
                reviews += "</div>";
                reviews +="<div class=\"row\">";
                reviews += "<label id=\"label\">Product rating</label>";
                reviews += "<div id=\"content\">"+json.reviews[r].rating+"</div>";
                reviews += "</div>";
                reviews +="<div class=\"row\" style=\"margin-bottom:30px;\">";
                reviews += "<label id=\"label\">Review</label>";
                reviews += "<div id=\"content\">"+json.reviews[r].reviewBody+"</div>";
                reviews += "</div>";
            }
            var modal = document.getElementById('myModal');
            document.getElementById('reviews').innerHTML = reviews;
            document.getElementById("submit").value=pid;
            modal.style.display = "block";
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    }
    xhr.send("pid="+pid);
}