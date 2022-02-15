<?php
    session_start();
    if (array_key_exists("logout", $_POST)){
        $_SESSION = [];
    }
?>
<head>
    <title>What to do, hm?</title>
    <link href="./view/style.css" rel="stylesheet">
</head>



<body>
<!-- <img id="buttLogout" class="customButton" src="./view/images/arrow.png"> -->
    <p class="logo">What to do, hm?</p>
    <?php if(!array_key_exists("id", $_SESSION) or !array_key_exists("password", $_SESSION)): ?>
        <p><table id="logintable">
            <tbody>
                <tr>
                    <td>
                    <input type="text" id="login" class="littleInputPole" placeholder="LOGIN">
                    <input type="password" id="password" class="littleInputPole" placeholder="PASSWORD">
                    </td>
                </tr>
                <tr>
                    <td>
                    <a id="buttSignUp" class="customButton">Sign Up</a>
                    <a id="buttLogin" class="customButton">Login</a>
                    </td>
                </tr>

            </tbody>
        </table></p>
        <p id="todomain"></p>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="./controller/login.js"></script>


    <?php else: ?>
        <p id="todomain">
            <table id="maintable">
            <tbody>
                <tr>
                    <td><input type="text" id="todoinput" class="littleInputPole"></td>
                    <td><img id="buttplus" class="customButton" src="./view/images/plus.png"></td>
                </tr>
            </tbody>
            </table>
        </p>
        <p id="console"></p>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="./controller/todolist.js"></script>
    <?php endif; ?>
</body>