<?php
// Conectar ao banco de dados
require 'bd/conexao.php';
$conexao = conexao::getInstance();

// Processar o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $conexao = conexao::getInstance();
    $sql = "SELECT id, nome FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $usuarios = $stm->fetchAll(PDO::FETCH_OBJ);  
    // Verificar as credenciais no banco de dados
    
    if(!empty($usuarios)){
        // Login bem-sucedido
        $indo = true;
        $nome = $usuarios[0]->nome;
        session_start();
        $_SESSION["nome"] = $nome;
        header("Location: index.php"); // Redirecionar para a página de dashboard
    } else {
        $indo = false;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Link do css do bootstrap na maquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <!-- link css do bootstrap da barra de pesquisa -->
    <link rel="stylesheet" href="css/navbar-fixed.css">
    <!-- css do login -->
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="card-meio">
    <span id="indo"></span>
    <h2>Login</h2>
    <form id="login-form" action="login.php" method="POST" class="total">
        <div class="form-group">
            <label for="username">Email:</label>
            <input type="text" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="senha" name="senha" class="form-control" required>
        </div>
        <div class="botao">
            <button type="submit" class="btn btn-primary">Entrar</button>
        </div>
    </form>
</div>
<script>
    var indo = <?php echo $indo?>
    console.log(indo)
    if(!indo){
        document.getElementById("indo").innerHTML = "Credenciais Inválidas"
        document.getElementById("indo").style.backgroundColor = ["rgba(255, 0, 0, 0.403)"]
        document.getElementById("indo").style.color = ["#000"]
        document.getElementById("indo").style.paddingLeft = ["1rem"]
        document.getElementById("indo").style.paddingRight = ["1rem"]
        document.getElementById("indo").style.paddingTop = ["1rem"]
        document.getElementById("indo").style.paddingBottom = ["1rem"]
        document.getElementById("indo").style.marginTop = ["-1rem"]
        document.getElementById("indo").style.marginBottom = ["1rem"]
        document.getElementById("indo").style.borderRadius = ["1rem"]
    }
</script>
</body>
</html>


