$('document').ready(function()
{
  $("#add_discount").click(function(){
       $("#discount_form").clone().appendTo($("#newDiscount"));
   });
  $("#input-product").validate({
    rules:
    {
      crop: {
        required: true
      },
      organic: {
        required: true
      },
      price: {
        required: true,
        number:true
      },
      unit: {
        required: true
      }
    },
      submitHandler: submitForm

    });
    /* validation */

    /* form submit */
    function submitForm()
    {
      var data = $("#input-product").serialize();

      $.ajax({
        type : 'POST',
        url  : '../../app/inputProduct.php',
        data : data,
        beforeSend: function()
        {
          $("#error").fadeOut();
          $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
        },
        success :  function(data)
        {

        /*
        if(data==1){
          $("#error").fadeIn(1000, function(){
            $("#error").html('<div class="alert alert-danger"> <span></span> &nbsp; Username already exists !</div>');
          });
        }
        if(data==2){
          $("#error").fadeIn(1000, function(){
            $("#error").html('<div class="alert alert-danger"> <span></span> &nbsp; This email is already chosen !</div>');
          });
        }
        if(data==3){
          $("#error").fadeIn(1000, function(){
            $("#error").html('<div class="alert alert-danger"> <span></span> &nbsp; This phone number is associated with an existing account !</div>');
          });
        }
        */
          if(data=="entered")
          {
          window.location.replace("../../view/successreg.html");
          }
          else {
            $("#error").fadeIn(1000, function(){
              $("#error").html('<div class="alert alert-danger"> <span></span> &nbsp; There has been an error in the server :(</div>');
            });
          }

        }
      });
      return false;
    }
    /* form submit */

  });
