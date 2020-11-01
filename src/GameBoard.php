<?php

class GameBoard
{
    public $width;
    public $height;

    public $board;

    function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->createBoard();
    }

    function createBoard()
    {
        $this->board = array_fill(0, $this->height, array_fill(0, $this->width, "."));
    }

    function updateBoard($playerSlot, $cpuSlot)
    {
        $placedPiece = false;
        $placedCpuPiece = false;
        for ($i=$this->height - 1; $i > 0; $i--) { 
            if ($this->board[$i][$playerSlot] == "." && $placedPiece === false)
            {
                $this->board[$i][$playerSlot] = "X";
                $placedPiece = true;
            }
            if ($this->board[$i][$cpuSlot] == "." && $placedCpuPiece == false)
            {
                $this->board[$i][$cpuSlot] = "O";
                $placedCpuPiece = true;
            }

            if ($placedPiece === true && $placedCpuPiece === true)
            {
                return;
            }
        }
    }

    function highLightWinner($winPos)
    {
        for ($i=0; $i < sizeof($winPos); ($i+=2)) { 
            $col = $winPos[$i] . "   ";
            $row = $winPos[$i + 1] . "\n";

            $this->board[intval($row)][intval($col)] = "W";
        }
    }
}