<?php
/*$hostname = "localhost";
$bancodedados = "sw1ta";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno){
    echo "Falha ao conectar: (". $mysqli->connect_errno . ") " . $mysqli->connect_errno;
}
// else {
//     echo "conectou ao banco";
// };*/
class conexao{
    //Atributo estático de conexão
    private static $pdo;

    /*
    * Escondendo o construtor da classe
    */
    private function __construct() {

    }
    /*
    * Método privado para verificar se a extensão PDO do banco de dados escolhido
    * está habilitada
    */
    private static function verificaExtensao(){
        $extensao = 'pdo_mysql';
    }
    /*
    * Método estático para retornar uma conexão válida
    * Verifica se já existe uma instãncia da conexão, caso não, configura uma nova conexão
    */
    public static function getInstance(){
        $hostname = "localhost";
        $bancodedados = "sw1";
        $usuario = "root";
        $senha = "";

        self::verificaExtensao();
        if(!isset(self::$pdo)){
            try{
                $opcoes = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
                self::$pdo = new \PDO("mysql:host=" . $hostname . "; dbname=" . $bancodedados . ";", $usuario, $senha, $opcoes);
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                print "Erro: " . $e->getMessage();
            }
        }
        return self::$pdo;
    }
 
    public static function isConectado(){
        
        if(self::$pdo):
            return true;
        else:
            return false;
        endif;
    }
 
 }
?>