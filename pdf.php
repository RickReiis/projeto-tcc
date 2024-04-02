<?php ob_start();?>
<?php
	require_once("mpdf60/mpdf.php");
	require_once("conexao.php");
	require_once "enviar.php";
	$text = $_GET['tabela'];
	$des = $_GET['des'];
	if (count($text)>5) {
		if ($text[5] == 1) {
			$tabela = strip_tags(historico4($text[0], $text[1], $text[2], $text[3], $text[4]), '<tr><th><td>');
		}
		else{
			$tabela = strip_tags(historico2($text[0], $text[1], $text[2], $text[3], $text[4]), '<tr><th><td>');
		}
	}
	else {
		if ($text[4] == 1) {
			$tabela = strip_tags(historico3($text[0], $text[1], $text[2], $text[3]), '<tr><th><td>');
		}
		else{
			$tabela = strip_tags(historico1($text[0], $text[1], $text[2], $text[3]), '<tr><th><td>');	
		}
	}
	$html = "
	<style>
		table, td, th, tr{
			font-family: arial;
			margin: auto;
			padding: 4px;
			border-collapse: collapde;
		}
		.tab td, th{
			border: 1px solid #000;
			border-collapse: collapse;
		}
	</style>
	 ".$des;
	$html .= "<table class='tab'>".$tabela."</table>";
	$mpdf=new mPDF('utf-8','A4','','','15','15','25','18'); 
	$mpdf->SetHeader(' <h2>Centro Educacional Marista Irmão Acácio</h2> || <img style="width: 50px;" src="logo.png">');
	$dmy = date('d-m-Y');
	$mpdf->SetFooter($dmy.'||{PAGENO}/{nb}');
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->SetTitle('Relatorio de compras');
	 
	// $css = file_get_contents("css/estilo.css");
	// $mpdf->WriteHTML($css,1);
	$arquivo = 'Sistema de Fornecedores';
	$mpdf->WriteHTML($html);
	$mpdf->Output($arquivo, 'I');

	exit;
?>
