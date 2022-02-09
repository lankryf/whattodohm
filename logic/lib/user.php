<?php

class User{
    private string $login;
    private string $password;
    private int $id;
    public function __construct(string $login, string $password){
        $this->login = $login;
        $this->password = $password;
        $this->pdo = new PDO('mysql:host=localhost;dbname=mozok499_student', "mozok499_student", "mU1aH8sF");
        $this->form = [];
    }



    public function search($createNew=false){
        if (strlen($this->login) < 4){
            return [false, 4];
        }
        if (strlen($this->password) < 4){
            return [false, 5];
        }
        $stmt = $this->pdo->prepare("SELECT * FROM lexa_todolist WHERE login = ? LIMIT 1");
        $stmt->execute([$this->login]);
        $data = $stmt->fetchAll();
        if (!$data and $createNew){
            $this->add();
            return [true, 0];
        }
        if ($data and !$createNew){
            if ($data[0]["password"] == $this->password){
                if ($data[0]["form"] != ""){
                    $this->form = explode("\n", $data[0]["form"]);
                }
                $this->id = $data[0]["id"];
                return [true, 0];
            }
            return [false, 3];
        }
        if($createNew){
            return [false, 1];
        }
        return [false, 2];
        
    }
    private function add(){
        $stmt = $this->pdo->prepare("INSERT INTO lexa_todolist (login, password) VALUES (?, ?)");
        $stmt->execute([$this->login, $this->password]);
    }

    public function updateForm(){
        $stmt = $this->pdo->prepare("UPDATE lexa_todolist SET form = ? WHERE login = ? AND password = ?");
        $stmt->execute([join("\n", $this->form), $this->login, $this->password]);
    }
    public function deleteBlock($value){
        unset($this->form[array_search($value,$this->form)]);
    }
    public function addBlock($value){
        array_push($this->form, $value);
    }



}