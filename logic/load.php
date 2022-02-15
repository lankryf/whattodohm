<?php
    spl_autoload_register(function ($className) {
        require_once __DIR__ . "/lib/" . $className . ".php";
    });

    $u = new user($_POST["login"], $_POST["password"]);
    $form = [];
    if ($u->search()){
        $form = $u->form;
    }
    $json = json_encode($form);
?>



<script>
    var form = JSON.parse('<?php echo $json; ?>')
    for (var key in form) {
        createBlock(form[key]);
    }
</script>