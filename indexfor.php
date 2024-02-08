<?php
require 'bd/conexao.php';

//Recebe o termo de pesquisa se existir
$termo = (isset($_GET['termo'])) ? $_GET['termo'] : '';

//Verifica se o termo da pesquisa está vazio, se estiver executa uma consulta completa
if (empty($termo)):

    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, cnpj, email, site, telefone, celular, contato, data_abertura, status, data_cadastro, data_alteracao status FROM fornecedor order by nome';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $fornecedores = $stm->fetchAll(PDO::FETCH_OBJ);

else:

    //Executa uma consulta baseada no termo de pesquisa passado como parâmetro
    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, cnpj, email, site, telefone, celular, contato, data_abertura, status, data_cadastro, data_alteracao status FROM fornecedor WHERE nome LIKE :nome OR email LIKE :email';
    $stm =$conexão-> prepare($sql);
    $stm->bindValue(':nome',$termo.'%');
    $stm->bindValue(':email',$termo.'%');
    $stm->execute();
    $fornecedores = $stm->fetchAll(PDO::FETCH_OBJ);

endif;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listagem de Fornecedores</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>
        <div class="container">
            <fieldset>


                <!--Cabeçalho da Listagem-->
                <legend><h1>Listagem dos Fornecedores</h1></legend>

                <!--Formulário pesquisa-->
                <form action="" method="get" id="form-contato" class="form-horizontal col-md-10">
                <label for="termo" class="col-md-2 control-label">Pesquisar</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="termo" name="termo" placeholder="Informe o Nome ou E-mail">
                </div>
                <button type="submit" class="btn btn-primary">Pesquisar</button>
                <a href="index.php" class="btn btn-primary">Ver Todos</a>
                </form>

                <!--Link para página de cadatro-->
                <a href="cadastrofor.php" class="btn btn-success pull-right">Cadastrar Fornecedor</a>
                <div class="clearfix"></div>

                <?php if(!empty($fornecedores)):?>

                    <!--Tabela de Fornecedores-->
                    <table class="table table-striped">
                        <tr class='active'>
                            <th>Nome</th>
                            <th>Cnpj</th>
                            <th>E-mail</th>
                            <th>Site</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th>Contato</th>
                            <th>Data Abertura</th>
                            <th>Status</th>
                        </tr>
                        <?php foreach($fornecedor as $fornecedor):?>
                            <tr>
                                <td><?=$fornecedor->nome?></td>
                                <td><?=$fornecedor->cnpj?></td>
                                <td><?=$fornecedor->email?></td>
                                <td><?=$fornecedor->site?></td>
                                <td><?=$fornecedor->telefone?></td>
                                <td><?=$fornecedor->celular?></td>
                                <td><?=$fornecedor->contato?></td>
                                <td><?=$fornecedor->data_abertura?></td>
                                <td><?=$fornecedor->status?></td>
                                <td>
                                    <a href='editar.php?id=<?=$fornecedor->id?>' class="btn btn-primary">Editar</a>
                                    <a href='javascript:void(0)' class="btn btn-danger link_exclusao" rel="<?=$fornecedor->id?>">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </table>

            <?php else: ?>

                <!--Mensagem caso não exista clientes ou não encontrado-->
                <h3 class="text-center text-primary">Não existem fornecedores cadastrados!</h3>
                <?php endif;?>
            </fieldset>
        </div>
                <script type="text/javascript" src="js/custom.js"></script>
    </body>
</html>