<?php
session_start();

include("tpl/class.TemplatePower.inc.php");

$tpl = new TemplatePower("html/build.html");
$tpl->prepare();

$db = new PDO('mysql:host=localhost;dbname=game','root','');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
}
else {
    $id = NULL;
}

switch($id) {
    default:
    try {
        if (isset($_GET['id'])) {
            
            $id = $_GET['id'];

            $sqlvar2 = $db->prepare("SELECT * FROM towns_buildings WHERE buildingtype = :buildingtype AND accountid = :accountid AND townid = :townid");
            $sqlvar2->bindParam(':townid', $_SESSION['townid']);
            $sqlvar2->bindParam(':buildingtype', $id);
            $sqlvar2->bindParam(':accountid', $_SESSION['accountid']);
            $sqlvar2->execute();
        }
        while ($row = $sqlvar2->fetch()) {
            $tpl->newBlock("BUILDING");
            $tpl->assign(array("BUILDINGNAME" => $row['buildingname'], "BUILDINGRANK" => $row['buildinglevel']));
            if ($row['buildingtype'] == 1 && $row['buildinglevel'] == 0) {
                
                $woodc = 25;
                $clayc = 25;
                $wheatc = 15;
                $ironc = 10;
                               
                if (isset($_POST['submit'])) {
                    $query = "SELECT * FROM towns WHERE townid = :townid";
                    $queryvar= $db->prepare($query);
                    $queryvar->bindParam(':townid', $_SESSION['townid']);
                    $queryvar->execute();
                    
                    $row2 = $queryvar->fetch();
                                       
                    $woodrow = $row2['wood'];
                    $clayrow = $row2['clay'];
                    $wheatrow = $row2['wheat'];
                    $ironrow = $row2['iron'];
                    
                    $woodtotal = $woodrow - $woodc;
                    $claytotal = $clayrow - $clayc;
                    $irontotal = $ironrow - $ironc;
                    $wheattotal = $wheatrow - $wheatc;
                                        
                    $update = "UPDATE towns SET wood = :wood, clay = :clay, iron = :iron, wheat = :wheat WHERE accountid = :accountid";
                    $updatef = $db->prepare($update);
                    $updatef->bindParam(':wood', $woodtotal);
                    $updatef->bindParam(':clay', $claytotal);
                    $updatef->bindParam(':iron', $irontotal);
                    $updatef->bindParam(':wheat', $wheattotal);
                    $updatef->bindParam(':accountid', $_SESSION['accountid']);
                    $updatef->execute();
                    
                    $id = $_GET['id'];
                    $level = 1;
                    $levelrow = $row['buildinglevel'];
                    $nextlevel = 1;
                    
                    $updatel = "UPDATE towns_buildings SET buildinglevel = :buildinglevel WHERE accountid = :accountid AND townid = :townid";
                    $updatell = $db->prepare($updatel);
                    $updatell->bindParam(':buildinglevel', $nextlevel);
                    //$updatell->bindParam(':buildingtype', $id);
                    $updatell->bindParam(':accountid', $_SESSION['accountid']);
                    $updatell->bindParam(':townid', $_SESSION['townid']);
                    header('Location: town.php');
                    
                } else if (!isset($_POST['submit'])) {
                    
                    $message = "Upgrading will cost:";
                    
                    $tpl->newBlock("TYPE1LEVEL0");
                    $tpl->assign(array("MESSAGE" => $message, "WOOD" => $woodc, "CLAY" => $clayc, "IRON" => $ironc, "WHEAT" => $wheatc));
                }
            }
        }
        

    }
    catch (PDOException $e) {
        echo $e->getMessage();
}
}

$tpl->printToScreen();
?>
