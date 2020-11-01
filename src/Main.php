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

ConsoleUi::creatingNewGame();
// Create new game from given info.
$newGameInfo = NetworkHandler::createNewGame($selectedStrat, $serverInfo->givenUrl, $serverInfo::defaultUrl);

// Creates a new game object to store all the game info.
$game = new GameInfo($selectedStrat, new GameBoard($serverInfo->boardWidth, $serverInfo->boardHeight), $newGameInfo->{'pid'});

mainGameLoop($game, $serverInfo);








function mainGameLoop($game, $serverInfo)
{
    $isWin = false;
    $cpuIsWin = false;
    while ($isWin === false && $cpuIsWin === false)
    {
        // Displays the board to the user.
        ConsoleUi::displayBoard($game->gameBoard->board);

        // Request user to choose what slot to place their piece.
        $game->playerMove = ConsoleUI::requestMove($game->gameBoard->width);

        $game->playInfo = NetworkHandler::makePlay($game->pid, $game->playerMove, $serverInfo->givenUrl, $serverInfo::defaultUrl);
        $isWin = $game->playInfo->{'ack_move'}->{'isWin'};
        $cpuIsWin = $game->playInfo->{'move'}->{'isWin'};

        $game->gameBoard->updateBoard($game->playerMove, $game->playInfo->{'move'}->{'slot'});
    }
}

