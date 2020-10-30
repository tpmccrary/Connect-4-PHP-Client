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
    }
}