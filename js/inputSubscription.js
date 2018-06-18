$('document').ready(function()
{
  $("#input-subscription").validate({
    rules:
    {
      crop: {
        required: true
      },
      remaining: {
        min:0.01,
        required: true,
        number: true
      },
      subPeriod: {
        min:0.01,
        required: true,
        number: true
      },
      price: {
        min:0.01,
        required: true,
        number:true
      }
    },
    messages:{
      crop: "Please enter the Type of Crop",
      price: {
        min:"Please enter a valid Positive number",
        required: "Please enter the Price",
        number: "Please enter a valid Positive number"
      },
      subPeriod: {
        min:"Please enter a valid Positive number",
        required: "Please enter the Subscription Period",
        number: "Please enter a valid Positive number"
      },
      remaining: {
        min:"Please enter a valid Positive number",
        number: "Please enter a valid Positive number",
        required: "Please enter the Quantity per Subscription"
      }
    },
    submitHandler: submitForm

  });

  //CHANGE THE UNIT ACCORDING TO THE CROPNAME
  /* form submit */
  function submitForm()
  {
    var data = $("#input-subscription").serialize();
  
    $.ajax({
      type : 'POST',
      url  : '../../app/inputSubscription.php',
      data : data,
      beforeSend:function()
      {
        $("#error").fadeOut();
        $("#error").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
      },
      success :  function(data)
      {
        if(data=="entered")
        {
          alert("You've successfully added this subscription.");
          $("#input-subscription")[0].reset();
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
