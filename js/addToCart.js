function addToCart(product){
    var pid = product.value;
    var quantity = document.getElementById(pid+"-quantity").value;
    var pricePerUnit = document.getElementById(pid+"-pricePerUnit").innerHTML.split(" ")[4];
    var isOrganic = document.getElementById(pid+"-isOrganic").value;
    if(isOrganic == "yes") isOrganic = true;
    else isOrganic = false;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../app/addToCart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function (){
        if(xhr.readyState === 4 && xhr.status === 200){
            var answer = xhr.responseText;
            if(answer == "true to insert"){
                alert("Successfully added the product into the cart.");
            }
            else if(answer == "true to update"){
                alert("Successfully update the product in the cart.");
            }
            else if(answer == "false"){
                alert("ERROR.");
            }
            else{
                alert("You can't store this amount of product.");
            }
        }
    }
    xhr.send("pid="+pid+"&quantity="+quantity+"&pricePerUnit="+pricePerUnit+"&isOrganic="+isOrganic);
}