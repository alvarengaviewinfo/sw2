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
    <style>
        .eueu{
            width: 10rem;
            height: 10rem;
            border-radius: 2rem;
            border-color: #000000;
            border-style: solid;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .jk{
            width: 9rem;
            height: 9rem;
            border-radius: 2rem;
        }
        .hypeople{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items:center;
        }
    </style>
</head>
<body>
    <div charset="utf-8" class="container">
        <fieldset>
            <legend><h1>Formulário - Cadastro de Cliente</h1></legend>
            <form action="action_pro.php" method="post" id="form-contato" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o Nome">
                    <span class="msg-erro msg-nome" ></span>
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="number" class="form-control" id="valor" name="valor" placeholder="Informe o Valor">
                    <span class="msg-erro msg-valor" ></span>
                </div>
                <div class="form-group">
                    <label for="imagem1">Imagem 1</label>
                    <div class="hypeople">
                        <input type="file" class="form-control" id="imagem1" name="imagem1" placeholder="Adicione a imagem">
                        <div  id="eueu"class="eueu"></div>
                    </div>
                    <span class="msg-erro msg-imagem1"></span>
                </div>
                <div class="form-group">
                    <label for="imagem2">Imagem 2</label>
                    <div class="hypeople">
                        <input type="file" class="form-control" id="imagem2" name="imagem2" placeholder="Adicione a imagem">
                        <div  id="eueu2"class="eueu"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="imagem3">Imagem 3</label>
                    <div class="hypeople">
                        <input type="file" class="form-control" id="imagem3" name="imagem3" placeholder="Adicione a imagem">
                        <div  id="eueu3"class="eueu"></div>
                    </div>
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

    <!-- jquery -->
    <script
      src='https://code.jquery.com/jquery-3.2.1.slim.js'
      integrity='sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg='
      crossorigin='anonymous'
    ></script>
    <!-- Imagens aparecer -->
    <script>
        var imagem1 = document.getElementById('imagem1');
        function previewImage1() {
            var input = document.getElementById('imagem1');
            var preview = document.getElementById('eueu');
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Imagem" class="jk">';
            };

            reader.readAsDataURL(input.files[0]);
            } else {
                preview.innerHTML = '';
            }
        }

        imagem1.onchange = previewImage1

        var imagem2 = document.getElementById('imagem2');
        function previewImage2() {
            var input = document.getElementById('imagem2');
            var preview = document.getElementById('eueu2');
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Imagem" class="jk">';
            };

            reader.readAsDataURL(input.files[0]);
            } else {
                preview.innerHTML = '';
            }
        }

        imagem2.onchange = previewImage2

        var imagem3 = document.getElementById('imagem3');
        function previewImage3() {
            var input = document.getElementById('imagem3');
            var preview = document.getElementById('eueu3');
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Imagem" class="jk">';
            };

            reader.readAsDataURL(input.files[0]);
            } else {
                preview.innerHTML = '';
            }
        }

        imagem3.onchange = previewImage3
    </script>

    <!---link do js bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>