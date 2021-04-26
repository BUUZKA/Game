<?php
$buildingList = $v->buildingList();
$mainContent = "<h3>Karczma<h3>";
$mainContent = "<table class=\"table table-bordered\">";
$mainContent .= "<tr><th>Jedzenie</th><th>Ilość</th>
               <th>Wyprodukuj</th></tr>";

               $mainContent .= "<tr>
                    <td>Wino</td>
                    <td>0</td>
                    <form method=\"get\" action=\"index.php\">
                    <input type=\"hidden\" name=\"action\" value=\"newFood\">
                    <td><input type=\"number\" name=\"wino\" id=\"wino\"></td>
                    <td><button type=\"submit\">Wytwórz</button></td>
                    </form>
                </tr>";
                $mainContent .= "<tr>
                    <td>Talarki</td>
                    <td>0</td>
                    <form method=\"get\" action=\"index.php\">
                    <input type=\"hidden\" name=\"action\" value=\"newFood\">
                    <td><input type=\"number\" name=\"talarki\" id=\"talarki\"></td>
                    <td><button type=\"submit\">Wytwórz</button></td>
                    </form>
                </tr>";
                $mainContent .= "<tr>
                    <td>Mieso</td>
                    <td>0</td>
                    <form method=\"get\" action=\"index.php\">
                    <input type=\"hidden\" name=\"action\" value=\"newFood\">
                    <td><input type=\"number\" name=\"mieso\" id=\"mieso\"></td>
                    <td><button type=\"submit\">Wytwórz</button></td>
                    </form>
                </tr>";
                $mainContent .= "<tr>
                    <td>Zboze</td>
                    <td>0</td>
                    <form method=\"get\" action=\"index.php\">
                    <input type=\"hidden\" name=\"action\" value=\"newFood\">
                    <td><input type=\"number\" name=\"zboze\" id=\"zboze\"></td>
                    <td><button type=\"submit\">Wytwórz</button></td>
                    </form>
                </tr>";


$mainContent .= "</table>";


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