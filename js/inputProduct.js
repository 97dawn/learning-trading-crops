$('document').ready(function () {
  var counter = 1;
  var discounts = [];
  var rate;
  var quan;
  var rates = [];
  var quans = [];
  $("#input-product").validate({
    rules: {
      crop: {
        required: true
      },
      organic: {
        required: true
      },
      price: {
        required: true,
        number: true
      },
      discountrate: {
        required: false
      },
      discountmin: {
        required: false
      }
    },
    submitHandler: submitForm

  });
  /* validation */
  $("#submit").click(function () {
    $("#input-product").submit();
    //alert("Form is submitted");
  });
  $("#discountrate").on("change paste keyup", function () {
    rate = $(this).val();
  });
  $("#discountmin").on("change paste keyup", function () {
    quan = $(this).val();
  });

  //IF A BUTTON WITH CLASS EDIT CLICKED, LOOK FOR THE NUMBER %??
  /*
$(".editdiscount").click(function() {
 //get number 
    var discountNo = this.id; 
    var discountRow = "#discountNo-"+discountNo;
//erase the current row
    $(discountRow).html("");
//set values of the input fields to these number
    $("#discountrate").val = rates[discountNo];
    $("#discountmin").val = quans[discountNo];
    $("#add-discount").val = "Confirm Edit";
    var editedRate = rate;
    var editedQuan = quan;
    
});
*/
  $("#add-discount").click(function () {
    //clear out the form 
    $("#discountrate").val = "";
    $("#discountmin").val = "";
    var newRate = rate;
    var newQuan = quan;
    rates.push(newRate);
    quans.push(newQuan);
    //put this into another div, give id="discountNo-"+counter
    $("#discount_header").after('<div class="col-md-3"><label id="discountrate" name="discountrate">' + rate + '</label></div>' +
      '<div class="col-md-3"><label id="discountmin"' + counter + 'name="discountmin">' + quan + '</label></div></div>');
    counter++;
  });
  /*
function editDiscount(){
    var curEditDiscount = ;
        //find 
}
*/
  /* form submit */
  function submitForm() {
    var data = $("#input-product").serializeArray();
    var JSONrates = JSON.stringify(rates);
    var JSONquans = JSON.stringify(quans);
    var JSONdata = JSON.stringify(data);
    $.ajax({
      type: 'POST',
      url: '../../app/inputProduct.php',
      dataType: 'json',
      data: {
        formData: JSONdata,
        rates: JSONrates,
        quantities: JSONquans
      },
      beforeSend: function () {
        $("#error").fadeOut();
        $("#error").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
      },
      success: function (data) {
        if (data == "entered") {
          //$("#input-product")[0].reset();
          //clear out the form 
          $("#success").html('<div class="row"><div class="col-md-6"><input type="button" class="btn btn-primary" id="continue"value="Continue Adding">' +
            '<input type="button" class="btn btn-primary" id="gotoprofile" value="See all Products"></div></div>');
          $("#input-product").reset();
        } else {
          $("#error").fadeIn(1000, function () {
            $("#error").html('<div class="alert alert-danger"> <span></span> &nbsp; There has been an error in the server :(' + data + '</div>');
          });
        }
      }
    });
    return false;
  }
  /* form submit */

});