<?php
session_start();
if (!isset($_SESSION["nome"])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver autenticado
    exit();
}
?>

<?php
require 'bd/conexao.php';

// recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa esta vazio, se estivar executar uma consulta completa
if (empty($termo)):

    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, email, celular, status FROM fornecedor order by nome';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $fornecedores = $stm->fetchAll(PDO::FETCH_OBJ);

else:

    //Executa uma consulta baseada no termo de pesquisa passado como parametro
    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, email, celular, status FROM fornecedor WHERE nome LiKE :nome OR email LIKE :email';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':nome', $termo. '%');
    $stm->bindValue(':email', $termo. '%');
    $stm->execute();
    $fornecedores = $stm->fetchAll(PDO::FETCH_OBJ);

endif;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="icon" href="img/icons/fornecedor.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">    
    <title>Fornecedores</title>
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
                        <a class="nav-link" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexcli.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="indexfor.php">Fornecedores</a>
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
    <div class="container">
        <fieldset>
            <!-- CabeÃ§alho da Listagem -->
            <legend><h1>Listagem de Fornecedores</h1></legend>
            <!-- Formulario de Pesquisa -->
            <form action="" method="get" id="form-contato" class="">
                <label for="termo" class="col-md-2 control-label">Pesquisar</label>
                <div class="">
                    <input type="text" class="form-control" id="termo" name="termo" placeholder="informe o nome ou e-mail " style="border-color: #000000; width: 100%;">
                </div>
                <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                    <a href="indexfor.php" class="btn btn-primary">Ver Todos</a>
                </div>
                
            </form>
            <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
                <!-- Link para pagina de cadastro -->
                <a href="cadastrofor.php" class="btn btn-success pull-right">Cadastrar Fornecedor</a>
                <!-- link para imprimir -->
                <a href="imprimifor.php"><button class="btn btn-danger">Imprimir</button></a>
            </div>

            <div class="clearfix"></div>
            <?php if(!empty($fornecedores)):?>

            <!-- Tabela de Fornecedores -->
            <div id="conteudoParaImprimir">
                <table class="table table-striped">
                    <tr class="active">
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Celular</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                    <?php foreach($fornecedores as $fornecedor):?>
                        <tr>
                            <td><?=$fornecedor->nome?></td>
                            <td><?=$fornecedor->email?></td>
                            <td><?=$fornecedor->celular?></td>
                            <td><?=$fornecedor->status?></td>
                            <td>
                                <a href="editarfor.php?id=<?=$fornecedor->id?>" class="btn btn-primary">Editar</a>
                                <a href="javascript:void(0)" class="btn btn-danger link_exclusao" rel="<?=$fornecedor->id?>">Excluir</a>
                            </td>                    
                        </tr>
                    <?php endforeach;?>
    
                </table>
                <?php else: ?>
                    <!-- Mensagem caso nao exista clientes ou nao encontrado -->
                    <h3 class="text-center text-primary">Não existem fornecedores cadastrados!</h3>
                    <?php endif; ?>
            </div>
        </fieldset>

    </div>
    <div class="container">
        <footer class="py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="index.php" class="nav-link px-2 text-body-secondary">Início</a></li>
            <li class="nav-item"><a href="indexcli.php" class="nav-link px-2 text-body-secondary">Clientes</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Fornecedores</a></li>
            <li class="nav-item"><a href="indexusu.php" class="nav-link px-2 text-body-secondary">Usuários</a></li>
            <li class="nav-item"><a href="indexpro.php" class="nav-link px-2 text-body-secondary">Produtos</a></li>
          </ul>
          <p class="text-center text-body-secondary">&copy; 2024 Company, Inc</p>
        </footer>
    </div>
    <script type="text/javascript" src="js/customfor.js"></script>
    <!-- js do bootstrap na máquina -->
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