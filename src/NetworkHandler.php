<?php
include "ResponseParser.php";

// Static class that handles communication with the server.
class NetworkHandler
{
    // Gets the server info.
    public static function getServerInfo($givenUrl, $defaultUrl)
    {
        // Request to server, @surpresses PHP Warning.
        $xml = @file_get_contents($givenUrl . "/info");

        if ($xml === false)
        {
            echo "Invalid URL.\nUsing defualt URL...\n"; 
            $xml = file_get_contents($defaultUrl . "/info");
        }

        $obj = ResponseParser::parseInfo($xml);

        // Just to view contents of return decode.
        // var_dump($obj);
        // echo $obj->{'strategies'}[0];

        return $obj;

    }

    // Creates a new game givena  strategy and returns the new game info.
    public static function createNewGame($strat, $givenUrl, $defaultUrl)
    {
        // Request to server.
        $xml = @file_get_contents($givenUrl . "/new/?strategy=" . $strat);

        if ($xml === false)
        {
            $xml = file_get_contents($defaultUrl . "/new/?strategy=" . $strat);
        }

        $obj = ResponseParser::parseInfO($xml);

        return $obj;
    }

    // Makes a play and returns the play info.
    public static function makePlay($pid, $move, $givenUrl, $defaultUrl)
    {
        // Request to server.
        $xml = @file_get_contents($givenUrl . "/play/?pid=" . $pid . "&move=" . $move);

        if ($xml === false)
        {
            $xml = @file_get_contents($defaultUrl . "/play/?pid=" . $pid . "&move=" . $move);
        }

        $obj = ResponseParser::parseInfO($xml);

        return $obj;
    }
}
