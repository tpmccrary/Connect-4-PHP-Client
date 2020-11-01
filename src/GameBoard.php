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
}