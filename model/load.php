<?php
    spl_autoload_register(function ($className) {
        require_once __DIR__ . "/lib/" . $className . ".php";
    });
    session_start();

    $u = new user();
   
    $u->loadForm();


    $json = json_encode($u->form);
?>



<script>
    var form = JSON.parse('<?php echo $json; ?>')
    for (var key in form) {
        createBlock(form[key]);
    }
</script>