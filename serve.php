<?php
// Caminho para a pasta 'public' do Laravel
$publicDir = __DIR__ . '/public';

// Porta onde o servidor vai rodar
$host = 'localhost';
$port = 8000;

echo "Servidor Laravel rodando em http://$host:$port\n";
echo "Pressione Ctrl+C para parar...\n";

// Altera o diretório de trabalho para a pasta 'public'
chdir($publicDir);

// Inicia o servidor embutido do PHP
passthru("php -S $host:$port");