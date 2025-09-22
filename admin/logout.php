<?php
session_start();

// 1. Desfaz todas as variáveis da sessão no script atual.
$_SESSION = [];

// 2. Destrói a sessão no servidor.
session_destroy();

// 3. Redireciona o usuário para a página inicial.
header('Location: ../index.php');
exit;
?>