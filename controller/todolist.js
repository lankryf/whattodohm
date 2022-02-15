$("#logintable").hide();
$('#login').val("");
$('#password').val("");
$("body").prepend('<img id="buttLogout" class="customButton" src="./view/images/arrow.png">')



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
        url: "./model/update.php",
        data: {
            action: action,
            value: value,
        },
        success: function( result ) {
            $("#console").html(result);
        }
        
    });
}

function loadForm(){
    $.ajax({
        type: "POST",
        url: "./model/load.php",

        
        success: function( result ) {
            $("#console").html(result);
        }

        
    });
}


$('#buttLogout').on('click',function(){
    $.ajax({
        type: "POST",
        url: "index.php",

        data: {
            logout: 1
        },
        
        success: function( result ) {
            $("body").html(result);
        }

        
    });
});