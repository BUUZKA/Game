<?php
class Village 
{
    private $gm;
    private $buildings;
    private $storage;
    private $upgradeCost;

    public function __construct($gameManger)
    {
        $this->gm = $gameManger;
        $this->log('Utworzono nową wioskę', 'info');
        $this->buildings = array(
            'townHall' => 1,
            'woodcutter' => 1,
            'ironMine' => 1,
        );
        $this->storage = array(
            'wood' => 0,
            'iron' => 0,
        );
        $this->upgradeCost = array( 
            'woodcutter' => array(
                2 => array(
                    'wood' => 100,
                    'iron' => 50,
                ),
                3 => array(
                    'wood' => 200,
                    'iron' => 100,
                )
            ),
            'ironMine' => array(
                1 => array(
                    'wood' => 100,
                ),
                2 => array(
                    'wood' => 300,
                    'iron' => 100,
                )
            ),
        );
    }
    private function woodGain(int $deltaTime) : float
    {
        $gain = pow($this->buildings['woodcutter'],2) * 10000;
        
        $perSecondGain = $gain / 3600;
        
        return $perSecondGain * $deltaTime;
    }
    private function ironGain(int $deltaTime) : float
    {
       
        $gain = pow($this->buildings['ironMine'],2) * 7000;
        
        $perSecondGain = $gain / 3600;
        
        return $perSecondGain * $deltaTime;
    }
    public function gain($deltaTime) 
    {
        $this->storage['wood'] += $this->woodGain($deltaTime);
        if($this->storage['wood'] > $this->capacity('wood'))
            $this->storage['wood'] = $this->capacity('wood');

        $this->storage['iron'] += $this->ironGain($deltaTime);
        if($this->storage['iron'] > $this->capacity('iron'))
            $this->storage['iron'] = $this->capacity('iron');
    }
    public function upgradeBuilding(string $buildingName) : bool
    {
        $currentLVL = $this->buildings[$buildingName];
        $cost = $this->upgradeCost[$buildingName][$currentLVL+1];
        foreach ($cost as $key => $value) {
            
            
            if($value > $this->storage[$key])
                return false;
        }
        foreach ($cost as $key => $value) {
            
            $this->storage[$key] -= $value;
        }
        
        $this->buildings[$buildingName] += 1; 
        return true;
    }
    public function checkBuildingUpgrade(string $buildingName) : bool
    {
        $currentLVL = $this->buildings[$buildingName];
        $cost = $this->upgradeCost[$buildingName][$currentLVL+1];
        foreach ($cost as $key => $value) {
            if($value > $this->storage[$key])
                return false;
        }
        return true;
    }
    public function showHourGain(string $resource) : string
    {
        switch($resource) {
            case 'wood':
                return $this->woodGain(3600);
            break;
            case 'iron':
                return $this->ironGain(3600);
            break;
            default:
                echo "Nie ma takiego surowca!";
            break;
        }
    }
    public function showStorage(string $resource) : string 
    {
        if(isset($this->storage[$resource]))
        {
            return floor($this->storage[$resource]);
        }
        else
        {
            return "Nie ma takiego surowca!";
        }
    }
    public function buildingLVL(string $building) : int 
    {
        return $this->buildings[$building];
    }
    public function capacity(string $resource) : int 
    {
        switch ($resource) {
            case 'wood':
                return $this->woodGain(60*60*12); 
                break;
            case 'iron':
                return $this->ironGain(60*60*6); 
                break;
                
            default:
                return 0;
                break;
        }
    }
    public function log(string $message, string $type)
    {
        $this->gm->l->log($message, 'village', $type);
    }
}
?>