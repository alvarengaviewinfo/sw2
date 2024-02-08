<?php
    require 'bd/conexao.php';

    //Recebe o id do cliente do fornecedor via GET
    $id_fornecedor = (isset($_GET['id'])) ? $_GET['id'] : '';

    //Valida se existe um id e se ele é numérico
    if (!empty($id_fornecedor) && is_numeric($id_fornecedor)):

        //Captura os dados do fornecedor solicitado
        $conexao = conexao::getInstance();
        $sql = 'SELECT id, nome, email, cnpj, site, data_abertura, telefone, celular, status FROM fornecedor WHERE id = :id';
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':id', $id_fornecedor);
        $stm->execute();
        $fornecedor = $stm->fetch(PDO::FETCH_OBJ);

        if(!empty($fornecedor)):

            //Formata a data no formato nacional
            $array_data = explode('-', $fornecedor->data_abertura);
            $data_formatada = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
        endif;


    endif;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edição de Fornecedor</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>
        <div class='container'>
            <fieldset>
                <legend><h1>Formulário - Edição de Fornecedor</h1></legend>

                <?php if(empty($fornecedor)):?>
                    <h3 class="text-center text-danger">Fornecedor não encontrado!</h3>
                <?php else: ?>
                    <form action="action_fornecedor.php" method="post" id='form-contato' enctype='multipart/form-data'>
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?=$fornecedor->nome?>" placeholder="Informe o Nome">
                            <span class='msg-erro msg-nome'></span>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?=$fornecedor->email?>" placeholder="Informe o E-mail">
                            <span class="msg-erro msg-data"></span>
                        </div>

                        <div class="form-group">
                            <label for="email">Site</label>
                            <input type="text" class="form-control" id="site" name="site" value="<?=$fornecedor->site?>" placeholder="Informe o E-mail">
                            <span class="msg-erro msg-site"></span>
                        </div>

                        <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input type="cpf" class="form-control" id="cnpj" maxlength="14" name="cnpj" value="<?=$fornecedor->cnpj?>" placeholder="Informe o CNPJ">
                        <span class="msg-erro msg-cnpj"></span>
                    </div>

                    <div class="form-group">
                        <label for="data_abertura">Data de Abertura</label>
                        <input type="data_abertura" class="form-control" id="data_abertura" maxlength="10" name="data_abertura" value="<?=$data_formatada?>">
                        <span class="msg-erro msg-data_abertura"></span>
                    </div>

                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="telefone" class="form-control" id="telefone" maxlength="12" name="telefone" value="<?=$fornecedor->telefone?>" placeholder="Informe o Telefone">
                            <span class='msg-erro msg-telefone'></span>
                        </div>
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="celular" class="form-control" id="celular" maxlength="13" name="celular" value="<?=$fornecedor->celular?>" placeholder="Informe o Celular">
                            <span class='msg-erro msg-celular'></span>
                        </div>

                        <div class="form-group">
                        <label for="contato">Contato</label>
                        <input type="contato" class="form-control" id="contato" maxlength="50" name="contato" placeholder="Informe o Contato">
                        <span class="msg-erro msg-contato"></span>
                         </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="<?=$fornecedor->status?>"><?=$fornecedor->status?></option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                            <span class="msg-erro msg-status"></span>
                        </div>

                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?=$fornecedor->id?>">
                        <button type="submit" class="btn btn-primary" id="botao">
                            Gravar
                        </button>
                        <a href="index.php" class="btn btn-danger">Cancelar</a>
                    </form>
                    <?php endif; ?>
            </fieldset>
        </div>
        <script type="text/javascript" src="js/custom.js"></script>
    </body>
</html>