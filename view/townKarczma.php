<?php
$buildingList = $v->buildingList();
$mainContent = "<h3>Ratusz<h3>";
$mainContent = "<table class=\"table table-bordered\">";
foreach($buildingList as $index => $building) 
{
    $name = $building['buildingName'];
    $level = $building['buildingLVL'];
    $upgradeCost = "";
    foreach($building['upgradeCost'] as $resource => $cost)
    {
        $upgradeCost .= "$resource: $cost,";
    }
 
  
}
$mainContent .= "</table>";
$tasks = $gm->s->getTasksByFunction("scheduledBuildingUpgrade"); //znajdz na liscie zadan wszystie dotyczace rozbudoqwy budynków
foreach($tasks as $task)
{
    $buildingName = $task['param'];
    $scheduledTime = $task['timestamp'];
    $mainContent .= "<p>Budynek $buildingName będzie gotowy ".date('d.m.Y H:i:s', $scheduledTime)."</p>";
}

$mainContent .= "<a href=\"index.php\">Powrót</a>";

?>