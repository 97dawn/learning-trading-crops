$('document').ready(function()
{
  $("#input-subscription").validate({
    rules:
    {
      crop: {
        required: true
      },
      remaining: {
        required: true,
        number: true
      },
      subPeriod: {
        required: true,
        number: true
      },
      price: {
        required: true,
        number:true
      },
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
          $("#input-subscription")[0].reset();
          //clear out the form 
          $("#success").html('<div class="row"><div class="col-md-6"><input type="button" class="btn btn-primary" id="continue"value="Continue Adding">'+
            '<input type="button" class="btn btn-primary" id="gotoprofile" value="See all Products"></div></div>');
        }
        else {
          $("#error").fadeIn(1000, function(){
            $("#error").html('<div class="alert alert-danger"> <span></span> &nbsp; There has been an error in the server :('+ data +'</div>');
          });
        }
      }
    });
    return false;
  }
  /* form submit */

});
