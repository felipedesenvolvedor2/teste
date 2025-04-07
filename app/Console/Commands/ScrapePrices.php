<?php

namespace App\Console\Commands;

use App\Models\products;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ScrapePrices extends Command
{
    protected $signature = 'scrape:prices';
    protected $description = 'Extrai preços de produtos e salva no histórico';

    public function handle()
    {
        $client = new Client();
        $products = products::all();

        foreach ($products as $product) {
            try {
                $response = $client->get($product->url, [
                    'headers' => [
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36',
                        'Accept'     => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                        'Accept-Language' => 'pt-BR,pt;q=0.9,en;q=0.8',
                    ],
                    'verify' => base_path('cacert.pem'), 
                ]);

                $html = (string) $response->getBody();
                $crawler = new Crawler($html);

                // Valida se o seletor existe
                if ($crawler->filter('[data-testid="price-value"]')->count() === 0) {
                    $this->warn("Preço não encontrado para {$product->url}.");
                    continue;
                }

                $priceText = $crawler->filter('[data-testid="price-value"]')->first()->text();

                // Remove tudo que não for número,virgula ou ponto , usando expressão regulares.
                $priceText = preg_replace('/[^\d,\.]/', '', $priceText); 

                if (strpos($priceText, ',') !== false && strpos($priceText, '.') !== false) {
                    // . milhar, , decimal
                    $priceText = str_replace('.', '', $priceText);
                    $priceText = str_replace(',', '.', $priceText);
                } elseif (strpos($priceText, ',') !== false) {
                    $priceText = str_replace(',', '.', $priceText);
                }

                $price = floatval($priceText);

                if ($price <= 0) {
                    $this->warn("Preço inválido para {$product->url}: '{$priceText}'");
                    continue;
                }

                // Salva via relacionamento (se definido no model Product)
                $product->priceHistories()->create([
                    'price' => $price,
                    'scraped_at' => now(),
                ]);

                $msg = "Preço atualizado para {$product->url}: R$ " . number_format($price, 2, ',', '.');
                $this->info($msg);
                \Log::info($msg);

            } catch (\Exception $e) {
                $this->error("Erro ao acessar {$product->url}: {$e->getMessage()}");
                \Log::error("Erro ao acessar {$product->url}: {$e->getMessage()}");
            }
        }
    }
}
