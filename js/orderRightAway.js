function orderRightAway(product){
    var pid = product.value;
    var quantity = document.getElementById(pid+"-quantity").value;
    var pricePerUnit = document.getElementById(pid+"-pricePerUnit").innerHTML.split(" ")[4];
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/orderRightAway.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var answer = JSON.parse(xhr.responseText);
            if(answer.response == "false"){
                alert("ERROR");
            }
            else{
                alert("Successfully ordered the product.\nTotal price: "+answer.totalPrice+"won");
                var unit = document.getElementById(pid+"-remaining").innerText.split(" ")[2];
                document.getElementById(pid+"-remaining").innerText="";
                document.getElementById(pid+"-remaining").innerText="Remaining: "+answer.remaining+" "+unit;
            }
        }
    }
    xhr.send("pid="+pid+"&quantity="+quantity+"&pricePerUnit="+pricePerUnit);
}