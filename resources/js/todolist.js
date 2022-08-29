$("#logintable").hide();
$('#login').val("");
$('#password').val("");



loadForm();
$('input').keydown(
function(e){
    if(e.keyCode === 13) {inpBlock();}
}
);

$('#buttplus').on('click', inpBlock);

function createBlock(text){
    $("#maintable").find('tbody')
        .after($('<tr>')
            .append($('<td>').attr('colspan', '2')
                .append($('<p>')
                    .addClass("textpole")
                    .text(text)
                    .on('click', function (){
                        $(this).animate({"opacity": "0"}, "fast", delBlock);
                    })
                )
            )
        );

}



function delBlock(){
    userUpdate(0, $(this).text());
    $(this).slideUp(200);
}

function inpBlock(){
    let input = $('#todoinput');
    let text = input.val();
    if (!(/^\s*$/.test(text))){
        createBlock(text)
        input.animate({"height": "0"}, "fast", function(){ $(this).animate({"height": "40px"}, "fast")})
        userUpdate(1, text);
    }
    input.val("");
}



function userUpdate(action, value){
    $.ajax({
        type: "POST",
        url: "/whattodohm/update",
        data: {
            action: action,
            value: value,
        }
    });
}

function loadForm(){
    
    $.ajax({
        type: "GET",
        url: "/whattodohm/load",

        
        success: function( result ) {
            var form = JSON.parse(result)
            for (var key in form) {
                createBlock(form[key]);
            }
        }

        
    });
}

