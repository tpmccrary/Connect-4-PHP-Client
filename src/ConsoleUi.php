<?php

class ConsoleUi
{
    static function requestURl($defaultUrl)
    {
        echo "Enter the server URL[default: $defaultUrl] (enter nothing for default):\n";

        return readline();
    }

    static function requestStrategy($strategies)
    {
        echo "Enter number for corisponding strategy:\n";

        for ($i=0; $i < sizeof($strategies); $i++) { 
            $strat = $strategies[$i];
            $option = $i + 1;
            echo "$option. $strat\n";
        }

        $choice = readLine();

        if ($choice < 1 || $choice > sizeof($strategies))
        {
            echo "Not a valid choice.\n";
            return ConsoleUi::requestStrategy($strategies);
        }
        else
        {
            $strat = $strategies[$choice - 1];
            return $strat;
        }
    }

    static function creatingNewGame()
    {
        echo "Creating a new game...\n";
    }

    static function displayBoard($board)
    {
        for ($i=0; $i < sizeof($board); $i++) { 
            for ($j=0; $j < sizeof($board[$i]); $j++) { 
                echo $board[$i][$j] . "  ";
            }
            echo "\n";
        }
        for ($i=0; $i < sizeof($board) + 1; $i++) { 
            echo $i + 1 . "  ";
        }
        echo "\n";
    }

    static function requestMove($width)
    {
        echo "Select a slot (1 - $width):\n"; 

        $slot = readLine();

        if ($slot < 1 || $slot > $width)
        {
            echo "Not a valid slot.";
            return ConsoleUi::requestMove($width);
        }
        else
        {
            return $slot - 1;
        }
    }

    static function acknowledgeWinner($isWin, $isCpuWin, $isDraw, $isCpuDraw)
    {
        if ($isWin === true)
        {
            echo "You won, well done!!\n";
        }
        else if ($isCpuWin === true)
        {
            echo "You lost, better luck next time!\n";
        }
        else if($isDraw === true || $isCpuDraw === true)
        {
            echo "It's a draw!\n";
        }
        else
        {
            echo "????";
        }
    }
    
}