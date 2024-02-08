<?php
require 'bd/conexao.php';

// recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

// Verifica se o termo de pesquisa esta vazio, se estivar executar uma consulta completa
if (empty($termo)):

    $conexao = conexao::getInstance();
    $sql = 'SELECT pro_id, pro_nome, pro_valor, pro_foto1, pro_foto2, pro_foto3 FROM produtos order by pro_nome';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $produtos = $stm->fetchAll(PDO::FETCH_OBJ);

else:

    //Executa uma consulta baseada no termo de pesquisa passado como parametro
    $conexao = conexao::getInstance();
    $sql = 'SELECT pro_id, pro_nome, pro_valor, pro_foto1, pro_foto2, pro_foto3 FROM produtos WHERE pro_nome LiKE :nome order by pro_nome';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':nome', $termo . '%');
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
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <title>Document</title>
</head>

<body>
    <?php include_once 'header.php';
    if (!$_SESSION["logado099"]) {
        header("location: index.php");
        exit;
    }
    ?>
    <div class="container">
        <fieldset>
            <!-- CabeÃ§alho da Listagem -->
            <legend>
                <h1>Listagem de Produtos</h1>
            </legend>
            <!-- Formulario de Pesquisa -->
            <form action="" method="get" id="form-contato" class="form-horizontal col-md-10">
                <label for="termo" class="col-md-2 control-label">Pesquisar</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="termo" name="termo"
                        placeholder="informe o nome do produto ">
                </div>
                <button type="submit" class="btn btn-primary">Pesquisar</button>
                <a href="indexpro.php" class="btn btn-primary">Ver Todos</a>
                <!-- Link para pagina de cadastro -->
                <a href="cadastropro.php" class="btn btn-success pull-right">Cadastrar Produtos</a>

            </form>

            <div class="clearfix"></div>
            <?php if (!empty($produtos)): ?>

            <!-- Tabela de Clientes -->
            <table class="table table-striped">
                <tr class="active">
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Foto1</th>
                    <th>Foto2</th>
                    <th>Foto3</th>
                    <th>Ação</th>
                </tr>
                <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td>
                        <?= $produto->pro_id ?>
                    </td>
                    <td>
                        <?= $produto->pro_nome ?>
                    </td>
                    <td>
                        <?= $produto->pro_valor ?>
                    </td>
                    <td>
                        
                        <img src="<?= $produto->pro_foto1 ?>" alt="Foto 1" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td>
                        
                        <img src="<?= $produto->pro_foto2 ?>" alt="Foto 2" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td>
                        
                        <img src="<?= $produto->pro_foto3 ?>" alt="Foto 3" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td>
                        <a href="editarpro.php?id=<?= $produto->pro_id ?>" class="btn btn-primary">Editar</a>
                        <a href="javascript:void(0)" class="btn btn-danger link_exclusao"
                            rel="<?= $produto->id ?>">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
            <?php else: ?>
            <!-- Mensagem caso nao exista usuários ou nao encontrado -->
            <h3 class="text-center text-primary">Não existem produtos cadastrados!</h3>
            <?php endif; ?>
        </fieldset>

    </div>

    <script type="text/javascript" src="js/custompro.js"></script>
</body>

</html>