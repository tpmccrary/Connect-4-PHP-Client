<?php
class ServerInfo{
    const defaultUrl = "https://cssrvlab01.utep.edu/Classes/cs3360/tpmccrary/C4Service/src";

    public $givenUrl;

    public $info;

    public $strategies = array();

    public function storeStrategies($info)
    {
        $stratArray = $info->{'strategies'};

        // I think I could just assign $stratigies by doing the line above, oh well.
        for ($i=0; $i < sizeof($stratArray); $i++) { 
            $strat = $stratArray[$i];
            array_push($this->strategies, $strat);
        }
    }
    

    // function __construct()
    // {

    // }
}
