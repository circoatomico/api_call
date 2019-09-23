<?php

// $ASTDIR = "/var/spool/asterisk/outgoing";
$ASTDIR = "/var/www/html/api_call/";
$APITOKEN = "32e2224aaf20";
 
// Verifico se existem os parâmetros obrigatórios
if(!isset( $_GET['numero'] ) || !isset($_GET['token']) ){

    $msg = [
        'erro' => 'Parâmetros obrigatórios não encontrados'
    ];

    print_r($msg['erro']);

}else{

    $numero  = $_GET['numero'];
    $token   = $_GET['token'];
    $arquivo = $ASTDIR.'discagem.call';

    // Validação do Token
    if($token != $APITOKEN){
        $msg = ['erro' => 'token inválido'];
        print_r( 'Token Inválido' );
        exit();
    }
 
    if (file_exists($arquivo)) {
        criaArquivoDiscagem( $arquivo, $numero );
    }
}

function criaArquivoDiscagem( $arquivo, $numero ){
    
    $call = '
    PARAM1=teste
    PARAM2=teste
    NUMERO='.$numero.'
    ';

    echo $arquivo."<br>"; 
    $file = fopen($arquivo, 'w'); 
    fwrite( $file, $call ); 
    fclose( $file );
}

?>