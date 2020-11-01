<?php
// Author: Timothy P. McCrary

include "ServerInfo.php";
include "ConsoleUi.php";
include "NetworkHandler.php";
include "GameInfo.php";
include "GameBoard.php";

// Object that will hold the server info.
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

// Tell the user a game is being created.
ConsoleUi::creatingNewGame();
// Create new game from the server with given info.
$newGameInfo = NetworkHandler::createNewGame($selectedStrat, $serverInfo->givenUrl, $serverInfo::defaultUrl);

// Creates a new game object to store all the game info.
$game = new GameInfo($selectedStrat, new GameBoard($serverInfo->boardWidth, $serverInfo->boardHeight), $newGameInfo->{'pid'});

// Start the main game loop.
mainGameLoop($game, $serverInfo);



// The main game loop.
// Playing connect 4.
function mainGameLoop($game, $serverInfo)
{
    // Flags to record if there was a win or draw.
    $isWin = false;
    $isCpuWin = false;
    $isDraw = false;
    $isCpuDraw = false;

    while ($isWin === false && $isCpuWin === false && $isDraw === false && $isCpuDraw === false)
    {
        // Displays the board to the user.
        ConsoleUi::displayBoard($game->gameBoard->board, $game->playerMove);

        // Request user to choose what slot to place their piece.
        $game->playerMove = ConsoleUI::requestMove($game->gameBoard->width);

        // Make a play, send it to the server, and store response.
        $game->playInfo = NetworkHandler::makePlay($game->pid, $game->playerMove, $serverInfo->givenUrl, $serverInfo::defaultUrl);
        
        // Get win or draw from server response.
        $isWin = $game->playInfo->{'ack_move'}->{'isWin'};
        $isCpuWin = $game->playInfo->{'move'}->{'isWin'};
        $isDraw = $game->playInfo->{'ack_move'}->{'isDraw'};
        $isCpuDraw = $game->playInfo->{'move'}->{'isDraw'};

        // Update the game board.
        $game->gameBoard->updateBoard($game->playerMove, $game->playInfo->{'move'}->{'slot'});
    }  

    // Checks who wins and shows the winning peices.
    if ($isWin === true)
    {
        // Highlight which pieces won.
        $game->gameBoard->highLightWinner($game->playInfo->{'ack_move'}->{'row'});
    }
    else if ($isCpuWin == true)
    {
        // Highlight which pieces won.
        $game->gameBoard->highLightWinner($game->playInfo->{'move'}->{'row'});
    }
    
    
    // Display the board with the winner and say who won.
    ConsoleUi::displayBoard($game->gameBoard->board, $game->playerMove);
    ConsoleUI::acknowledgeWinner($isWin, $isCpuWin, $isDraw, $isCpuDraw);

}

