function addToCart(product){
    var pid = product.value;
    var quantity = document.getElementById("quantity").value;
    var pricePerUnit = document.getElementById("pricePerUnit").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../app/addToCart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var answer = xhr.responseText;
            if(answer == "true"){
                alert("Successfully added the product into the cart.");
            }
            else{
                alert("ERROR");
            }
        }
    }
    xhr.send("pid="+pid+"&quantity="+quantity+"&pricePerUnit"+pricePerUnit);
}