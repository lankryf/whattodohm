<?php
    spl_autoload_register(function ($className) {
        require_once __DIR__ . "/lib/" . $className . ".php";
    });


    $type = boolval($_POST["type"]);
    $u = new user($_POST["login"], $_POST["password"]);
    $done = $u->search($type);
    $error_texts = [
        "",
        "This name already in use.",
        "Account isn't found. If you don't have account, create it now!",
        "Wrong password.",
        "Name length must be 4 characters or longer.",
        "Password length must be 4 characters or longer."
    ];
    

?>




<?php if($done[0]): ?>
<table id="maintable">
        <tbody>
            <tr>
                <td><input type="text" id="todoinput" class="littleInputPole"></td>
                <td><img id="buttplus" class="customButton" src="./source/plus.png"></td>
            </tr>
        </tbody>
</table>
<p id="console"></p>

<script>
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
            input.animate({"height": "0"}, "fast", function(){ $(this).animate({"height": "30px"}, "fast")})
            userUpdate(1, text);
        }
        input.val("");
    }



    function userUpdate(action, value){
        $.ajax({
            type: "POST",
            url: "./logic/update.php",
            data: {
                action: action,
                value: value,
                login: login,
                password: password
            }

            
        });
    }

    function loadForm(){
        $.ajax({
            type: "POST",
            url: "./logic/load.php",
            data: {
                login: login,
                password: password
            },

            
            success: function( result ) {
                $("#console").html(result);
            }

            
        });
    }

</script>







<?php else: ?>
    <p class="errortext"><?=$error_texts[$done[1]];?></p>
<?php endif; ?>