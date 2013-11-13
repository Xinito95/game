<?php
session_start();
include("tpl/class.TemplatePower.inc.php");

$tpl = new TemplatePower("html/town.html");
$tpl->prepare();

$db = new PDO('mysql:host=localhost;dbname=game','root','');

$tpl->newBlock("DEFAULT");

$sql= "SELECT * FROM towns WHERE townid = :townid";
$sqlvar = $db->prepare($sql);
$sqlvar->bindParam(':townid', $_SESSION['townid']);
$sqlvar->execute();
        
while ($row = $sqlvar->fetch(PDO::FETCH_ASSOC)) {
    $tpl->assign(array("TOWNNAME" => $row['townname'],
                       "WOOD" => $row['wood'],
                       "CLAY" => $row['clay'],
                       "IRON" => $row['iron'],
                       "WHEAT" => $row['wheat']));
}
  
$tpl->printToScreen();
?>
