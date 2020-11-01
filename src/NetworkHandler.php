<?php
include "ResponseParser.php";
class NetworkHandler
{
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
}
