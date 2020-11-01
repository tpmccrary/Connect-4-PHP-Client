<?php
// Author: Timothy P. McCrary

// Stores info from the server.
class ServerInfo{
    // The default URL to connect to.
    const defaultUrl = "https://cssrvlab01.utep.edu/Classes/cs3360/tpmccrary/C4Service/src";

    // The url given from the user.
    public $givenUrl;

    // The info from the server.
    public $info;

    // The available strategies.
    public $strategies = array();

    // The width of the game board.
    public $boardWidth;
    // The height of the game board.
    public $boardHeight;

    // Store the strategies from the server.
    public function storeStrategies($info)
    {
        $stratArray = $info->{'strategies'};

        // I think I could just assign $stratigies by doing the line above, oh well.
        for ($i=0; $i < sizeof($stratArray); $i++) { 
            $strat = $stratArray[$i];
            array_push($this->strategies, $strat);
        }
    }

    // Stores the info about the board.
    public function storeBoardInfo($info)
    {
        $this->boardWidth = $info->{'width'};
        $this->boardHeight = $info->{'height'};
    }
    

    // function __construct()
    // {

    // }
}
