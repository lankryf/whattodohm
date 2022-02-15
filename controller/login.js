
$('#buttSignUp').on('click', function(){getDetails(1)});
$('#buttLogin').on('click', function(){getDetails(0)});
function getDetails(type){
    $.ajax({
        type: "POST",
        url: "./model/login.php",
        data: {
            type: type,
            login: $('#login').val(),
            password: $('#password').val()
        },

        
        success: function( result ) {
            $("#todomain").html(result);
        }

        
        });
}




