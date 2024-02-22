<?php
session_start(); // Inicie a sessão se ainda não estiver iniciada

if (isset($_SESSION["nome"])) {
    // Se o usuário estiver logado, encerre a sessão
    session_destroy();
}

// Redirecione de volta para a página de login ou qualquer outra página que você preferir
header("Location: index.php");
exit();
?>
