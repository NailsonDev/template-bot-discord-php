<?php 

namespace App\Functions;

class prefix
{
  public static function checkPrefix($message)
  {
    $attributesData = [];
    $attributes = [];
    $directory = __DIR__ . '/../cmds/';

    // Verificar se é um prefix valido.
    $position = strpos($message, prefix);
    if($position === 0){

      $secondLine   = substr($message, strlen(prefix)); // Pega todo o conteúdo após o prefix
      $commandClean = explode(' ', trim($secondLine))[0]; // Pega o primeiro comando após o prefixo
      $files        = glob($directory . '/*.php'); // Pega todos os arquivos PHP na pasta
    
      foreach ($files as $file) {
          $content = file_get_contents($file);
          if (preg_match('/\$attributes\s*=\s*(\[.*?\]);/s', $content, $matches)) {
              eval('$attributes = ' . $matches[1] . ';');
              $attributesData[$file] = $attributes;
          }
      }

      foreach($attributesData as $commands){
        // Verificar o comando principal.
        if($commands['name'] == $commandClean){
          return self::callCommand($commands['name']);
        }else{
          foreach($commands['alternative'] as  $cmd){
            (string) $sCmd = $cmd;
            if($commandClean == $sCmd){
              return self::callCommand($commands['name']);
            }
          }

        }
      }

      return "> O comando `$commandClean` não existe!";
    }

  }
  public static function callCommand($command)
  {
    // Verifica se o comando existe
    $pathCmds = __DIR__ . "/../cmds/$command.php";
    if (file_exists($pathCmds)) {
      return $pathCmds;
    } else {
      return "O comando '$command' não existe.";
    }
  }
}