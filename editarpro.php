<?php
require 'bd/conexao.php';

// Recebe o id do produto via GET
$id_produto = (isset($_GET['id'])) ? $_GET['id'] : '';

// Valida se existe um id e se ele é numérico
if (!empty($id_produto) && is_numeric($id_produto)):

    // Captura os dados do produto solicitado
    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, valor, foto1, foto2, foto3 FROM produto WHERE id = :id';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':id', $id_produto);

    try {
        $stm->execute();
        $produto = $stm->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo 'Erro ao buscar produto: ' . $e->getMessage();
        die();
    }
    if (!empty($produto)):
        
    endif;
endif;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Sw</title>
    <!--- link css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- css bootstrap máquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>

<body>
    <div class="container">
        <fieldset>
            <legend>
                <h1>Formulário - Edição de Produto</h1>
            </legend>
            <?php if (empty($produto)): ?>
                <h3 class="text-center text-danger">Produto não encontrado!</h3>
            <?php else: ?>
                <form action="action_pro.php" method="post" id="form-contato" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $produto->nome ?>"
                            placeholder="Informe o Nome">
                        <span class="msg-erro msg-nome"></span>
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input type="text" class="form-control" id="valor" name="valor" value="<?= $produto->valor ?>"
                            placeholder="Informe o Preço de Venda">
                        <span class="msg-erro msg-valor"></span>
                    </div>
                    <div class="form-group">
                        <label for="foto1">Foto 1</label>
                        <input type="file" class="form-control" id="foto1" name="foto1" value="<?= $produto->foto1 ?>">
                        <span class="msg-erro msg-foto"></span>
                    </div>
                    <div class="form-group">
                        <label for="foto2">Foto 2</label>
                        <input type="file" class="form-control" id="foto2" name="foto2" value="<?= $produto->foto2 ?>">
                        <span class="msg-erro msg-foto"></span>
                    </div>
                    <div class="form-group">
                        <label for="foto3">Foto 3</label>
                        <input type="file" class="form-control" id="foto3" name="foto3" value="<?= $produto->foto3 ?>">
                        <span class="msg-erro msg-foto"></span>
                    </div>
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?= $produto->id ?>">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexpro.php" class="btn btn-danger">Cancelar</a>
                </form>
            <?php endif; ?>
        </fieldset>
    </div>
    <script type="text/javascript" src="js/custompro.js"></script>
   
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
