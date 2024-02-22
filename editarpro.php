<?php
    require 'bd/conexao.php';

    // Recebe o id do usuario via GET
    $id_produtos = (isset($_GET['pro_id'])) ? $_GET['pro_id'] : '';

    // Valida se existe um id e se ele é numérico
    if (!empty($id_produtos) && is_numeric($id_produtos)):

        // Captura os dados do cliente solicitado
        $conexao = conexao::getInstance();
        $sql = 'SELECT PRO_ID, PRO_NOME, PRO_VALOR, PRO_FOTO1, PRO_FOTO2, PRO_FOTO3 FROM produtos WHERE PRO_ID = :PRO_ID';
        $stm = $conexao -> prepare($sql);
        $stm -> bindValue(':PRO_ID', $id_produtos);
        $stm -> execute();
        $produtos = $stm->fetch(PDO::FETCH_OBJ);
    endif;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Produto</title>
    <!--- link css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- css bootstrap máquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="css/custom.css">
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
            text-align: center;
        }
        .jk{
            width: 9rem;
            height: 9rem;
            border-radius: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .hypeople{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items:center;
        }
    </style>
</head>
<body class="venho">
    <div class="container">
        <fieldset>
            <legend><h1>Formulário - Edição de Produto</h1></legend>
            <?php if(empty($produtos)):?>
                <h3 class="text-center text-danger">Produtos não encontrado!</h3>
            <?php else: ?>
                <form action="action_pro.php" method="post" id="form-contato" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?=$produtos->PRO_NOME?>" placeholder="Informe o Nome">
                    <span class="msg-erro msg-nome" ></span>
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="number" class="form-control" id="valor" name="valor" value="<?=$produtos->PRO_VALOR?>" placeholder="Informe o Valor">
                    <span class="msg-erro msg-email"></span>
                </div>
                <div class="form-group">
                    <label for="imagem1">Imagem 1</label>
                    <div class="hypeople">
                        <input type="file" class="form-control" id="imagem1" name="imagem1" value="" placeholder="Adicione a imagem">
                        <div id="eueu"class="eueu"><img src="  <?=$produtos->PRO_FOTO1?>  " alt="Imagem" class="jk"></div>
                    </div>
                    <span class="msg-erro msg-imagem1"></span>
                </div>
                <div class="form-group">
                    <label for="imagem2">Imagem 2</label>
                    <div class="hypeople">
                        <input type="file" class="form-control" id="imagem2" name="imagem2" value="<?=$produtos->PRO_FOTO2?>"  placeholder="Adicione a imagem">
                        <div id="eueu2"class="eueu">
                            <img src="  <?=$produtos->PRO_FOTO2?>  " alt="Imagem não existe ou não encontrada" class="jk">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="imagem3">Imagem 3</label>
                    <div class="hypeople">
                        <input type="file" class="form-control" id="imagem3" name="imagem3" value="<?=$produtos->PRO_FOTO3?>" placeholder="Adicione a imagem">
                        <div id="eueu3"class="eueu">
                            <img src="  <?=$produtos->PRO_FOTO3?>  " alt="Imagem não existe ou não encontrada" class="jk">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?=$produtos->PRO_ID?>">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexpro.php" class="btn btn-danger pull-right">Voltar</a>
                </div>
            </form>
                <?php endif; ?>
        </fieldset>

    </div>
    <script type="text/javascript" src="js/custompro.js"></script>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
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
</body>
</html>