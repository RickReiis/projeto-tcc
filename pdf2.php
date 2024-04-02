<?php ob_start();?>
<?php
	require_once("mpdf60/mpdf.php");
	require_once("conexao.php");
	require_once "enviar.php";
	$id = $_GET['id'];
	$sql = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE idcompra = '$id'");
	  while ($row1 = mysql_fetch_array($sql)) {
	    $arquivo = $row1['arquivo_xml'];
	    $data = $row1['data'];
	    $hora = $row1['hora'];
	    $fornecedor = $row1['razao_social'];
	    $id_f = $row1['idfornecedor'];
	  }
	  $sql2 = mysql_query("SELECT *, date_format(produtos.data, '%d/%m/%Y') AS data_e FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) WHERE compras.idcompra = '$id'") or die(mysql_error());
	  $sql3 = mysql_query("SELECT *, date_format(servicos.data_emissao, '%d/%m/%Y') AS data_e FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) WHERE compras.idcompra = '$id'");
	  if (mysql_num_rows($sql2)>=1) {
	    $titulo = "Produtos";
	    $most = "<table class='tab' style='border:1px solid #000;'><tbody><tr><th>Nome</th><th>Quantidade</th><th>Valor</th></tr>";
	    $num = mysql_num_rows($sql2);
	      while ($row2 = mysql_fetch_array($sql2)) {
	        $nota = $row2['nota_fiscal'];
	        $most .= "<tr><td>".$row2['nome']."</td><td>".$row2['quantidade']."</td><td>".$row2['valor']."</td></tr>";
	        $dat = $row2['data_e'];
	        $num--;
	      }
	    $most .= "</tbody></table>";
	    $pad = "";
	    $data_e = $dat;
	  }
	  elseif (mysql_num_rows($sql3)>=1) {
	    $titulo = "Serviço";
	    $row2 = mysql_fetch_array($sql3);
	    $nota = $row2['nota'];
	    $most = "<br><b>Descrição:</b> ".$row2['descriminacao']."<br><b>Valor:</b> ".$row2['valor']."<br><b>Alíquota:</b> ".$row2['aliquota']."<br><b>Valor Iss:</b> ".$row2['vlss']."<br><b>Valor Liquido:</b> ".$row2['vLiquido']."<br><b>Código de verificação:</b> ".$row2['cod_verificacao'];
	    $pad = "style='padding:0;'";
	    $data_e = $row2['data_e'];
	  }
	$html = "
	<style>
		table, td, th, tr{
			font-family: arial;
		}
		.tab td, th{
			border: 1px solid #000;
			border-collapse: collapse;
		}
	</style>
	 ";
	 $html .= "<h1 style='font-size:14pt;'>".$titulo."</h1>";
	 $html .= "<b>Fornecedor:</b>".$fornecedor."<br>";
	 $html .= "<b>Nota fiscal:</b>".$nota."<br>";
	 $html .= "<b>Data de Emissão:</b>".$data_e;
	 $html .= $most;
	 $html .= "<br><b>Data:</b>".$data."<b> Hora:</b>".$hora;
	$mpdf=new mPDF('utf-8','A4','','','15','15','25','18'); 
	$mpdf->SetHeader(' <h2>Centro Educacional Marista Irmão Acácio</h2> || <img style="width: 50px;" src="logo.png">');
	$dmy = date('d-m-Y');
	$mpdf->SetFooter($dmy.'||{PAGENO}/{nb}');
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->SetTitle('Relatorio da compra');
	// $css = file_get_contents("css/estilo.css");
	// $mpdf->WriteHTML($css,1);
	$arquivo = 'Sistema de Fornecedores';
	$mpdf->WriteHTML($html);
	$mpdf->Output($arquivo, 'I');

	exit;
?>