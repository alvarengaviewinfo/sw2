<?php 
session_start();

require 'bd/conexao.php';

// recebe o termo de pesquisa se existir
$termo = $_SESSION['termo'];

// Verifica se o termo de pesquisa esta vazio, se estivar executar uma consulta completa
if (empty($termo)):

    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, email, celular, status FROM cliente order by nome';
    $stm = $conexao->prepare($sql);
    $stm->execute();
    $clientes = $stm->fetchAll(PDO::FETCH_OBJ);

else:

    //Executa uma consulta baseada no termo de pesquisa passado como parametro
    $conexao = conexao::getInstance();
    $sql = 'SELECT id, nome, email, celular, status FROM cliente WHERE nome LiKE :nome OR email LIKE :email';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':nome', $termo. '%');
    $stm->bindValue(':email', $termo. '%');
    $stm->execute();
    $clientes = $stm->fetchAll(PDO::FETCH_OBJ);
endif;


// iniciar o HTML
$html = '<h1> Listagem de Cliente </h1>';

if (!empty($clientes)): 

    $html.='
    <table class="table table-striped">
        <tr class="active">
            <th>Nome</th>
            <th>E-mail</th>
            <th>Celular</th>
            <th>Status</th>
        </tr>';
        foreach ($clientes as $cliente): 
            $html.='<tr>
                <td style="width: 11rem;text-align: center;">'. $cliente->nome .'
                </td>
                <td style="width: 11rem;text-align: center;">'.$cliente->email.'
                </td>
                <td style="width: 11rem;text-align: center;">'. $cliente->celular .'
                </td>
                <td style="width: 11rem;text-align: center;">'. $cliente->status .'
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


// (Optional) Setup the paper size and orientation
// portrait or landscape
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

?>