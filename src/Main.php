<?php
include "ServerInfo.php";
include "ConsoleUi.php";
include "NetworkHandler.php";

$serverInfo = new ServerInfo();

// Call console UI to request user for url.
$serverInfo->givenUrl = ConsoleUi::requestURl($serverInfo::defaultUrl);

// Request info from the server using the given url, or if thats invalid use the default url.
$serverInfo->info = NetworkHandler::getServerInfo($serverInfo->givenUrl, $serverInfo::defaultUrl);

// Stores all the strategies take from the server.
$serverInfo->storeStrategies($serverInfo->info);

// Request which strategy the user wants.
ConsoleUi::requestStrategy($serverInfo->strategies);

