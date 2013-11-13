<?php

include("tpl/class.TemplatePower.inc.php");

$tpl = new TemplatePower("html/index.html");
$tpl->prepare();

$db = new PDO('mysql:host=localhost;dbname=game','root','');

$error = NULL;
$succestext = NULL;
$succes = 1;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $username = (filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[a-zA-Z0-9]+$/"))));
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = $_POST['email'];
    $townname = $_POST['username']. "'s". " ". "Town";
    $mainbuilding = "Main Building";
    $wheat1 = "Wheat Field";
    $wheat2 = "Wheat Field";
    $wheat3 = "Wheat Field";
    $wheat4 = "Wheat Field";
    $wheat5 = "Wheat Field";
    $wheat6 = "Wheat Field";
    $clay1 = "Clay Pit";
    $clay2 = "Clay Pit";
    $clay3 = "Clay Pit";
    $clay4 = "Clay Pit";
    $iron1 = "Iron Mine";
    $iron2 = "Iron Mine";
    $iron3 = "Iron Mine";
    $iron4 = "Iron Mine";
    $wood1 = "Lumberjack";
    $wood2 = "Lumberjack";
    $wood3 = "Lumberjack";
    $wood4 = "Lumberjack";
    $twheat1 = 1;
    $twheat2 = 2;
    $twheat3 = 3;
    $twheat4 = 4;
    $twheat5 = 5;
    $twheat6 = 6;
    $tclay1 = 7;
    $tclay2 = 8;
    $tclay3 = 9;
    $tclay4 = 10;
    $tiron1 = 11;
    $tiron2 = 12;
    $tiron3 = 13;
    $tiron4 = 14;
    $twood1 = 15;
    $twood2 = 16;
    $twood3 = 17;
    $twood4 = 18;
    $buildinglevel = 0;
    
    if ($username == FALSE) {
        $error = "Do not use special characters please.";
    }
    
    else if (empty($password)) {
        $error = "Please enter a password.";
    }
    
    else if (empty($password2)) {
        $error = "Please enter a password.";
    }
    
    else if ($email == FALSE) {
        $error = "Please enter a valid email.";
    }
    
    else if ($password != $password2) {
        $error = "The entered passwords do not match.";
    }
    
    else if ($password2 != $password) {
        $error = "The entered passwords do not match.";
    }
    
    else {
        $check = $db->prepare("SELECT COUNT(*) FROM accounts WHERE username = '$_POST[username]'");
        $check->execute();
        $rows = $check->fetchColumn();
        
        if ($rows > 0) {
            $error = "Username already exist.";
        }
        
        else {
            $succestext = "Succesfully registered.";
            $succes = 1;
        }
        
        $hashpassword = sha1($password);
        $sql = "INSERT INTO accounts (username, password, email) VALUES (:username, :password, :email)";
        $sqlvar = $db->prepare($sql);
        $sqlvar->bindParam(':username', $username);
        $sqlvar->bindParam(':password', $hashpassword);
        $sqlvar->bindParam(':email', $email);
        $sqlvar->execute();
        
        $accountid = $db->lastInsertId('accountid');
        
        $townsql = "INSERT INTO towns (townname, accountid) VALUES (:townname, :accountid)";
        $townvar = $db->prepare($townsql);
        $townvar->bindParam(':townname', $townname);
        $townvar->bindParam(':accountid', $accountid);
        $townvar->execute();
        
        $townid = $db->lastInsertId('townid');
        
        //Query voor Main Building
        $mbsql = "INSERT INTO towns_buildings (buildingname, buildinglevel, accountid, townid) VALUES (:buildingname, :buildinglevel, :accountid, :townid)";
        $mbsqlvar = $db->prepare($mbsql);
        $mbsqlvar->bindParam(':buildingname', $mainbuilding);
        $mbsqlvar->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar->bindParam(':accountid', $accountid);
        $mbsqlvar->bindParam(':townid', $townid);
        $mbsqlvar->execute();
        
        $qwheat1 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar2 = $db->prepare($qwheat1);
        $mbsqlvar2->bindParam(':buildingname', $wheat1);
        $mbsqlvar2->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar2->bindParam(':buildingtype', $twheat1);
        $mbsqlvar2->bindParam(':accountid', $accountid);
        $mbsqlvar2->bindParam(':townid', $townid);
        $mbsqlvar2->execute();
        
        $qwheat2 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar3 = $db->prepare($qwheat2);
        $mbsqlvar3->bindParam(':buildingname', $wheat2);
        $mbsqlvar3->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar3->bindParam(':buildingtype', $twheat2);
        $mbsqlvar3->bindParam(':accountid', $accountid);
        $mbsqlvar3->bindParam(':townid', $townid);
        $mbsqlvar3->execute();
        
        $qwheat3 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar4 = $db->prepare($qwheat3);
        $mbsqlvar4->bindParam(':buildingname', $wheat3);
        $mbsqlvar4->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar4->bindParam(':buildingtype', $twheat3);
        $mbsqlvar4->bindParam(':accountid', $accountid);
        $mbsqlvar4->bindParam(':townid', $townid);
        $mbsqlvar4->execute();
        
        $qwheat4 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar5 = $db->prepare($qwheat4);
        $mbsqlvar5->bindParam(':buildingname', $wheat4);
        $mbsqlvar5->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar5->bindParam(':buildingtype', $twheat4);
        $mbsqlvar5->bindParam(':accountid', $accountid);
        $mbsqlvar5->bindParam(':townid', $townid);
        $mbsqlvar5->execute();
        
        $qwheat5 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar6 = $db->prepare($qwheat5);
        $mbsqlvar6->bindParam(':buildingname', $wheat5);
        $mbsqlvar6->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar6->bindParam(':buildingtype', $twheat5);
        $mbsqlvar6->bindParam(':accountid', $accountid);
        $mbsqlvar6->bindParam(':townid', $townid);
        $mbsqlvar6->execute();
        
        $qwheat6 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar7 = $db->prepare($qwheat6);
        $mbsqlvar7->bindParam(':buildingname', $wheat6);
        $mbsqlvar7->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar7->bindParam(':buildingtype', $twheat6);
        $mbsqlvar7->bindParam(':accountid', $accountid);
        $mbsqlvar7->bindParam(':townid', $townid);
        $mbsqlvar7->execute();
        
        $qclay1 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar8 = $db->prepare($qclay1);
        $mbsqlvar8->bindParam(':buildingname', $clay1);
        $mbsqlvar8->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar8->bindParam(':buildingtype', $tclay1);
        $mbsqlvar8->bindParam(':accountid', $accountid);
        $mbsqlvar8->bindParam(':townid', $townid);
        $mbsqlvar8->execute();
        
        $qclay2 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar9 = $db->prepare($qclay2);
        $mbsqlvar9->bindParam(':buildingname', $clay2);
        $mbsqlvar9->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar9->bindParam(':buildingtype', $tclay2);
        $mbsqlvar9->bindParam(':accountid', $accountid);
        $mbsqlvar9->bindParam(':townid', $townid);
        $mbsqlvar9->execute();
        
        $qclay3 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar10 = $db->prepare($qclay3);
        $mbsqlvar10->bindParam(':buildingname', $clay3);
        $mbsqlvar10->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar10->bindParam(':buildingtype', $tclay3);
        $mbsqlvar10->bindParam(':accountid', $accountid);
        $mbsqlvar10->bindParam(':townid', $townid);
        $mbsqlvar10->execute();
        
        $qclay4 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar11 = $db->prepare($qclay4);
        $mbsqlvar11->bindParam(':buildingname', $clay4);
        $mbsqlvar11->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar11->bindParam(':buildingtype', $tclay4);
        $mbsqlvar11->bindParam(':accountid', $accountid);
        $mbsqlvar11->bindParam(':townid', $townid);
        $mbsqlvar11->execute();
        
        $qiron1 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar12 = $db->prepare($qiron1);
        $mbsqlvar12->bindParam(':buildingname', $iron1);
        $mbsqlvar12->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar12->bindParam(':buildingtype', $tiron1);
        $mbsqlvar12->bindParam(':accountid', $accountid);
        $mbsqlvar12->bindParam(':townid', $townid);
        $mbsqlvar12->execute();
        
        $qiron2 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar13 = $db->prepare($qclay2);
        $mbsqlvar13->bindParam(':buildingname', $iron2);
        $mbsqlvar13->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar13->bindParam(':buildingtype', $tiron2);
        $mbsqlvar13->bindParam(':accountid', $accountid);
        $mbsqlvar13->bindParam(':townid', $townid);
        $mbsqlvar13->execute();
        
        $qiron3 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar14 = $db->prepare($qclay3);
        $mbsqlvar14->bindParam(':buildingname', $iron3);
        $mbsqlvar14->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar14->bindParam(':buildingtype', $tiron3);
        $mbsqlvar14->bindParam(':accountid', $accountid);
        $mbsqlvar14->bindParam(':townid', $townid);
        $mbsqlvar14->execute();
        
        $qiron4 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar15 = $db->prepare($qclay4);
        $mbsqlvar15->bindParam(':buildingname', $iron4);
        $mbsqlvar15->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar15->bindParam(':buildingtype', $tiron4);
        $mbsqlvar15->bindParam(':accountid', $accountid);
        $mbsqlvar15->bindParam(':townid', $townid);
        $mbsqlvar15->execute();
        
        $qwood1 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar16 = $db->prepare($qwood1);
        $mbsqlvar16->bindParam(':buildingname', $wood1);
        $mbsqlvar16->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar16->bindParam(':buildingtype', $twood1);
        $mbsqlvar16->bindParam(':accountid', $accountid);
        $mbsqlvar16->bindParam(':townid', $townid);
        $mbsqlvar16->execute();
        
        $qwood2 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar17 = $db->prepare($qwood2);
        $mbsqlvar17->bindParam(':buildingname', $wood2);
        $mbsqlvar17->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar17->bindParam(':buildingtype', $twood2);
        $mbsqlvar17->bindParam(':accountid', $accountid);
        $mbsqlvar17->bindParam(':townid', $townid);
        $mbsqlvar17->execute();
        
        $qwood3 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar18 = $db->prepare($qwood3);
        $mbsqlvar18->bindParam(':buildingname', $wood3);
        $mbsqlvar18->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar18->bindParam(':buildingtype', $twood3);
        $mbsqlvar18->bindParam(':accountid', $accountid);
        $mbsqlvar18->bindParam(':townid', $townid);
        $mbsqlvar18->execute();
        
        $qwood4 = "INSERT INTO towns_buildings (buildingname, buildinglevel, buildingtype, accountid, townid) VALUES (:buildingname, :buildinglevel, :buildingtype, :accountid, :townid)";
        $mbsqlvar19 = $db->prepare($qwood4);
        $mbsqlvar19->bindParam(':buildingname', $wood4);
        $mbsqlvar19->bindParam(':buildinglevel', $buildinglevel);
        $mbsqlvar19->bindParam(':buildingtype', $twood4);
        $mbsqlvar19->bindParam(':accountid', $accountid);
        $mbsqlvar19->bindParam(':townid', $townid);
        $mbsqlvar19->execute();
    }
}

else if (!isset($_POST['submit'])) {
    $tpl->newBlock("FORM");
}

if (isset($error)) {
    $tpl->newBlock("ERROR");
    $tpl->Assign("ERROR", $error);
}

if ($succes == 1) {
    $tpl->newBlock("SUCCES");
    $tpl->Assign("SUCCES", $succestext);
}

$tpl->printToScreen();
?>
