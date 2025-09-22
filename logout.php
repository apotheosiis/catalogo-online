<?php
session_start();

// Desfaz todas as variáveis da sessão
$_SESSION = [];

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header('Location: login.php');
exit;
?>