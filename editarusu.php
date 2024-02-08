<?php
    require 'bd/conexao.php';

    
    $id_usuario = (isset($_GET['id'])) ? $_GET['id'] : '';

    if (!empty($id_usuario) && is_numeric($id_usuario)):

   
        $conexao = conexao::getInstance();
        $sql = 'SELECT id, nome, email, senha, celular, status FROM usuario WHERE id = :id';
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
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="<?=$usuario->status?>"><?=$usuario->status?></option>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                    <span class="msg-erro msg-status"></span>
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
</body>
</html>