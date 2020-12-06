<?php 
class Village 
{

    private $buildings;
    
    public function __construct()
    {
        $this->buildings = array(
            'townHall' => 1,
            'woodcutter' => 1,
            'ironMine' => 1,
        );
    $this->storage = array(
        'wood' => 0,
        'iron' => 0,
    );
    }
    private function woodGain(int $deltaTime) : float
    {
        $gain = pow($this->buildings['woodcutter'],2) * 250;
        $perSecondGain = $gain / 3600;
        return $perSecondGain * $deltaTime;
    }
    private function ironGain(int $deltaTime) : float
    {
        $gain = pow($this->buildings['ironMine'],2) * 150;
        $perSecondGain = $gain / 3600;
        return $perSecondGain * $deltaTime;
    }
    public function gain($deltaTime)
    {
        $this->storage['wood'] += $this->woodGain($deltaTime);
    }
}
?>