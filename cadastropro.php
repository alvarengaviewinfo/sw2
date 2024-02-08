<!DOCTYPE html>
<html lang="en">
    <?php
    include("bd/conexao.php")
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
     <!--- link css bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- css bootstrap máquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <div charset="utf-8" class="container">
        <fieldset>
            <legend><h1>Formulário - Cadastro de Produtos</h1></legend>
            <form action="action_pro.php" method="post" id="form-contato" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o Nome">
                    <span class="msg-erro msg-nome" ></span>
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="valor" class="form-control" id="valor" name="valor" placeholder="Informe o Preço de Venda">
                    <span class="msg-erro msg-valor"></span>
                </div>
                <div class="form-group">
                    <label for="foto1">Foto 1</label>
                    <input type="file" class="form-control" id="foto1" maxlength="14" name="foto1">
                    <span class="msg-erro msg-foto"></span>
                </div>
                <div class="form-group">
                    <label for="foto2">Foto 2</label>
                    <input type="file" class="form-control" id="foto2" maxlength="13" name="foto2" >
                    <span class="msg-erro msg-foto"></span>
                </div>
                <div class="form-group">
                    <label for="foto3">Foto 3</label>
                    <input type="file" class="form-control" id="foto3" maxlength="13" name="foto3">
                    <span class="msg-erro msg-foto"></span>
                </div>
                <div class="form-group">
                    <input type="hidden" name="acao" value="incluir">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexpro.php" class="btn btn-danger pull-right">Voltar</a>
                </div>
            </form>
        </fieldset>
    </div>
    <script type="text/javascript" src="js/custompro.js"></script>

    <!---link do js bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>