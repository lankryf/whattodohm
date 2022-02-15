<?php
    spl_autoload_register(function ($className) {
        require_once __DIR__ . "/lib/" . $className . ".php";
    });
    
    session_start();
    
    $u = new user();
    $done = $u->login($_POST["login"], $_POST["password"], boolval($_POST["type"]));
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
                <td><img id="buttplus" class="customButton" src="./view/images/plus.png"></td>
            </tr>
        </tbody>
</table>
<p id="console"></p>

<script src="./controller/todolist.js"></script>


<?php else: ?>
    <p class="errortext"><?=$error_texts[$done[1]];?></p>
<?php endif; ?>