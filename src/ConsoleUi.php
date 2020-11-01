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
        echo "Enter number for corisponding strategy (default: 1):\n";

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

    static function displayBoard($board)
    {
        for ($i=0; $i < sizeof($board); $i++) { 
            for ($j=0; $j < sizeof($board[$i]); $j++) { 
                echo $board[$i][$j] . "  ";
            }
            echo "\n";
        }
    }
}