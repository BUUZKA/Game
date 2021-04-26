<?php
class Food {
    public $location; //referencja do wioski
    public $targetLocation; //cel armii - referencja do wioski
    public $targetETA; //czas dotarcia do celu (UNIX timestamp)

    public $wino;   //ilość jednostek
    public $talarki;    
    public $zboze;
    public $mieso;

    public function __construct($q, $w, $e, $r)
    {
        $this->wino = $q;
        $this->talrki = $w;
        $this->zboze = $e;
        $this->mieso = $r;
    }
}
?>