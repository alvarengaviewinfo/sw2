<?php
require 'bd/conexao.php';

$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

if (empty($termo)):
    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, email, celular, status FROM usuario order by nome';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $usuarios = $stm->fetchAll(PDO::FETCH_OBJ);
else:
    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, email, celular, status FROM usuario WHERE nome LiKE :nome OR email LIKE :email';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':nome', $termo. '%');
    $stm->bindValue(':email', $termo. '%');
    $stm->execute();
    $usuarios = $stm->fetchAll(PDO::FETCH_OBJ);
endif;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
    <title>Document</title>
</head>
<body>
    <div class="container">
        <fieldset>
            <legend><h1>Listagem de Usuários</h1></legend>
        
            <form action="" method="get" id="form-contato" class="form-horizontal col-md-10">
                <label for="termo" class="col-md-2 control-label">Pesquisar</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="termo" name="termo" placeholder="informe o nome ou e-mail ">
                </div>
                <button type="submit" class="btn btn-primary">Pesquisar</button>
                <a href="indexusu.php" class="btn btn-primary">Ver Todos</a> <br>
               
            </form>
            <a href="cadastrousu.php" class="btn btn-success">Cadastrar Usuário</a>
            <div class="clearfix"></div>
            <?php if(!empty($usuarios)):?>

            <table class="table table-striped">
                <tr class="active">
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Celular</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
                <?php foreach($usuarios as $usuario):?>
                    <tr>
                        <td><?=$usuario->nome?></td>
                        <td><?=$usuario->email?></td>
                        <td><?=$usuario->celular?></td>
                        <td><?=$usuario->status?></td>
                        <td>
                            <a href="editarusu.php?id=<?=$usuario->id?>" class="btn btn-primary">Editar</a>
                            <a href="javascript:void(0)" class="btn btn-danger link_exclusao" rel="<?=$usuario->id?>">Excluir</a>
                        </td>                    
                    </tr>
                <?php endforeach;?>

            </table>
            <?php else: ?>
                
            <h3 class="text-center text-primary">Não existem usuários cadastrados!</h3>
            <?php endif; ?>
        </fieldset>
        <a href="index.php" class="btn btn-primary ">ir para cliente</a>
        <a href="indexfor.php" class="btn btn-primary ">ir para fornecedor</a>
    </div>
    <script type="text/javascript" src="js/customusu.js"></script>
</body>
</html>