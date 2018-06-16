$('document').ready(function(){
    populateSavedPosts();

    function populateSavedPosts(){
        $.ajax({
            type: 'GET',
            url: '../../app/getSavedPosts.php',
            beforeSend: function()
        {
          $("#error").fadeOut();
          $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
        },
        success :  function(response)
        {
                if(response=="nopost"){
                    $("#posts").html('<div class="row"><h2>You currently have no post saved</h2></div>');
                }
                else{
                    var parsedResponse = $.parseJSON(response);
                    var allPosts;
                    for(i=0; i<parsedResponse.length; i++){
                        var title = parsedResponse[i][0].title;
                   var contents = {author: parsedResponse[i][0].authorName,cropName: parsedResponse[i][0].cropName};
                   var postid = parsedResponse[i][0].postid;
                    var postToRender = formLearningPost(title, contents, postid);
                    allPosts+=postToRender;
                    $("#posts").html(allPosts);
                    }
                }
                },
                error: function()
                {
                    $("#error").fadeIn(1000, function(){
                        $("#error").html('<div class="alert alert-danger"> <span></span> &nbsp; Looks like there is a server error :(</div>');
                      });
                }
        });
    }
});