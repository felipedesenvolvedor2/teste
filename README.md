# Monitor de Preços Laravel 🛒

Aplicação Laravel para monitorar o preço de produtos em um site de varejo brasileiro. Os preços são extraídos via scraping e armazenados com histórico.

## 🔧 Tecnologias Utilizadas

- PHP 8.3+
- Laravel 11 LTS
- MySQL/MariaDB
- Crawler \ Css Selector
- Composer

## ⚙️ Funcionalidades

- Cadastro de produtos com URL da loja
- Extração de preços via comando Artisan
- Histórico de preços por produto
- Interface web simples para visualização

## 🧠 Lógica de Scraping

- **Site alvo:** Magazine Luiza https://www.magazineluiza.com.br/smartphone-samsung-galaxy-a06-128gb-4gb-ram-branco-67-cam-dupla-selfie-8mp/p/238657800/te/ga06/
- **Seletor CSS do preço:** `[data-testid="price-value"]
- **Comando Artisan:**  php artisan scrape:prices

```bash
php artisan scrape:prices

# Clone o projeto
git clone https://github.com/felipedesenvolvedor2/teste

# Instale as dependências
composer install

# Copie e configure o .env
cp .env.example .env
# Edite o .env com suas credenciais do banco de dados

# Gere a chave da aplicação
php artisan key:generate

# Rode as migrations
php artisan migrate

# Para rodar o servidor local durante o desenvolvimento, utilize:

php artisan serve

# Execute o comando abaixo para buscar os preços dos produtos cadastrados:

#Este comando: Busca todos os produtos no banco, Acessa a URL de cada produto, Extrai o preço com base em um seletor CSS,Formata o preço removendo "R$", pontos e substituindo vírgula por ponto e Salva o histórico na tabela price_histories com product_id, price e scraped_at.

php artisan scrape:prices


📌 Erros tratados
# URL inválida ou inacessível

# Seletor não encontrado na página

# Problemas na conversão do preço
