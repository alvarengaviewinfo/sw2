<?php 

require 'bd/conexao.php';

$conexao = conexao::getInstance();
$sql = 'SELECT id, nome, email, celular, status FROM fornecedor order by nome';
$stm = $conexao->prepare($sql);
$stm->execute();
$fornecedores = $stm->fetchAll(PDO::FETCH_OBJ);

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
                <td>'. $fornecedor->nome .'
                </td>
                <td>'.$fornecedor->email.'
                </td>
                <td>'. $fornecedor->celular .'
                </td>
                <td>'. $fornecedor->status .'
                </td>                
            </tr>';
         endforeach;
    $html.='</table>';

endif;
// carregar o Composer
require './vendor/autoload.php';


// referenciar o Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class

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