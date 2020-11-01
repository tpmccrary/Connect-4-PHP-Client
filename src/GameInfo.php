<?php
// Class that holds the game info.
class GameInfo
{
    // The board for the game.
    public $gameBoard;

    // The selected strategy.
    public $selectedStrat;

    // The pid needed to find game.
    public $pid;

    // The move the player made.
    public $playerMove;

    // The game info from the server.
    public $playInfo;

    function __construct($selectedStrat, $gameBoard, $pid)
    {
        $this->selectedStrat = $selectedStrat;
        $this->gameBoard = $gameBoard;
        $this->pid = $pid;
    }
}