<?php

namespace gelk\installer;

class Installer
{
    public static function postCreateProject()
    {
        // Diretório do instalador (gelk/tie)
        $installerDir = dirname(__DIR__, 2);

        // Diretório do projeto recém-criado (testar)
        $projectDir = getcwd() . '/';

        // Copiar arquivos da pasta skeleton para o novo projeto
        self::copyFiles('/skeleton', $projectDir);
    }

    // Função para copiar arquivos de uma pasta para outra
    private static function copyFiles($source, $destination)
    {
        if (is_dir($source)) {
            @mkdir($destination);
            $directory = dir($source);
            while (false !== ($file = $directory->read())) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                self::copyFiles("$source/$file", "$destination/$file");
            }
            $directory->close();
        } else {
            copy($source, $destination);
        }
    }
}
