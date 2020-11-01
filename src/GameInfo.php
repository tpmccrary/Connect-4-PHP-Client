<?php
class GameInfo
{
    public $gameBoard;

    public $selectedStrat;

    public $pid;

    public $playerMove;

    public $playInfo;

    function __construct($selectedStrat, $gameBoard, $pid)
    {
        $this->selectedStrat = $selectedStrat;
        $this->gameBoard = $gameBoard;
        $this->pid = $pid;
    }
}