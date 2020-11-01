<?php
// Author: Timothy P. McCrary

// Static class responisble for the IO.
class ConsoleUi
{
    // Asks user for a URL.
    static function requestURl($defaultUrl)
    {
        echo "Enter the server URL[default: $defaultUrl] (enter nothing for default):\n";

        return readline();
    }

    // Asks user to select a strategy from the ones given.
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

    // Tells user a new game is being created.
    static function creatingNewGame()
    {
        echo "Creating a new game...\n";
    }

    // Displays the given game board to the user and where they placed their piece.
    static function displayBoard($board, $slot)
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
        if ($slot !== null)
        {
            for ($i=0; $i < sizeof($board); $i++) { 
                if (intval($slot) === $i)
                {
                    echo "*";
                break;
                }
                else
                {
                    echo "   ";
                }
            }
            echo "\n";
        }
    }

    // Request a slot from the user.
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

    // Tell the user who won.
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