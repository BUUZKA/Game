<?php
session_start();

if( !isset($_SESSION['ostatniRefresh']) ) 
{
    $_SESSION['ostatniRefresh'] = time(); 
    $_SESSION['skladDrewna'] = 0;
}
else
{
    $staryCzas = date('H:i:s d.m.Y', $_SESSION['ostatniRefresh']); 
    $nowyCzas = date('H:i:s d.m.Y'); 
    $iloscSekund = time() - $_SESSION['ostatniRefresh'];
    echo "Od $staryCzas do teraz ($nowyCzas) minęło $iloscSekund sekund<br>";
    $produkcjaDrewna = 1000;
    $_SESSION['skladDrewna'] += $iloscSekund * ( $produkcjaDrewna / 3600 );
    echo "Skład drewna: ".floor($_SESSION['skladDrewna'])."<br>";
    $_SESSION['ostatniRefresh'] = time();
}

?>