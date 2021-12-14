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

    // <form method="post">
    //     <h1>Inscription</h1>
    //     <input type="text" placeholder="Login" name="login"/><br/>
    //     <input type="email" placeholder="Email" name="email"/><br/>
    //     <input type="text" placeholder="Firstname" name="firstname"/><br/>
    //     <input type="text" placeholder="Lastname" name="lastname"/><br/>
    //     <input type="password" placeholder="Password" name="password"/><br/>
    //     <input type="submit" name="submit"/>
    // </form>

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

        $req = mysqli_query($connexion,'SELECT `login`, `password`, `email`, `firstname`, `lastname` FROM `utilisateurs`');
        $res = mysqli_fetch_all($req);

        echo "<th> login </th> <th> password </th> <th> email </th> <th> firstname </th> <th> lastname </th>";

        foreach($res as $key=>$values) {
            echo "<tr>";
            foreach($values as $key=>$value){
                echo "<td> $value </td>";
            }
            echo "</tr>";
        }
    }

/////////////////////// connect

    // <form action="#" method="POST">
    //     <h1>Connexion</h1>
    //     <input type="text" placeholder="login" name="login">
    //     <input type="password" placeholder="password" name="password">
    //     <input type="submit" id='submit' name='submit' value='LOGIN'>
    // </form>

    public function _connect ($login, $password) {
        session_start();
        $connexion = mysqli_connect('localhost', 'root', '', 'classes');

        if (isset($_POST['submit'])) {
            $login = trim($_POST['login']); 
            $password = trim($_POST['password']);

            if($login !== "" && $password !== "") {
                $req = "SELECT count(*) FROM utilisateurs WHERE login = '$login' AND password='$password'";
                $query = mysqli_query($connexion, $req);
                $res = mysqli_fetch_array($query);
                $count = $res['count(*)'];
            
                if($count!=0) {  
                    $_SESSION['login'] = $login;
                }
                else  echo $erreur = "<p id='erreur'>Le login ou le mot de passe n'est pas correct !</p>";
            }
            else echo $erreur = '<p id="erreur">Veuillez remplir le formulaire s\'il vous plait !</p>';
        }    
    }    

/////////////////////// disconnect












}
?>