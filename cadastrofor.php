<!DOCTYPE html>
<html lang="en">
    <?php
    include("bd/conexao.php")
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--- link css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- css bootstrap máquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <div charset="utf-8" class="container">
        <fieldset>
            <legend><h1>Formulário - Cadastro de Fornecedor</h1></legend>
            <form action="action_for.php" method="post" id="form-contato" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o Nome">
                    <span class="msg-erro msg-nome" ></span>
                </div>
                <div class="form-group">
                    <label for="contato">Contato</label>
                    <input type="text" class="form-control" id="contato" name="contato" placeholder="Informe o Contato">
                    <span class="msg-erro msg-contato" ></span>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Informe o E-mail">
                    <span class="msg-erro msg-email"></span>
                </div>
                <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <input type="cnpj" class="form-control" id="cnpj" maxlength="18" name="cnpj" placeholder="Informe o CNPJ">
                    <span class="msg-erro msg-cnpj"></span>
                </div>
                <div class="form-group">
                    <label for="data_abertura">Data de Abertura</label>
                    <input type="data_abertura" class="form-control" id="data_abertura" maxlength="10" name="data_abertura">
                    <span class="msg-erro msg-data"></span>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="telefone" class="form-control" id="telefone" maxlength="12" name="telefone" placeholder="Informe o Telefone">
                    <span class="msg-erro msg-telefone"></span>
                </div>
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="celular" class="form-control" id="celular" maxlength="13" name="celular" placeholder="Informe o Celular">
                    <span class="msg-erro msg-celular"></span>
                </div>
                <div class="form-group">
                    <label for="site">Site</label>
                    <input type="site" class="form-control" id="site" name="site" placeholder="Informe o Site">
                    <span class="msg-erro msg-site"></span>
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="">Selecione o Status</option>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                    <span class="msg-erro msg-status"></span>
                    <input type="hidden" name="acao" value="incluir">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexfor.php" class="btn btn-danger pull-right">Voltar</a>
                </div>
            </form>
        </fieldset>
    </div>
    <script type="text/javascript" src="js/customfor.js"></script>

    <!---link do js bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>