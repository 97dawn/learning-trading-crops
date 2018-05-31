$('document').ready(function()
{
  /* validation */
  /*TODO is address required? */
  $("#register-form").validate({
    rules:
    {
      first_name: {
        required: true,
        minlength: 3
      },
      last_name: {
        required: true,
        minlength: 3
      },
      user_name: {
        required: true,
        minlength: 3
      },
      email: {
        required: true,
        email: true
      },
      phonenumber: {
        required: true,
        minlength: 10,
        maxlength: 10
      },
      password: {
        required: true,
        minlength: 8,
        maxlength: 15
      },
      cpassword: {
        required: true,
        equalTo:'#password'
      },

    },
    messages:
    {
      user_name: "Enter a Valid Username",
      first_name: "Enter a Valid Name",
      last_name: "Enter a Valid Name",
      email: {
        required:"Email is Required"
        email:"Enter a Valid Email"},
      phone: "Enter a Valid Phone number",
      password:{
        required: "Provide a Password",
        minlength: "Password Needs To Be Minimum of 8 Characters"
      },
      cpassword:{
          required: "Retype Your Password",
          equalTo: "Password Mismatch! Retype"
        }
      },
      submitHandler: submitForm
    });
    /* validation */

    /* form submit */
    function submitForm()
    {
      var form = $("#register-form"),
      data = form.serialize(),
      formMethod  = form.attr.('method'),
      phpHandler = form.attr.('action');

      $.ajax({
        type : formMethod,
        url  : phpHandler,
        data : data,
        beforeSend: function()
        {
          $("#error").fadeOut();
          $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
        },
        success :  function(data)
        {
          if(data==1){

            $("#error").fadeIn(1000, function(){


              $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Sorry email already taken !</div>');

              $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');

            });

          }
          else if(data=="registered")
          {

            $("#btn-submit").html('Signing Up');
            setTimeout('$(".form-signin").fadeOut(500, function(){ $(".signin-form").load("successreg.php"); }); ',5000);

          }
          else{

            $("#error").fadeIn(1000, function(){

              $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');

              $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');

            });

          }
        }
      });
      return false;
    }
    /* form submit */

  });
