<?php
session_start();
if (isset($_SESSION["nome"])) {
    $nome = $_SESSION["nome"];
    // Agora você pode usar a variável $nome em qualquer lugar desta página    
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Link do css do bootstrap na maquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <!-- link css do bootstrap da barra de pesquisa -->
    <link rel="stylesheet" href="css/navbar-fixed.css">
    <!-- link css customizado -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        #nomeUsu{
            color: #ffffff;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexcli.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexfor.php">Fornecedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexusu.php">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexpro.php">Produtos</a>
                    </li>
                </ul>
                <?php if(!empty($_SESSION["nome"])): ?>
                <span id="nomeUsu"></span>
                <div class="d-flex" role="search" style="padding-left: 1rem;">
                <a href="sair.php"><button class="bundao">Sair</button></a>
                </div>
                <?php else:  ?>
                <div class="d-flex" role="search">
                    <a href="login.php"><button class="bundao">Login</button></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container py-4">
        <div class="p-5 mb-4 bg-body-tertiary border rounded-3">
            <div class="container-fluid py-5 centro">
                <h2 class="display-5 fw-bold">Tela de Clientes</h2>
                <a href="indexcli.php">
                    <button class="butao" type="button">Entrar</button>
                </a>
            </div>
        </div>
        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3 centro">
                    <h2 class="display-5 fw-bold">Tela de Fornecedores</h2>
                    <a href="indexfor.php">
                        <button class="butao" type="button">Entrar</button>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3 centro">
                    <h2 class="display-5 fw-bold">Tela de Usuários</h2>
                    <a href="indexusu.php">
                        <button class="butao" type="button">Entrar</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="p-5 mb-4 bg-body-tertiary border rounded-3">
            <div class="container-fluid py-5 centro">
                <h2 class="display-5 fw-bold">Tela de Produtos</h2>
                <a href="indexpro.php">
                    <button class="butao" type="button">Entrar</button>
                </a>
            </div>
        </div
    </div>
    <div class="container">
        <footer class="py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Início</a></li>
            <li class="nav-item"><a href="indexcli.php" class="nav-link px-2 text-body-secondary">Clientes</a></li>
            <li class="nav-item"><a href="indexfor.php" class="nav-link px-2 text-body-secondary">Fornecedores</a></li>
            <li class="nav-item"><a href="indexusu.php" class="nav-link px-2 text-body-secondary">Usuários</a></li>
          </ul>
          <p class="text-center text-body-secondary">&copy; 2024 Company, Inc</p>
        </footer>
    </div>
    <!-- link do js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const usernamePlaceholder = document.getElementById("nomeUsu");
        
        // Verifica se o usuário está logado
        const isLoggedIn = <?php echo isset($_SESSION["nome"]) ? "true" : "false"; ?>;
        
        if (isLoggedIn) {
            const username = "<?php echo isset($_SESSION["nome"]) ? $_SESSION["nome"] : ""; ?>";
            usernamePlaceholder.innerHTML = `Olá, `+username+`!`; // Exibe o nome de usuário
        } else {
            usernamePlaceholder.innerHTML = "";
            // alert('nada conectado'); // Deixa em branco se não estiver logado
        }
    });
    </script>
    
</body>
</html>