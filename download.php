<?php ob_start();?>
<?php
	require_once "conexao.php";
	$com = $_GET['com'];
	$for = $_GET['for'];
	$arquivo = mysql_fetch_array(mysql_query("SELECT * FROM compras WHERE idcompra = '$com'"))['arquivo_xml']; // Nome do Arquivo
    $local = 'fornecedores/'.$for."/"; // Pasta que cont�m os arquivos para download
    $local_arquivio = $local.$arquivo; // Concatena o diret�rio com o nome do arquivo
    if(stripos($arquivo, './') !== false || stripos($arquivo, '../') !== false || !file_exists($local_arquivio))
    {
        echo 'O comando n�o pode ser executado.';
    }
    else
    {
        header('Cache-control: private');
        header('Content-Type: text/xml');
        header('Content-Length: '.filesize($local_arquivio));
        header('Content-Disposition: filename='.$arquivo);
        header("Content-Disposition: attachment; filename=".basename($local_arquivio));
        
        // Envia o arquivo Download
        readfile($local_arquivio);
    }
?>