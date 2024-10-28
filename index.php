<?php

include __DIR__.'/vendor/autoload.php';
include 'app/config/config.php';

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Intents;
use Discord\WebSockets\Event;
use App\Functions\prefix;
use Discord\Parts\Interactions\Interaction;

$discord = new Discord([
    'token' => Client['token'],
    'intents' => Intents::getDefaultIntents()
]);

$discord->on('ready', function (Discord $discord) {
    echo "[PRONTO] Estou disponível mestre!", PHP_EOL;
});

$response = false;
$discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) use (&$response) {
    
    // Ignorar mensagem de outros bots.
    if ($message->author->bot) return;
    
    // Chama o método para verificar se é um comando
    $response = Prefix::checkPrefix($message->content);

    if ($response && file_exists($response)) {
        include($response);
    } else {
        $message->reply($response);
    }
});

$discord->run();