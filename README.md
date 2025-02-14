*Instalando o banco de dados
-------------------------------
1-Com o postgreSQL instalado, abra o pgAdmin 4;

2-Defina o usuário do PostgreSQL para "postgres" e senha "MyDatabase747" (dados podem ser alterados nas variáveis do DBConnection.php se desejar);

3-Crie um database "Valdemir";

4-Aperte botão direito no novo Database e selecione "Restore", e escolha o arquivo Valdemir.sql;

5-Verificar se criou a tabela users e 2 valores de entrada para fins de teste, executando a query: SELECT * FROM users;

*Executando o projeto
-------------------------------
1-No terminal (Seja pelo cmd ou pelo VS Code), localize a pasta do projeto pelos comandos "cd pasta-do-diretorio";

2-Digite o comando para iniciar o servidor embutido do php:  php -S localhost:8080;

3-Com o servidor ligado, vá para o navegador e digite "http://localhost:8080/" para executar o projeto.
