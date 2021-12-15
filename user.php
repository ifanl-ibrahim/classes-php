<?php

class user {
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

/////////////////////// construct

    public function _constuct () {}

/////////////////////// register

    public function _register ($login, $password, $email, $firstname, $lastname) {
        session_start();
        $connexion = mysqli_connect('localhost', 'root', '', 'classes');
        $verif = mysqli_query($connexion, "SELECT login FROM `utilisateurs` WHERE login = '$login'");

        if ($login && $email && $firstname && $lastname && $password) {
            if(mysqli_num_rows($verif) == 0){  //calcule et verifie dans la base de donnée
                $query = "INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES ($login, $password, $email, $firstname, $lastname)";
                mysqli_query($connexion, $query);
            }
        }

        $req = mysqli_query($connexion,'SELECT `login`, `password`, `email`, `firstname`, `lastname` FROM `utilisateurs`');
        $res = mysqli_fetch_all($req);

        echo "<th> login </th> <th> password </th> <th> email </th> <th> firstname </th> <th> lastname </th>";

        foreach($res as $key=>$values) {
            echo "<tr>";
            foreach($values as $key=>$value) {
                echo "<td> $value </td>";
            }
            echo "</tr>";
        }
    }

/////////////////////// connect

    public function _connect ($login, $password) {
        session_start();
        $connexion = mysqli_connect('localhost', 'root', '', 'classes');

        if($login && $password) {
            $req = "SELECT count(*) FROM utilisateurs WHERE login = '$login' AND password='$password'";
            $query = mysqli_query($connexion, $req);
            $res = mysqli_fetch_array($query);
            $count = $res['count(*)'];

            if($count!=0) {
                $_SESSION['login'] = $login;
            }
        }
    }

/////////////////////// disconnect

    public function _disconnect () {
        session_unset ();
    }

/////////////////////// delete

    public function _delete () {
        session_start();
        $connexion = mysqli_connect('localhost', 'root', '', 'classes');
        $login = $_SESSION['login'];
        (mysqli_query($connexion, "DELETE FROM utilisateurs WHERE login = '$login'"));
        session_unset ( );
    }

/////////////////////// update

    public function _update ($login, $password, $email, $firstname, $lastname) {
        session_start();
        $connexion = mysqli_connect('localhost', 'root', '', 'classes');

        $checklogin = mysqli_query($connexion, "SELECT * FROM utilisateurs WHERE login='$login'");
        $query = "UPDATE `utilisateurs` SET `login`= $newLogin, `password`= $newpassword, `email`= $newemail, `firstname`= $newfirstname, `lastname`= $newlastname WHERE $login";

        (mysqli_query($connexion, $query)) {
            $_SESSION['login'] = $newLogin
        }
    }

 

 

 

 

 
?>