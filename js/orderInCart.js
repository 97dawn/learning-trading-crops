function orderInCart(cartid){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/orderInCart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var answer = xhr.responseText;
            if(answer == "success"){
                alert("Order successfully");
            }
            else{
                alert("ERROR");
            }
        }
    }
    xhr.send("cartid="+cartid);
}
