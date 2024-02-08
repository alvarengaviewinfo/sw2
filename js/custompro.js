/* Atribui ao evento submit do formulário a função de validação de dados*/
var form = document.getElementById("form-contato");
if (form != null && form.addEventListener) {
    form.addEventListener("submit", validaCadastro);
}
else if (form != null && form.attachEvent) {
    form.attachEvent("onsubmit", validaCadastro);
}

/* Atribui ao evento keypress do input celular a função para formatar do Valor (0.00) */
var inputValor = document.getElementById("valor");
if (inputValor != null && inputCelular.addEventListener) {
    inputValor.addEventListener("keypress", function () { mascaraTexto(this, '#.##') });
}
else if (inputValor != null && inputValor.attachEvent) {
    inputValor.attachEvent("onkeypress", function () { mascaraTexto(this, '#.##') });
}

/* Atribui ao evento click do link de exclusão na página de consulta a função confirmaExclusao */
var linkExclusao = document.querySelectorAll(".link_exclusao");
if (linkExclusao != null){
    for (var i = 0; i < linkExclusao.length; i++){
        (function(i){
            var id_usuario = linkExclusao[i].getAttribute("rel");
            if(linkExclusao[i].addEventListener){
                linkExclusao[i].addEventListener("click", function(){confirmaExclusao(id_produto);});
            }else if (linkExclusao[i].attachEvent){
                linkExclusao[i].attachEvent("onclick", function(){confirmaExclusao(id_produto);});
            }
        })(i);
    }
}

/* função para validar os dados antes da submissão dos dados */
function validaCadastro(evt) {
    var nome = document.getElementById("nome");
    var valor = document.getElementById("valor");
    var foto1 = document.getElementById("foto1");
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
    caixa_valor = document.querySelector(".msg-preco");
    if (valor.value == "") {
        caixa_valor.innerHTML = "Favor preencher o Preço de Venda";
        caixa_valor.style.display = 'block';
        contErro += 1;
    } else if (filtro.test(valor.value)) {
        caixa_valor.style.display = 'none';
    } else {
        caixa_valor.innerHTML = 'Formato do Preço Inválido';
        caixa_valor.style.display = 'block';
        contErro += 1;
    }

    /* Validação do campo cpf */
    caixa_foto = document.querySelector(".msg-foto");
    if (foto1.value == "") {
        caixa_foto.innerHTML = "Favor informar uma foto";
        caixa_foto.style.display = 'block';
        contErro += 1;
    } else {
        caixa_foto.style.display = 'none';
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
        formulario.action = "action_pro.php";
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