<?php
session_start();

// Desfaz todas as variáveis da sessão
$_SESSION = [];

// Destrói a sessão
session_destroy();

// Redireciona para a página PÚBLICA (index), como solicitado.
header('Location: index.php');
exit;
?>