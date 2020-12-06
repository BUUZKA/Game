<?php 
        require_once('./class/GameManager.class.php');
        session_start();
        if(!isset($_SESSION['gm'])) 
        {
            $gm = new GameManager();
            $_SESSION['gm'] = $gm;
        } 
        else 
        {
            $gm = $_SESSION['gm'];
        }
        $v = $gm->v; 
        $gm->sync(); 
        
        if(isset($_REQUEST['action'])) 
        {
            switch($_REQUEST['action'])
            {
                case 'upgradeBuilding':
                    if($v->upgradeBuilding($_REQUEST['building']))
                    {
                        echo "Ulepszono budynek: ".$_REQUEST['building'];
                    }
                    else
                    {
                        echo "Nie udało się ulepszyć budynku: ".$_REQUEST['building'];
                    }
                    
                break;
                default:
                    echo 'Nieprawidłowa zmienna "action"';
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
            <div class="col-12 col-md-3" id="wyloguj" id="ikonka">
                Twoje zasoby
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 col-md-3" id="wyloguj">
                        Drewno: <?php echo $v->showStorage("wood"); ?>
                    </div>
                    <div class="col-12 col-md-3" id="wyloguj">
                        Żelazo: <?php echo $v->showStorage("iron"); ?>
                    </div>
                    <div class="col-12 col-md-3" id="wyloguj" id="wyloguj">
                        Miedź: <?php echo $v->showStorage("wood"); ?>
                    </div>
                    <div class="col-12 col-md-3" id="wyloguj">
                        Złoto: <?php echo $v->showStorage("wood"); ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3" id="wyloguj">
                WYLOGUJ
            </div>
        </header>
        <main class="row border-bottom" >
            <div class="col-12 col-md-3 border-right" >
                Lista budynków<br>
                Drwal, poziom <?php echo $v->buildingLVL("woodcutter"); ?> <br>
                Przychód/h: <?php echo $v->showHourGain("wood"); ?><br>
                <?php if($v->checkBuildingUpgrade("woodcutter")) : ?>
                <a href="index.php?action=upgradeBuilding&building=woodcutter">
                    <button>Rozbuduj drwala</button>
                </a><br>
                <?php else : ?>
                    <button onclick="missingResourcesPopup()">Rozbuduj drwala</button><br>
                <?php endif; ?>
                Kopalnia żelaza, poziom <?php echo $v->buildingLVL("ironMine"); ?> <br>
                Przychód/h: <?php echo $v->showHourGain("iron"); ?><br>
                <?php if($v->checkBuildingUpgrade("ironMine")) : ?>
                <a href="index.php?action=upgradeBuilding&building=ironMine">
                    <button>Rozbuduj kopalnie żelaza</button>
                </a>
                <?php else : ?>
                    <button onclick="missingResourcesPopup()">Rozbuduj kopalnie żelaza</button>
                <br>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-6" id="obrazek">
                
            </div>
            <div class="col-12 col-md-3 border-left" id="wojsko">
                Lista wojska
            </div>
        </main>
        <footer class="row">
            <div class="col-12">
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
</body>
</html>