<?php
session_start();

include("tpl/class.TemplatePower.inc.php");

$tpl = new TemplatePower("html/login.html");
$tpl->prepare();

$db = new PDO('mysql:host=localhost;dbname=game','root','');

if (isset($_SESSION['accountid'])) {
    $tpl->newBlock("ALREADYLOGGEDIN");
    $tpl->assign("ALREADYLOGGEDIN", "You are already logged in.");
    
}

else {
    if (isset($_POST['submit'])) {
        $hashpassword = sha1($_POST['password']);
        
        $query = "SELECT COUNT(*) FROM accounts WHERE username = :username AND password = :password";
        $mysql = $db->prepare($query);
        $mysql->bindParam(':username', $_POST['username']);
        $mysql->bindParam(':password', $hashpassword);
        $mysql->execute();
        
        if ($mysql->fetchColumn() == 1) {
            $check = $db->prepare("SELECT * FROM accounts WHERE username = :username AND password = :password");
            $check->bindParam(':username', $_POST['username']);
            $check->bindParam(':password', $hashpassword);
            $check->execute();
            
            $person = $check->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['accountid'] = $person['accountid'];
            $_SESSION['username'] = $person['username'];
            $_SESSION['accountlevel'] = $person['accountlevel'];
            
            $town = $db->prepare("SELECT * FROM towns WHERE accountid = :accountid");
            $town->bindParam(':accountid', $_SESSION['accountid']);
            $town->execute();
            
            $towns = $town->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['accountidtown'] = $towns['accountid'];
            $_SESSION['townid'] = $towns['townid'];
            
            $building = $db->prepare("SELECT * FROM towns_buildings WHERE accountid = :accountid AND townid = :townid");
            $building->bindParam(':accountid', $_SESSION['accountid']);
            $building->bindParam(':townid', $_SESSION['townid']);
            $building->execute();
            
            $buildings = $building->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['accountidbuildings'] = $buildings['accountid'];
            $_SESSION['townidbuildings'] = $buildings['townid'];
            
            $tpl->newBlock("SUCCES");
            $tpl->assign("SUCCES", "Succesfully logged in.");
            //header('Location: town.php'); 
        }
        else {
            $tpl->newBlock("ERROR");
            $tpl->assign("ERROR", "Username and password do not match.");
        }
    }
    else if (!isset($_POST['submit'])) {
        $tpl->newBlock("FORM");
    }
}

$tpl->printToScreen();
?>
