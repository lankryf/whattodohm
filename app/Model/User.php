<?php
namespace App\Model;

class User{
    private $pdo;
    public $form;

    public function __construct(){
        $config = include('.\configs\DB.php');
        $this->pdo = new \PDO(...$config['pdo']);
        $this->form=[];
    }


    public function loginWithLogin($login, $password, $createNew=false)
    {
        $bufflen = strlen($login);
        if ($bufflen < 4 or $bufflen > 40){
            return [false, 4];
        }
        $bufflen = strlen($password);
        if ($bufflen < 4){
            return [false, 5];
        }
        $stmt = $this->pdo->prepare("SELECT * FROM lexa_todolist WHERE login = ? LIMIT 1");
        $stmt->execute([$login]);
        $data = $stmt->fetchAll();

        if (!$data and $createNew){
            $this->add($login, $password);
            return [true, 0];
        }
        if($createNew){
            return [false, 1];
        }

        return $this->login($data, $password);
    }

    public function loginWithId($id, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM lexa_todolist WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $this->login($stmt->fetchAll(), $password);
    }



    private function login($data, $password){
        if ($data){
            if (password_verify($password, $data[0]["password"])){
                if ($data[0]["form"] != ""){
                    $this->form = explode("\n", $data[0]["form"]);
                }
                $_SESSION["id"] = $data[0]["id"];
                $_SESSION["password"] = $data[0]["password"];
                return [true, 0];
            }
            return [false, 3];
        }
        return [false, 2];
        

    }

    public function checkSession() {
        if (!array_key_exists('id', $_SESSION) or !array_key_exists('password', $_SESSION)){
            $_SESSION = [];
            header('Location: /whattodohm/login');
            return false;
        }
        return self::loginWithId($_SESSION['id'], $_SESSION['password'])[0];
    }

    

    private function add($login, $password){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO lexa_todolist (login, password) VALUES (?, ?)");
        $stmt->execute([$login, $hash]);

        $stmt = $this->pdo->prepare("SELECT LAST_INSERT_ID()");
        $stmt->execute();
        $_SESSION["id"] = $stmt->fetchAll()[0][0];
        $_SESSION["password"] = $hash;
    }

    public function updateForm(){
        $stmt = $this->pdo->prepare("UPDATE lexa_todolist SET form = ? WHERE id = ? AND password = ?");
        $stmt->execute([join("\n", $this->form), $_SESSION["id"], $_SESSION["password"]]);
    }

    public function loadForm(){
        $stmt = $this->pdo->prepare("SELECT * FROM lexa_todolist WHERE id = ? and password = ? LIMIT 1");
        $stmt->execute([$_SESSION["id"], $_SESSION["password"]]);
        $data = $stmt->fetchAll();
        if ($data and $data[0]["form"] != ""){
            $this->form = explode("\n", $data[0]["form"]);
        }

    }
    

    public function deleteBlock($value){
        unset($this->form[array_search($value, $this->form)]);
    }
    public function addBlock($value){
        array_push($this->form, $value);
    }



}