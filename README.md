# Monitor de Preços Laravel 🛒

Aplicação Laravel para monitorar o preço de produtos em um site de varejo brasileiro. Os preços são extraídos via scraping e armazenados com histórico.

## 🔧 Tecnologias Utilizadas

- PHP 8.3+
- Laravel 11 LTS
- MySQL/MariaDB
- Goutte (Scraping)
- Composer

## ⚙️ Funcionalidades

- Cadastro de produtos com URL da loja
- Extração de preços via comando Artisan
- Histórico de preços por produto
- Interface web simples para visualização

## 🧠 Lógica de Scraping

- **Site alvo:** Books to Scrape ((https://books.toscrape.com/catalogue/a-light-in-the-attic_1000/index.html))
- **Seletor CSS do preço:** `.price_color`
- **Comando Artisan:**  php artisan scrape:prices

```bash
php artisan scrape:prices

# Clone o projeto
git clone https://github.com/SEU-USUARIO/monitor-de-precos.git
cd monitor-de-precos

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