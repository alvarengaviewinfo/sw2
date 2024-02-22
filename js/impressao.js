function imprimirParteDaPagina() {
        var conteudo = document.getElementById('conteudoParaImprimir');
        var janelaImprimir = window.open('', '', 'width=800,height=600');
        janelaImprimir.document.open();
        janelaImprimir.document.write('<html><head><title>Impressão</title><link rel="stylesheet" href="css/bootstrap.min.css"><link rel="stylesheet" href="css/bootstrap.min.css.map"><style>fieldset{margin:1% auto;};table{margin-top:20px;};.box-mensagem-crud{margin-top: 10px;};.msg-erro{color: red;}</style></head><body>');
        janelaImprimir.document.write(conteudo.innerHTML);
        console.log(conteudo)
        janelaImprimir.document.write('</body></html>');
        janelaImprimir.document.close();
        janelaImprimir.print();
        janelaImprimir.close();
    }