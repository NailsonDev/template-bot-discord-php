<?php

use Discord\Parts\Embed\Embed;

$attributes = [
    'name'        => 'invite',
    'description' => null,
    'permission'  => [],
    'alternative' => ['convite', 'convidar'],
];

$canal = $discord->getChannel($message->channel_id);

// Cria o embed
$embed = new Embed($discord);
$embed->setTitle('Título do Embed')
      ->setDescription('Essa é uma mensagem embed')
      ->setColor(0x00FF00) // Cor em hexadecimal
      ->addField([
          'name' => 'Campo 1',
          'value' => 'Valor do Campo 1',
          'inline' => true,
      ])
      ->addField([
          'name' => 'Campo 2',
          'value' => 'Valor do Campo 2',
          'inline' => true,
      ]);

// Envia a mensagem com o embed
$canal->sendMessage($message->author, false, $embed);