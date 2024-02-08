/* Atribui ao evento submit do formulário a função de validação de dados*/
var form = document.getElementById("form-contato");
if (form != null && form.addEventListener) {
    form.addEventListener("submit", validaCadastro);
}
else if (form != null && form.attachEvent) {
    form.attachEvent("onsubmit", validaCadastro);
}

/* Atribui ao evento keypress do input celular a função para formatar o Celular (00 00000-0000) */
var inputCelular = document.getElementById("celular");
if (inputCelular != null && inputCelular.addEventListener) {
    inputCelular.addEventListener("keypress", function () { mascaraTexto(this, '## #####-####') });
}
else if (inputCelular != null && inputCelular.attachEvent) {
    inputCelular.attachEvent("onkeypress", function () { mascaraTexto(this, '## #####-####') });
}

/* Atribui ao evento click do link de exclusão na página de consulta a função confirmaExclusao */
var linkExclusao = document.querySelectorAll(".link_exclusao");
if (linkExclusao != null){
    for (var i = 0; i < linkExclusao.length; i++){
        (function(i){
            var id_usuario = linkExclusao[i].getAttribute("rel");
            if(linkExclusao[i].addEventListener){
                linkExclusao[i].addEventListener("click", function(){confirmaExclusao(id_usuario);});
            }else if (linkExclusao[i].attachEvent){
                linkExclusao[i].attachEvent("onclick", function(){confirmaExclusao(id_usuario);});
            }
        })(i);
    }
}

/* função para validar os dados antes da submissão dos dados */
function validaCadastro(evt) {
    var nome = document.getElementById("nome");
    var email = document.getElementById("email");
    var senha = document.getElementById("senha");
    var status = document.getElementById("status");
    var celular = document.getElementById("celular");
    var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var contErro = 0;

    /* Validação do campo nome */
    caixa_nome = document.querySelector(".msg-nome");
    if (nome.value == "") {
        caixa_nome.innerHTML = "Favor preencher o Nome";
        caixa_nome.style.display = 'block';
        contErro += 1;
    } else {
        caixa_nome.style.display = 'none';
    }

    /* Validação do campo email */
    caixa_email = document.querySelector(".msg-email");
    if (email.value == "") {
        caixa_email.innerHTML = "Favor preencher o E-mail";
        caixa_email.style.display = 'block';
        contErro += 1;
    } else if (filtro.test(email.value)) {
        caixa_email.style.display = 'none';
    } else {
        caixa_email.innerHTML = 'Formato do E-mail inválido';
        caixa_email.style.display = 'block';
        contErro += 1;
    }

    /* Validação do campo cpf */
    caixa_senha = document.querySelector(".msg-senha");
    if (senha.value == "") {
        caixa_senha.innerHTML = "Favor preencher a Senha";
        caixa_senha.style.display = 'block';
        contErro += 1;
    } else {
        caixa_senha.style.display = 'none';
    }

    /* Validação do campo celular */
    caixa_celular = document.querySelector(".msg-celular");
    if (celular.value == "") {
        caixa_celular.innerHTML = "Favor preencher o Celular";
        caixa_celular.style.display = 'block';
        contErro += 1;
    } else {
        caixa_celular.style.display = 'none';
    }

    /* Validação do campo status */
    caixa_status = document.querySelector(".msg-status");
    if (status.value == "") {
        caixa_status.innerHTML = "Favor selecionar o Status";
        caixa_status.style.display = 'block';
        contErro += 1;
    } else {
        caixa_status.style.display = 'none';
    }
    if (contErro > 0) {
        evt.preventDefault();
    }
}

/* Função para formatar dados conforme parâmetro enviado, CNPJ, CPF, DATA, TELEFONE e CELULAR */
function mascaraTexto(t, mask) {
    var i = t.value.length;
    var saida = mask.substring(1, 0);
    var texto = mask.substring(i);

    if (texto.substring(0, 1) != saida) {
        t.value += texto.substring(0, 1);
    }
}

/* Função para exibir um alert confirmando a exclusão do registro */
function confirmaExclusao(id){
    retorno = confirm("Deseja excluir esse Registro?")

    if(retorno){

        // Cria um formulário
        var formulario = document.createElement("form");
        formulario.action = "action_usu.php";
        formulario.method = "post";

        // Cria os inputs e adiciona ao formulário
        var inputAcao = document.createElement("input");
        inputAcao.type = "hidden";
        inputAcao.value = "excluir";
        inputAcao.name = "acao";
        formulario.appendChild(inputAcao);
        
        var inputId = document.createElement("input");
        inputId.type = "hidden";
        inputId.value = id;
        inputId.name = "id";
        formulario.appendChild(inputId);

        // Adiciona o formulário ao corpo do documento
        document.body.appendChild(formulario);

        // Envia o formulário
        formulario.submit();
    }
}