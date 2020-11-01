<?php

// Class that has info on the game board.
class GameBoard
{   
    // The width of the board.
    public $width;
    
    // The height of the board.
    public $height;

    // The board itself, stored as a 2D array.
    public $board;

    function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->createBoard();
    }

    // Create a new, empty board.
    function createBoard()
    {
        $this->board = array_fill(0, $this->height, array_fill(0, $this->width, "."));
    }

    // Update the board with given moves from the player and cpu.
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

    // Highlight the winner given the winner positions.
    function highLightWinner($winPos)
    {
        for ($i=0; $i < sizeof($winPos); ($i+=2)) { 
            $col = $winPos[$i] . "   ";
            $row = $winPos[$i + 1] . "\n";

            $this->board[intval($row)][intval($col)] = "W";
        }
    }
}