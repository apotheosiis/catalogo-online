<?php
function getDbConnection() {
    $envFile = __DIR__ . '/../.env';
    if (!file_exists($envFile)) {
        die('Erro: Arquivo .env não encontrado. Por favor, crie um a partir de .env.example.');
    }

    $env = parse_ini_file($envFile);

    $host = $env['DB_HOST'];
    $dbname = $env['DB_NAME'];
    $user = $env['DB_USER'];
    $pass = $env['DB_PASS'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Em um ambiente de produção, não exiba detalhes do erro.
        // Apenas registre o erro em um log.
        error_log('Connection failed: ' . $e->getMessage());
        die('Erro ao conectar ao banco de dados. Verifique a configuração.');
    }
}
?>