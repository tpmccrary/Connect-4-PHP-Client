<?php
class GameInfo
{
    public $gameBoard;

    public $selectedStrat;

    public $pid;

    function __construct($selectedStrat, $gameBoard, $pid)
    {
        $this->selectedStrat = $selectedStrat;
        $this->gameBoard = $gameBoard;
        $this->pid = $pid;
    }
}