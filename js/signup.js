$('document').ready(function()
{
  $("#register-form").validate({
    rules:
    {
      fname: {
        required: true,
        minlength: 3
      },
      lname: {
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
        digits:true,
        minlength: 11,
        maxlength: 11
      },
      streetInfo: {
        required: true,
        minlength: 5
      },
      password: {
        required: true,
        minlength: 5,
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
      fname: "Enter a Valid Name",
      last_name: "Enter a Valid Name",
      email: {
        required:"Email is Required",
        email:"Enter a Valid Email"
      },
      phone: {
        digits:"Please enter Digits only",
        required: "Enter a Valid Phone number",
        minlength: "Enter a Valid Phone number",
        maxlength: "Enter a Valid Phone number"
      },
      streetInfo: {
        required: "Provide an Address",
        minlength: "Enter a Valid Address"
      },
      password: {
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
      var data = $("#register-form").serialize();

      $.ajax({
        type : 'POST',
        url  : '../app/signup.php',
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
          else if(data=="registered")
          {
          window.location.replace("../view/successreg.html");
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