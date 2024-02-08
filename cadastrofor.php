<!DOCTYPE html>
<html lang="en">
    <?php
    include ("bd/conexao.php")
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
<div class="container">
            <fieldset>
                <legend><h1>Formulário - Cadastro Fornecedores</h1></legend>
                <form action="action_cliente.php" method="post" id="form-contato" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome">
                        <span class="msg-erro msg-nome"></span>
                    </div>

                    <div class="form-group">
                        <label for="cnpj">Cnpj</label>
                        <input type="cnpj" class="form-control" id="cnpj" name="cnpj" placeholder="Informe o cnpj">
                        <span class="msg-erro msg-cnpj"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Informe o e-mail">
                        <span class="msg-erro msg-email"></span>
                    </div>

                    <div class="form-group">
                        <label for="site">Site</label>
                        <input type="site" class="form-control" id="site" name="site" placeholder="Informe o site">
                        <span class="msg-erro msg-site"></span>
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="telefone" class="form-control" id="telefone" maxlength="14" name="telefone" placeholder="Informe o telefone">
                        <span class="msg-erro msg-telefone"></span>
                    </div>

                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="celular" class="form-control" id="celular" maxlength="13" name="celular" placeholder="Informe o Celular">
                        <span class="msg-erro msg-celular"></span>
                    </div>

                    <div class="form-group">
                        <label for="contato">Contato</label>
                        <input type="contato" class="form-control" id="contato" maxlength="50" name="contato" placeholder="Informe o Contato">
                        <span class="msg-erro msg-contato"></span>
                    </div>

                    <div class="form-group">
                        <label for="data_abertura">Data Abertura</label>
                        <input type="data_abertura" class="form-control" id="data_abertura" maxlength="12" name="data_abertura" placeholder="Informe a data da abertura">
                        <span class="msg-erro msg-data"></span>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Selecione o status</option>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                        <span class="msg-erro msg-status"></span>
                    </div>

                    <input type="hidden" name="acao" value="incluir">
                    <button type="submit" class="btn btn-primary" id="botao">Gravar</button>
                </form>
            </fieldset>
        </div>
        <script type="text/javascript" src="js/custom.js"></script>


       <!-- CREATE TABLE fornecedor(
        id integer auto_increment primary key,
        nome varchar(100),
        cnpj varchar(20),
        email varchar(50),
        site varchar(50),
        telefone varchar(20),
        celular varchar(20),
        contato varchar(30),
        data_abertura date,
        status varchar(10),
        data_cadastro timestamp default CURRENT_TIMESTAMP,
        data_alteracao timestamp default CURRENT_TIMESTAMP

    default CURRENT_TIMESTAMP
    ); -->
</body>
</html>