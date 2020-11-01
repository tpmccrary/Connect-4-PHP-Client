<?php
include "ServerInfo.php";
include "ConsoleUi.php";
include "NetworkHandler.php";
include "GameInfo.php";
include "GameBoard.php";

$serverInfo = new ServerInfo();

// Call console UI to request user for url.
$serverInfo->givenUrl = ConsoleUi::requestURl($serverInfo::defaultUrl);

// Request info from the server using the given url, or if thats invalid use the default url.
$serverInfo->info = NetworkHandler::getServerInfo($serverInfo->givenUrl, $serverInfo::defaultUrl);

// Stores all the strategies and board info take from the server.
$serverInfo->storeStrategies($serverInfo->info);
$serverInfo->storeBoardInfo($serverInfo->info);

// Request which strategy the user wants.
$selectedStrat = ConsoleUi::requestStrategy($serverInfo->strategies);

// Create new game from given info.
$newGameInfo = NetworkHandler::createNewGame($selectedStrat, $serverInfo->givenUrl, $serverInfo::defaultUrl);

// Creates a new game object to store all the game info.
$game = new GameInfo($selectedStrat, new GameBoard($serverInfo->boardWidth, $serverInfo->boardHeight), $newGameInfo->{'pid'});

// Displays the board to the user.
ConsoleUi::displayBoard($game->gameBoard->board);