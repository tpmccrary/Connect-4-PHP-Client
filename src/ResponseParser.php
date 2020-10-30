<?php

class ResponseParser
{
    public static function parseInfo($httpResponse)
    {
        return json_decode($httpResponse);
    }
}