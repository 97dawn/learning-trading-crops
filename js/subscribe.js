function subscribe(sub){
    var subid = sub.value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/subscribe.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var answer = xhr.responseText;
            if(answer == "true"){
                alert("Successfully subscribed the subscription.");
            }
            else{
                alert("ERROR");
            }
        }
    }
    xhr.send("subid="+subid);
}