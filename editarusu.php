<?php
    require 'bd/conexao.php';

    // Recebe o id do usuario via GET
    $id_usuario = (isset($_GET['id'])) ? $_GET['id'] : '';

    // Valida se existe um id e se ele é numérico
    if (!empty($id_usuario) && is_numeric($id_usuario)):

        // Captura os dados do cliente solicitado
        $conexao = conexao::getInstance();
        $sql = 'SELECT id, nome, email, senha, celular, acesso, status FROM usuario WHERE id = :id';
        $stm = $conexao -> prepare($sql);
        $stm -> bindValue(':id', $id_usuario);
        $stm -> execute();
        $usuario = $stm->fetch(PDO::FETCH_OBJ);
    endif;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Usuário</title>
    <!--- link css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- css bootstrap máquina -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
    <div class="container">
        <fieldset>
            <legend><h1>Formulário - Edição de Usuário</h1></legend>
            <?php if(empty($usuario)):?>
                <h3 class="text-center text-danger">Usuário não encontrado!</h3>
            <?php else: ?>
                <form action="action_usu.php" method="post" id="form-contato" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?=$usuario->nome?>" placeholder="Informe o Nome">
                    <span class="msg-erro msg-nome" ></span>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?=$usuario->email?>" placeholder="Informe o E-mail">
                    <span class="msg-erro msg-email"></span>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" maxlength="14" name="senha" value="<?=$usuario->senha?>" placeholder="Informe a Senha">
                    <span class="msg-erro msg-senha"></span>
                </div>
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="celular" class="form-control" id="celular" maxlength="13" name="celular" value="<?=$usuario->celular?>" placeholder="Informe o Celular">
                    <span class="msg-erro msg-celular"></span>
                </div>
                <div class="form-group">
                    <label for="acesso">Acesso</label>
                    <select class="form-control" name="acesso" id="acesso">
                        <option value="<?=$usuario->acesso?>"><?=$usuario->acesso?></option>
                        <option value="Adm">Administrador</option>
                        <option value="Usuário">Usuário</option>
                    </select>
                    <span class="msg-erro msg-acesso"></span>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="<?=$usuario->status?>"><?=$usuario->status?></option>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                        <span class="msg-erro msg-status"></span>
                    </div>
                    
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?=$usuario->id?>">
                    <button type="submit" class="btn btn-primary" id="botao">
                        Gravar
                    </button>
                    <a href="indexusu.php" class="btn btn-danger pull-right">Voltar</a>
                </div>
            </form>
                <?php endif; ?>
        </fieldset>

    </div>
    <script type="text/javascript" src="js/customusu.js"></script>
    <!-- js do bootstrap na máquina -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>