<?php
namespace plantae;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Game\Engine;
use Game\GameBddRequests;
use Ratchet\Mock\Connection;

class GamesManager implements MessageComponentInterface {
    /**
     * @var connectionInterface[]
     */
    protected $clients;

    /**
     * @var Engine[]
     */
    protected $_games;
    protected $_nextGameId;

    /**
     * @var array
     */
    protected $_clientsCreator;

    /**
     * @var array
     */
    protected $_clientsPlayer;

    public function __construct() {
        $this->clients = array();
        $this->_clientsCreator = array();
        $this->_clientsPlayer = array();
        $this->_nextGameId = 0;
        $this->_games = array();

        /**
         * var array();
         */

    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients[$conn->resourceId] = $conn;
        $data = array();
        $isSuccessfull = true;
        $data['isSuccessfull'] = $isSuccessfull;
        $conn->send(json_encode($this->formatMessage('connection', $data)));
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        $data = json_decode($msg, true);
        //echo sprintf($data);
        $valid_functions = ['CreateGamePVP','CreateGameSolo','JoinGame','ModifyParam','connect', 'send', 'Test', 'Join', 'Ready', 'Attribute', 'GetAllFlowers', 'GetAllBiomes', 'GetAllGames'];
        if(in_array($data['event'],$valid_functions)) {
            $functionName = 'event' . $data['event'];
            $this->$functionName($from,$data);
        } else {
            echo "not an event :".$data['event'];
            //$from->send('INVALID REQUEST');
        }

        /*
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }*/
    }

    private function eventTest(ConnectionInterface $from, $data){
        $from->send('test réussi!');
    }

    private function eventGetAllGames(ConnectionInterface $from, $data){
        $gamesAvailable = array();

        foreach ($this->_games as $game){
            if($game->isGameFull() == false){
                $gamesAvailable[$game->getId()] = $game->getId();
            }
        }

        $from->send(json_encode(['event' => 'GetAllGames', 'data' => $gamesAvailable]));

    }

   private function eventCreateGamePVP(ConnectionInterface $from, $data){
        $flowerId = $data['data']['flowerId'];
        $biomeId = $data['data']['biomeId'];
        $maxTurns = $data['data']['maxTurns'];
        $this->_games[$this->_nextGameId] = Engine::enginePVP($from->resourceId, $flowerId,$biomeId, $this->_nextGameId, $maxTurns);
        //$from->send(('id server: '.strval($this->_games[$this->_nextGameId]->getId())));
       $from->send(json_encode(['event' => "CreatedGameMP",
           'data' => [] ]));
        $arrayCreator = $this->formatMessage('playerInfo',$this->_games[$this->_nextGameId]->sendInfoToCreator());
        $from->send(json_encode($arrayCreator));
        $this->_clientsCreator[$from->resourceId] = $this->_nextGameId;
        echo '==SERVER ID : '+$this->_nextGameId+' ==';
        $this->_nextGameId++;
    }

    private function eventCreateGameSolo(ConnectionInterface $from, $data){
        $flowerId = $data['data']['flowerId'];
        $biomeId = $data['data']['biomeId'];
        $maxTurns = $data['data']['maxTurns'];
        $this->_games[$this->_nextGameId] = Engine::engineSolo($from->resourceId, $flowerId,$biomeId, $this->_nextGameId, $maxTurns);
        //$from->send(('id server: '.strval($this->_games[$this->_nextGameId]->getId())));
        $arrayCreator = $this->formatMessage('playerInfo',$this->_games[$this->_nextGameId]->sendInfoToCreator());
        $from->send(json_encode($arrayCreator));
        $this->_clientsCreator[$from->resourceId] = $this->_nextGameId;
        $this->_nextGameId++;
    }

    private function eventAttribute(ConnectionInterface $from, $data){
        $variable = $data['data']["variable"];
        $gameId = $this->getGame($from->resourceId);
        $functionName = "attributePointTo".$variable;
        $points = 0;

        if($this->isCreator($from->resourceId, $gameId)){
            $points = $this->_games[$gameId]->_creator->getUpgradePoints();
            if($points > 0){
                $this->_games[$gameId]->_creator->$functionName();
            }
        }
        elseif($this->isPlayer($from->resourceId, $gameId)){
            $points = $this->_games[$gameId]->_player->getUpgradePoints();
            if($points > 0){
                $this->_games[$gameId]->_player->$functionName();
            }
        }

        if($points > 0){
            $from->send(json_encode(['event' => "Attributed",
                                    'data' => ['variable' => $variable] ]));

            if($this->isCreator($from->resourceId, $gameId)){
                $arrayCreator = $this->formatMessage('playerInfo',$this->_games[$gameId]->sendInfoToCreator());
                $from->send(json_encode($arrayCreator));
            }
            elseif($this->isPlayer($from->resourceId, $gameId)){
                $arrayPlayer = $this->formatMessage('playerInfo',$this->_games[$gameId]->sendInfoToPlayer());
                $from->send(json_encode($arrayPlayer));
            }


        }
        else{
            $from->send(json_encode(['event' => "NoMorePoints",
                                    'data' => [] ]));
        }
    }

    private function eventGetAllFlowers(ConnectionInterface $from, $data){
        $dbRequestResult = GameBddRequests::getInstance()->getAllFlowers();
        $flowerArray=[];
        foreach ($dbRequestResult as $row){
            $flowerArray[$row["idFlower"]] = $row["nameFr"];
       }
        $arrayToSend = $this->formatMessage('FlowerList', $flowerArray);
        $from->send(json_encode($arrayToSend));
    }

    private function eventGetAllBiomes(ConnectionInterface $from, $data){
        $dbRequestResult = GameBddRequests::getInstance()->getAllBiomes();
        $biomeArray=[];
        foreach ($dbRequestResult as $row){
            $biomeArray[$row["idBiome"]] = $row["nameBiome"];
        }
        $arrayToSend = $this->formatMessage('BiomeList', $biomeArray);
        $from->send(json_encode($arrayToSend));
    }

    private function getGame($id){
        $gameId = 0;
        foreach ($this->_clientsCreator as $key=>$value){
            if($key == $id){
                $gameId = $value;
            }
        }

        foreach ($this->_clientsPlayer as $key=>$value){
            if($key == $id){
                $gameId = $value;
            }
        }
        return $gameId;
    }

    private function eventJoin(ConnectionInterface $from, $data){

        $gameId = $data['data']['serverId'];
        if($this->gameExists($gameId)){
            if(!$this->_games[$gameId]->isGameFull()){
                $flowerId = $data['data']['flowerId'];
                $this->_games[$gameId]->joinGame($from->resourceId, $flowerId);
                $from->send(json_encode(['event' => "GameJoined",
                    'data' => [] ]));

                $connCreator = $this->getConn($this->_games[$gameId]->_creator->getId());
                $connCreator->send(json_encode(['event' => "PlayerJoined",
                    'data' => [] ]));

                $this->_clientsPlayer[$from->resourceId] = $gameId;
                $arrayPlayer = $this->formatMessage('playerInfo',$this->_games[$gameId]->sendInfoToPlayer());
                $from->send(json_encode($arrayPlayer));
            }
            else{
                $from->send(json_encode(['event' => "GameFull",
                    'data' => [] ]));
            }

        }
        else{
            $from->send(json_encode(['event' => "GameNull",
                'data' => [] ]));
        }
    }

    private function gameExists($gameId){
        $exists = false;
        foreach ($this->_games as $item){
            if($item->getId() == $gameId){
                $exists = true;
            }
        }
        return $exists;
    }

    private function eventReady(ConnectionInterface $from, $data){
        echo "Pret";
        $serverId = $this->getGame($from->resourceId);
        $isReady = $data['data']['isReady'];

        if($isReady){
            if($this->isCreator($from->resourceId, $serverId)){
                $this->_games[$serverId]->_creator->ready();
                //$from->send('vous etes pret');
                if($this->_games[$serverId]->isPVP()){
                    if($this->_games[$serverId]->_player->isReady()){
                        $this->gameLoop($serverId);
                    }
                }
                else{
                        $this->gameLoop($serverId);
                }

            }
            elseif ($this->isPlayer($from->resourceId, $serverId)){
                $this->_games[$serverId]->_player->ready();
                //$from->send('vous etes pret');
                if($this->_games[$serverId]->_creator->isReady()){
                    $this->gameLoop($serverId);
                }
            }
        }
    }

    private function gameLoop($gameId){
        echo "PretLoop";
        $winner = $this->gameCheckWinner($gameId);
        if($this->_games[$gameId]->isPVP()){
            $connCreator = $this->getConn($this->_games[$gameId]->_creator->getId());
            $connPlayer =  $this->getConn($this->_games[$gameId]->_player->getId());
            $gameEnded = false;
            if($winner == -1){
                $this->gameNextTurn($gameId);
                if($this->_games[$gameId]->getMaxTurns() == $this->_games[$gameId]->getTurn()){
                    $this->gameLoop($gameId);
                }
            }
            elseif($winner == 0){
                $connCreator->send(json_encode(['event' => "Draw",
                    'data' => [] ]));
                $connPlayer->send(json_encode(['event' => "Draw",
                    'data' => [] ]));
                $gameEnded = true;
            }
            else{
                $gameEnded = true;
                if($winner == $this->_games[$gameId]->_creator->getId()){
                    $connCreator->send(json_encode(['event' => "GameWon",
                        'data' => [] ]));
                    $connPlayer->send(json_encode(['event' => "GameLost",
                        'data' => [] ]));                }
                elseif($winner == $this->_games[$gameId]->_player->getId()){
                    $connCreator->send(json_encode(['event' => "GameLost",
                        'data' => [] ]));
                    $connPlayer->send(json_encode(['event' => "GameWon",
                        'data' => [] ]));
                }
            }
        }
        else{
            $connCreator = $this->getConn($this->_games[$gameId]->_creator->getId());
            $gameEnded = false;
            if($winner == -1){
                $this->gameNextTurn($gameId);
                if($this->_games[$gameId]->getMaxTurns() == $this->_games[$gameId]->getTurn()){
                    $this->gameLoop($gameId);
                }
            }
            elseif($winner == 0){
                $connCreator->send(json_encode(['event' => "Draw",
                    'data' => [] ]));
                $gameEnded = true;
            }
            else{
                $gameEnded = true;
                if($winner == $this->_games[$gameId]->_creator->getId()){
                    $connCreator->send(json_encode(['event' => "GameWon",
                        'data' => [] ]));
                }
                elseif($winner == -2){
                    $connCreator->send(json_encode(['event' => "GameLost",
                        'data' => [] ]));
                }
            }
        }

        if($gameEnded){
            if($this->_games[$gameId]->isPVP()) {

            $this->endGamePVP($connCreator->resourceId, $connPlayer->resourceId, $gameId);
            echo ("GAME ".$gameId." ENDED");
            }
            else{
            $this->endGameSolo($connCreator->resourceId, $gameId);
            echo ("GAME ".$gameId." ENDED");
            }

        }
    }

    private function endGamePVP($creatorId, $playerId, $gameId){
        $this->unsetCreator($creatorId);
        $this->unsetPlayer($playerId);
        $this->closeEngine($gameId);
    }

    private function endGameSolo($creatorId, $gameId){
        $this->unsetCreator($creatorId);
        $this->closeEngine($gameId);
    }

    private function unsetCreator($id){
        unset($this->_clientsCreator[$id]);
    }

    private function unsetPlayer($id){
        unset($this->_clientsPlayer[$id]);
    }

    private function closeEngine($gameId){
        $this->_games[$gameId]->closeEngine();
        unset($this->_games[$gameId]);
    }

    private function gameCheckWinner($gameId){
        $winner = $this->_games[$gameId]->winCheck();
        return $winner;
    }

    private function gameNextTurn($gameId){
        echo "pret gameNextTurn\n";
        if($this->_games[$gameId]->isPVP()) {
            $connCreator = $this->getConn($this->_games[$gameId]->_creator->getId());
            $connPlayer =  $this->getConn($this->_games[$gameId]->_player->getId());
           // $connCreator->send('Debut du tour suivant');
           // $connPlayer->send('Debut du tour suivant');

            $this->_games[$gameId]->nextTurn();
            $this->_games[$gameId]->_creator->notReady();
            $this->_games[$gameId]->_player->notReady();

            $arrayCreator = $this->formatMessage('playerInfo',$this->_games[$gameId]->sendInfoToCreator());
            $arrayPlayer = $this->formatMessage('playerInfo',$this->_games[$gameId]->sendInfoToPlayer());

            $connCreator->send(json_encode($arrayCreator));
            $connPlayer->send(json_encode($arrayPlayer));
        }
        else{
            $connCreator = $this->getConn($this->_games[$gameId]->_creator->getId());
           // $connCreator->send('Debut du tour suivant');
            echo "avant\n";
            $this->_games[$gameId]->nextTurn();
            echo "après\n";
            $this->_games[$gameId]->_creator->notReady();
            echo "send info\n";
            $arrayCreator = $this->formatMessage('playerInfo',$this->_games[$gameId]->sendInfoToCreator());
            $connCreator->send(json_encode($arrayCreator));
            //$arrayAi = $this->formatMessage('playerInfo', $this->_games[$gameId]->sendAiInfo());
            //$connCreator->send(json_encode($arrayAi));
        }

    }



    private function formatMessage($event, $data){
        $array = array();
        $array['event'] = $event;
        $array['data'] = $data;
        return $array;
    }

    private function getConn($id){
        return $this->clients[$id];
    }

    private function isCreator($id, $idServer){
        $isCreator = false;
        if($id == array_search($idServer, $this->_clientsCreator)){
            $isCreator = true;
        }

        return $isCreator;
    }

    private function isPlayer($id, $idServer){
        $isPlayer = false;
        if($id == array_search($idServer, $this->_clientsPlayer)){
            $isPlayer = true;
        }

        return $isPlayer;
    }


    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        unset($this->clients[$conn->resourceId]);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}