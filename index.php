<?php 
        require_once('./class/GameManager.class.php');
        session_start();
        if(!isset($_SESSION['gm'])) // jeżeli nie ma w sesji naszej wioski
        {
            $gm = new GameManager();
            $_SESSION['gm'] = $gm;
        } 
        else //mamy już wioskę w sesji - przywróć ją
        {
            $gm = $_SESSION['gm'];
        }
        $v = $gm->v; //niezależnie cyz nowa gra czy załadowana
        $gm->sync(); //przelicz surowce
        
        if(isset($_REQUEST['action'])) 
        {
            switch($_REQUEST['action'])
            {
                case 'upgradeBuilding':
                    $v->upgradeBuilding($_REQUEST['building']);
                    require('view/townHall.php');
                break;
                case 'newUnit':
                    if(isset($_REQUEST['spearmen'])) //kliknelismy wyszkol przy włócznikach
                    {
                        $count = $_REQUEST['spearmen']; //ilość nowych włóczników
                        $gm->newArmy($count, 0, 0, $v); //tworz nowy oddział włóczników w wiosce w ilosci $count;
                    }
                    if(isset($_REQUEST['archer']))
                    {
                        $count = $_REQUEST['archer']; 
                        $gm->newArmy(0, $count, 0, $v); 
                    }
                    if(isset($_REQUEST['cavalry']))
                    {
                        $count = $_REQUEST['cavalry']; 
                        $gm->newArmy(0, 0, $count, $v); 
                    }
                   
                    require('view/townSquare.php');
                break;
                case 'townHall':
                    require('view/townHall.php');
                break;
                case 'townSquare':
                    require('view/townSquare.php');
                break;
                case 'townKarczma':
                    require('view/townKarczma.php');
                break;
                default:
                    $gm->l->log("Nieprawidłowa zmienna \"action\"", "controller", "error");
            }
        }           
        if(isset($_REQUEST['action'])) 
        {
            switch($_REQUEST['action'])
            {
                case 'upgradeBuilding':
                    $v->upgradeBuilding($_REQUEST['building']);
                    require('view/townHall.php');
                break;
                case 'newFood':  
                     
                    if(isset($_REQUEST['zboze']))
                    {
                        $count = $_REQUEST['zboze']; 
                        $gm->newArmy(0, $count, 0, $v); 
                    }
                    if(isset($_REQUEST['wino']))
                    {
                        $count = $_REQUEST['wino']; 
                        $gm->newArmy(0, $count, 0, $v); 
                    }
                    if(isset($_REQUEST['mieso']))
                    {
                        $count = $_REQUEST['mieso']; 
                        $gm->newArmy(0, $count, 0, $v); 
                    }
                    if(isset($_REQUEST['talarki']))
                    {
                        $count = $_REQUEST['talarki']; 
                        $gm->newArmy(0, $count, 0, $v); 
                    }
                    require('view/townKarczma.php');
                break;
                case 'townHall':
                    require('view/townHall.php');
                break;
                case 'townSquare':
                    require('view/townSquare.php');
                break;
                case 'townKarczma':
                    require('view/townKarczma.php');
                break;
                default:
                    $gm->l->log("Nieprawidłowa zmienna \"action\"", "controller", "error");
                }
            }
        
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header class="row border-bottom">
            <div class="col-12 col-md-3">
                Informacje o graczu
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 col-md-3">
                        Drewno: <?php echo $v->showStorage("wood"); ?>
                    </div>
                    <div class="col-12 col-md-3">
                        Żelazo: <?php echo $v->showStorage("iron"); ?>
                    </div>
                    <div class="col-12 col-md-3">
                        Miedź: <?php echo $v->showStorage("copper"); ?>
                    </div>
                    <div class="col-12 col-md-3">
                        Złoto: <?php echo $v->showStorage("gold"); ?>
                    </div>
                    <div class="col-12 col-md-3">
                        Zboże: <?php echo $v->showStorage("zboze"); ?>
                    </div>
                    <div class="col-12 col-md-3">
                        Wino: <?php echo $v->showStorage("wino"); ?>
                    </div>
                    <div class="col-12 col-md-3">
                        Mięso: <?php echo $v->showStorage("mieso"); ?>
                    </div>
                    <div class="col-12 col-md-3">
                        Talarki: <?php echo $v->showStorage("talarki"); ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <button>wyloguj</button> 
            </div>
        </header>
        <main class="row border-bottom">
            <div class="col-12 col-md-2 border-right">
                Lista budynków<br>
                <!--
                Drwal, poziom <?php echo $v->buildingLVL("woodcutter"); ?> <br>
                Zysk/h: <?php echo $v->showHourGain("wood"); ?><br>
                <?php if($v->checkBuildingUpgrade("woodcutter")) : ?>
                <a href="index.php?action=upgradeBuilding&building=woodcutter">
                    <button>Rozbuduj drwala</button>
                </a><br>
                <?php else : ?>
                    <button onclick="missingResourcesPopup()">Rozbuduj drwala</button><br>
                <?php endif; ?>
                Kopalnia żelaza, poziom <?php echo $v->buildingLVL("ironMine"); ?> <br>
                Zysk/h: <?php echo $v->showHourGain("iron"); ?><br>
                <?php if($v->checkBuildingUpgrade("ironMine")) : ?>
                <a href="index.php?action=upgradeBuilding&building=ironMine">
                    <button>Rozbuduj kopalnie żelaza</button>
                </a>
                <?php else : ?>
                    <button onclick="missingResourcesPopup()">Rozbuduj kopalnie żelaza</button>
                <br>
                <?php endif; ?>
                <br>
                -->
                <ul style="list-style-type: none; padding:0;">
                    <li>
                        <a href="index.php?action=townHall">Zamek</a>
                    </li>
                    <li>
                        <a href="index.php?action=townSquare">Koszary</a>
                    </li>
                    <li>
                        <a href="index.php?action=townKarczma">Karczma</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-8" id="essa">
                <?php if(isset($mainContent)) : 
                    echo $mainContent; ?>
                <?php else : ?>
                Widok wioski
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-2 border-left" id="wojsko">
               <button>Lista wojska</button>
            </div>
        </main>
        <footer class="row">
            <div class="col-12">
            <table class="table table-bordered">
            <?php
            
                
                    
                
            
            foreach ($gm->l->getLog() as $entry) {
                $timestamp = date('d.m.Y H:i:s', $entry['timestamp']);
                $sender = $entry['sender'];
                $message = $entry['message'];
                $type = $entry['type'];
                echo "<tr>";
                echo "<td>$timestamp</td>";
                echo "<td>$sender</td>";
                echo "<td>$message</td>";
                echo "<td>$type</td>";
                echo "</tr>";
            }
            
            ?>
            </table>
            </div>
        </footer>
    </div>
    <script>
        function missingResourcesPopup() {
            window.alert("Brakuje zasobów");
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <pre>
    <?php
        echo "Obecny czas: ".time(); 
        var_dump($gm->s->schedule); 

    ?>
    </pre>
</body>
</html>