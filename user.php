<?php 

class user {
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

// construct

public function _constuct () {}

//register

public function _register ($login, $password, $email, $firstname, $lastname) {
    session_start();
    $connexion = mysqli_connect('localhost', 'root', '', 'classes');

    if(isset($_POST['submit'])) {
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $verif = mysqli_query($connexion, "SELECT login FROM `utilisateurs` WHERE login = '$login'");
    
        if(!empty($login) && !empty($email) && !empty($firstname) && !empty($lastname) && !empty($password)) {
            if(mysqli_num_rows($verif) == 0){  //calcule et verifie dans la base de donnée 
                $query = "INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES ($login, $password, $email, $firstname, $lastname)"; //ajoute les info dans la base de donnée
                mysqli_query($connexion, $query);
            }
        } 
        else echo $erreur = "<p id='erreur'>Ce login existe déja</p>";
    }
    else echo $erreur = "<p id='erreur'>Veuillez remplir le formulaire s'il vous plait !</p>";
}
}











}

?>