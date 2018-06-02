$('document').ready(function()
{
  var form = $("#register-form"),
  data = $(form).serialize(),
  formMethod  = 'POST'
  phpHandler = '../app/signup.php';
  var city_array;
  var province_array;
  /*get values from
  function populateCityProvince(){
  }

  function getProvinceData(callback){
    $.ajax({

    });
  }
  */
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
        minlength: 10,
        maxlength: 10
      },
      streetInfo: {
        required: true,
        minlength: 5
      },
      city:{
        required:true
      },
      province:{
        require:true
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
      submitHandler: submitForm()
    });
    /* validation */

    /* form submit */
    function submitForm()
    {
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
              $("#error").html('<div class="alert alert-danger"> <span></span> &nbsp; Username already exists !</div>');
            });
          }

          else if(data=="registered")
          {
            $("#btn-submit").html('Signing Up');
            setTimeout('$(".probootstrap-section").fadeOut(500, function(){ $(".probootstrap-loader").load("successreg.php"); }); ',5000);
          }
          else{
            $("#error").fadeIn(1000, function(){
              $("#error").html('<div class="alert alert-danger"><span></span> &nbsp; '+data+' !</div>');
              $("#btn-submit").html('<span ></span> &nbsp; Create Account');
            });
          }
        }
      });
      return false;
    }
    /* form submit */

  });
