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
$_SESSION["termo"] = $termo;
// Verifica se o termo de pesquisa esta vazio, se estivar executar uma consulta completa
if (empty($termo)):

    $conexao = conexao::getInstance();
    $sql = 'SELECT PRO_ID, PRO_NOME, PRO_VALOR, PRO_FOTO1, PRO_FOTO2, PRO_FOTO3 FROM produtos order by PRO_NOME';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $produtos = $stm->fetchAll(PDO::FETCH_OBJ);

else:

    //Executa uma consulta baseada no termo de pesquisa passado como parametro
    $conexao = conexao::getInstance();
    $sql = 'SELECT PRO_ID, PRO_NOME, PRO_VALOR, PRO_FOTO1 FROM produtos WHERE PRO_NOME LiKE :PRO_NOME OR PRO_VALOR LIKE :PRO_VALOR';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':PRO_NOME', $termo. '%');
    $stm->bindValue(':PRO_VALOR', $termo. '%');
    $stm->execute();
    $produtos = $stm->fetchAll(PDO::FETCH_OBJ);
    
endif;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/icons/livros.jpg"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">    
    <title>Produtos</title>
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
        .meiar{
            display: flex;
            justify-content: center;
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
                        <a class="nav-link"   href="indexcli.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexfor.php">Fornecedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexusu.php">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Produtos</a>
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
            <legend><h1>Listagem de Produtos</h1></legend>
            <!-- Formulario de Pesquisa -->
            <form action="" method="get" id="form-contato" class="">
                <label for="termo" class="col-md-2 control-label">Pesquisar</label>
                <div >
                    <input type="text" class="form-control" id="termo" name="termo" placeholder="informe o nome ou e-mail " style="border-color: #000000; width: 100%;">
                </div>
                <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                    <a href="indexpro.php" class="btn btn-primary">Ver Todos</a>
                </div>
            </form>
            <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
                <!-- Link para pagina de cadastro -->
                <a href="cadastropro.php" class="btn btn-success">Cadastrar Produtos</a>
                <!-- link para imprimir -->
                <a href="imprimipro.php"><button class="btn btn-danger">Imprimir</button></a>
            </div>
            <div class="clearfix"></div>
            <?php if(!empty($produtos)):?>

            <!-- Tabela de Clientes -->
            
                <table class="table table-striped" >
                    <tr class="active">
                        <th>Nome</th>
                        <th>valor</th>
                        <th >Imagem 1</th>
                        <th >Imagem 2</th>
                        <th >Imagem 3</th>
                        <th>Ação</th>
                    </tr>
                    
                    <?php foreach($produtos as $produto):?>
                        <tr>
                            <td><?=$produto->PRO_NOME?></td>
                            <td><?=$produto->PRO_VALOR?></td>
                            <td ><img src="<?=$produto->PRO_FOTO1?>" alt="Imagem 1" width='100' height='100'></td>
                            <?php if(!empty($produto->PRO_FOTO2)): ?>
                            <td ><img src="<?=$produto->PRO_FOTO2?>" alt="Imagem 2" width='100' height='100'></td>
                            <?php  else: ?>
                            <td > </td>
                            <?php endif ?>
                            <?php if(!empty($produto->PRO_FOTO3)): ?>
                            <td ><img src="<?=$produto->PRO_FOTO3?>" alt="Imagem 3" width='100' height='100'></td>
                            <?php  else: ?>
                            <td > </td>
                            <?php  endif ?>
                            <td>
                                <a href="editarpro.php?pro_id=<?=$produto->PRO_ID?>" class="btn btn-primary">Editar</a>
                                <a href="javascript:void(0)" class="btn btn-danger link_exclusao" rel="<?=$produto->PRO_ID?>">Excluir</a>
                            </td>                    
                        </tr>
                    <?php endforeach;?>
    
                </table>
                <?php else: ?>
                    <!-- Mensagem caso nao exista clientes ou nao encontrado -->
                    <h3 class="text-center text-primary">Não existem produtos cadastrados!</h3>
                    <?php endif; ?>
                    </div>
        </fieldset>

    </div>
    <div class="container">
        <footer class="py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="index.php" class="nav-link px-2 text-body-secondary">Início</a></li>
            <li class="nav-item"><a href="indexcli.php" class="nav-link px-2 text-body-secondary">Clientes</a></li>
            <li class="nav-item"><a href="indexfor.php" class="nav-link px-2 text-body-secondary">Fornecedores</a></li>
            <li class="nav-item"><a href="indexusu.php" class="nav-link px-2 text-body-secondary">Usuários</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Produtos</a></li>
          </ul>
          <p class="text-center text-body-secondary">&copy; 2024 Company, Inc</p>
        </footer>
    </div>
    <script type="text/javascript" src="js/custompro.js"></script>
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
    <script src="js/impressao.js"></script>
</body>
</html>