<?php 
session_start();

require 'bd/conexao.php';

// recebe o termo de pesquisa se existir
$termo = $_SESSION['termo'];

// Verifica se o termo de pesquisa esta vazio, se estivar executar uma consulta completa
if (empty($termo)):

    $conexao = conexao::getInstance();
    $sql = 'SELECT PRO_ID, PRO_NOME, PRO_VALOR, PRO_FOTO1, PRO_FOTO2, PRO_FOTO3 FROM produtos order by PRO_NOME';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $produtos = $stm->fetchAll(PDO::FETCH_OBJ);

else:

    //Executa uma consulta baseada no termo de pesquisa passado como parametro
    $conexao = conexao::getInstance();
    $sql = 'SELECT PRO_ID, PRO_NOME, PRO_VALOR, PRO_FOTO1, PRO_FOTO2, PRO_FOTO3 FROM produtos WHERE PRO_NOME LiKE :PRO_NOME OR PRO_VALOR LIKE :PRO_VALOR';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':PRO_NOME', $termo. '%');
    $stm->bindValue(':PRO_VALOR', $termo. '%');
    $stm->execute();
    $produtos = $stm->fetchAll(PDO::FETCH_OBJ);
endif;


// iniciar o HTML
$html = '<h1> Listagem de Produto </h1>';

if (!empty($produtos)): 

    $html.='
    <table class="table table-striped">
        <tr class="active">
            <th>ID</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Foto 1</th>
        </tr>';
        foreach ($produtos as $produto): 
            $html.='<tr>
                <td style="width: 11rem;text-align: center;">'. $produto->PRO_ID .'
                </td>
                <td style="width: 11rem;text-align: center;">'. $produto->PRO_NOME .'
                </td>
                <td style="width: 11rem;text-align: center;">'.$produto->PRO_VALOR .'
                </td>
                <td style="width: 11rem;text-align: center;"><img src="http://localhost/sw2/'.$produto->PRO_FOTO1.'" width="60" height="60">                
                </td>                
                           
            </tr>';
         endforeach;
    $html.='</table>';

endif;
// carregar o Composer
require './vendor/autoload.php';


// referenciar o Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;
// instantiate and use the dompdf class

$options = new Options(); 
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);


// (Optional) Setup the paper size and orientation
// portrait or landscape
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('produtos.pdf', array('Attachment' => false));

?>