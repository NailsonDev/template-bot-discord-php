<?php 
// # Incluir as configurações do bot
// #
// include '../config/config.php';

namespace App\Functions;

class prefix
{
  public static function callCommand($message)
  {
    $prefix = prefix;  
    $position = strpos($message, $prefix);
    $initPosition = 0;

    // Verifica se a mensagem começa com o prefixo
    if ($position === $initPosition) {
        // Pega o resto da mensagem após o prefixo
        $secondLine = substr($message, strlen($prefix));
        $command = explode(' ', trim($secondLine))[0]; // Pega o primeiro comando após o prefixo
        
        // Verifica se o comando existe
        $pathCmds = __DIR__ . "/../cmds/$command.php";
        if (file_exists($pathCmds)) {
            return $pathCmds;
        } else {
            return "O comando '$command' não existe.";
        }
    }

    return false;
  }

}