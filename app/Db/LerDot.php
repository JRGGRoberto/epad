<?php

namespace App\Db;

class LerDot
{
    private static array $env = [];
    private string $pathEnvFile;

    public static function get(string $key): ?string
    {
        return self::$env[$key] ?? null;
    }

    private function openFilePutKeys(string $envFile): void
    {
        if (!file_exists($envFile) || !is_readable($envFile)) {
            throw new \RuntimeException("Arquivo .env não encontrado ou sem permissão: $envFile");
        }

        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }

            if (strlen($line) > 1) {
                [$key, $value] = array_pad(explode('=', $line, 2), 2, '');
                $key = trim($key);
                $value = trim($value);
                $value = trim($value, '"\'');

                self::$env = array_merge(self::$env, [$key => $value]);
            }
        }
    }

    private function locationFile()
    {
        $pontos = explode('/', $_SERVER['PHP_SELF']);
        $p = '';
        foreach (array_reverse($pontos) as $ponto) {
            $p .= '../';
            if (file_exists($p.'.env')) {
                return $p.'.env';
            }
        }

        return null;
    }

    public function __construct()
    {
        $this->pathEnvFile = $this->locationFile();
        if ($this->pathEnvFile !== null) {
            $this->openFilePutKeys($this->pathEnvFile);
        } else {
            throw new \RuntimeException('.env não encontrado');
        }
    }
}
