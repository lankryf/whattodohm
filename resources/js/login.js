
$('#buttSignUp').on('click', function(){getDetails(1)});
$('#buttLogin').on('click', function(){getDetails(0)});

function getDetails(type){
    $.ajax({
        type: "POST",
        url: "/whattodohm/loginconfirm",
        data: {
            type: type,
            login: $('#login').val(),
            password: $('#password').val()
        },

        
        success: function( result ) {
            // $("#todomain").html(result)
            result = JSON.parse(result)
            if (result[0] === true){
                window.location.replace("/whattodohm/");
            } else {
                $("#todomain").html('<p class="errortext">'+ result[1] + '</p>');
            } 
            

        }

        });
}
