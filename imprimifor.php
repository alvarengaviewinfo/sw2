<?php 
session_start();

require 'bd/conexao.php';

// recebe o termo de pesquisa se existir
$termo = $_SESSION['termo'];

// Verifica se o termo de pesquisa esta vazio, se estivar executar uma consulta completa
if (empty($termo)):

    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, email, celular, status FROM fornecedor order by nome';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $fornecedores = $stm->fetchAll(PDO::FETCH_OBJ);

else:

    //Executa uma consulta baseada no termo de pesquisa passado como parametro
    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, email, celular, status FROM fornecedor WHERE nome LiKE :nome OR email LIKE :email';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':nome', $termo. '%');
    $stm->bindValue(':email', $termo. '%');
    $stm->execute();
    $fornecedores = $stm->fetchAll(PDO::FETCH_OBJ);
endif;


// iniciar o HTML
$html = '<h1> Listagem de Fornecedor </h1>';

if (!empty($fornecedores)): 

    $html.='
    <table class="table table-striped">
        <tr class="active">
            <th>Nome</th>
            <th>E-mail</th>
            <th>Celular</th>
            <th>Status</th>
        </tr>';
        foreach ($fornecedores as $fornecedor): 
            $html.='<tr>
                <td style="width: 11rem;text-align: center;">'. $fornecedor->nome .'
                </td>
                <td style="width: 11rem;text-align: center;">'.$fornecedor->email.'
                </td>
                <td style="width: 11rem;text-align: center;">'. $fornecedor->celular .'
                </td>
                <td style="width: 11rem;text-align: center;">'. $fornecedor->status .'
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
$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);


$dompdf = new Dompdf();
$dompdf->loadHtml($html);


// (Optional) Setup the paper size and orientation
// portrait or landscape
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

?>