$('document').ready(function () {

  $("#input-post").validate({
    rules: {
      title: {
        required: true
      },
      description: {
        required: true
      },
      cropname: {
        required: true
      },
      disease: {
        required: true
      },
      uses: {
        required: true
      }
    },
    messages: {
      title: "Please Enter a Title",
      description: "Please Enter a Description for the crop",
      disease: "Please Fill out the Disease",
      uses: "Please Fill out Uses for the crop",
      cropname: "What Crop is this post about?"
    },
    submitHandler: submitForm
  });

  /* form submit */
  function submitForm() {
    var data = $("#input-post").serialize();
    $.ajax({
      type: 'POST',
      url: '../../app/inputPost.php',
      data: data, 
      beforeSend: function()
      {
        $("#error").fadeOut();
        $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
      },
      success :  function(data)
      {
        if(data=="entered")
        {
          alert("You've successfully added this post.");
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