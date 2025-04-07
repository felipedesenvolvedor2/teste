<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeTest extends Command
{
    protected $signature = 'scrape:test';
    protected $description = 'Testa scraping em HTML local';

    public function handle()
    {
        $htmlPath = public_path('teste.html');

        // Verifica se o arquivo existe
        if (!file_exists($htmlPath)) {
            $this->error("❌ Arquivo não encontrado em: $htmlPath");
            return;
        }

        // Lê o conteúdo do HTML
        $html = file_get_contents($htmlPath);

        // Cria o crawler
        $crawler = new Crawler($html);

        // Captura o texto do seletor desejado
        $priceText = $crawler->filter('.sc-eGugkK')->first()->text();


        // Exibe no terminal
        $this->info("✅ Preço encontrado: $priceText");
    }
}
