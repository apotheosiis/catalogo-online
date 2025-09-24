<?php
session_start();

// Limpa apenas as variáveis de sessão do cliente para não afetar um possível login de admin
unset($_SESSION['cliente_loggedin']);
unset($_SESSION['cliente_id']);
unset($_SESSION['cliente_nome']);

// Redireciona para a página inicial
header('Location: index.php');
exit;
?>