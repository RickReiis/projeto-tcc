<?php ob_start();?>
<?php 

require("conexao.php");
header("Content-type: text/html; charset=utf-8");
//se ouver um get 'acao' podera executar os scripts abaixo
if (isset($_GET['acao'])) {
    $acao = trim($_GET['acao']);
    //cadastrar usuario
    if ($acao == 'cadastrarusuario') {
        $nome = trim($_POST ['nome']);
        $email = trim($_POST['email']);
        $matricula = trim($_POST['matricula']);
        $senha = trim($_POST['senha']);
        //verifica se algum campo esta vazio
        if (empty($nome) || empty($email) || empty($matricula) || empty($senha)) {
            echo "<script>alert('Todos os campos são obrigatórios!');history.back();</script>";
        }
        else {
            //verifica se o email ja esta em uso
            $query = mysql_num_rows(mysql_query("SELECT * FROM usuarios WHERE email = '$email'"));
            if ($query>=1) {
                echo "<script>alert('O email já está sendo usado por outra pessoa!');history.back();</script>";
            }
            else {
                //cadastra o usuário
                $sql = mysql_query("INSERT INTO usuarios (nome, email, matricula, senha, status) VALUES ('$nome', '$email', '$matricula', '$senha', 0)");
                echo "<script>alert('Cadastro efetuado com sucesso!');</script>";
                header('Refresh:0 index.php');  
            }
        }
    }

    //fazer login

    if ($acao == 'logar') {
    //Start em uma sessão.
    session_start();
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    //criar variavel que recebe o retorno do select
    $sql = mysql_query("SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'");
    //verifica se o usuário existe
    if (mysql_num_rows($sql)>0) {
        $row = mysql_fetch_array($sql);
        //verifica se o usuário tem permissão pra logar
        if ($row['status'] != 0) {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            $_SESSION['status'] = $row['status'];
            $_SESSION['nome'] = $row['nome'];
            header('Refresh:0; fornecedores.php');
        }
        else {
            //apaga as sessões e retorna a pagina de login
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            unset($_SESSION['status']);
            unset($_SESSION['nome']);
            echo "<script>alert('Você ainda não tem permissão para fazer login!');history.back();</script>";
        }
    }
    else {
        //apaga as sessões e retorna a pagina de login
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        unset($_SESSION['status']);
        unset($_SESSION['nome']);
        echo "<script>alert('Email ou senha incorretos!');history.back();</script>";
        }
    }

    //fazer logout

    if ($acao == 'logout') {
        session_start();
        session_destroy();
        echo "Saindo...";
        header("Refresh:1; index.php");
        exit();
    }

    //editar perfil do usuário
    if ($acao == 'editar_nome') 
    {

        $idusuario = $_GET['id'];
        $nome = trim($_POST['nome']);
        mysql_query("UPDATE usuarios SET nome='$nome' WHERE idusuario='$idusuario'");
        $sql = mysql_query("SELECT * FROM usuarios WHERE idusuario = '$idusuario'");
        session_start();
        unset($_SESSION['nome']);
        while ($linha = mysql_fetch_object($sql))
         {
            $_SESSION['nome'] = $linha->nome;
         }
        header('Location: perfil.php');
    }

    if ($acao == 'editar_email') 
    {
        $idusuario = $_GET['id'];
        $email = trim($_POST['email']);
        $query = mysql_num_rows(mysql_query("SELECT * FROM usuarios WHERE email = '$email'"));
        if ($query>=1) 
        {
         echo "<script>alert('O email já está sendo usado por outra pessoa!');history.back();</script>";
        }

        else{
        mysql_query("UPDATE usuarios SET email='$email' WHERE idusuario='$idusuario'");
        $sql = mysql_query("SELECT * FROM usuarios WHERE idusuario = '$idusuario'");
        session_start();
        unset($_SESSION['email']);
        while ($linha = mysql_fetch_object($sql))
         {
            $_SESSION['email'] = $linha->email;
         }
        echo "<script>alert('E-mail alterado com sucesso!');history.back();</script>";
       }
    }

    if ($acao == 'editar_matricula') 
    {
        $idusuario = $_GET['id'];
        $matricula = trim($_POST['matricula']);
        mysql_query("UPDATE usuarios SET matricula='$matricula' WHERE idusuario='$idusuario'");
        $sql = mysql_query("SELECT * FROM usuarios WHERE idusuario = '$idusuario'");
        session_start();
        unset($_SESSION['matricula']);
        while ($linha = mysql_fetch_object($sql))
         {
            $_SESSION['matricula'] = $linha->matricula;
         }
        header('Location: perfil.php');
    }

    if ($acao == 'editar_senha') 
    {
        $idusuario = $_GET['id'];
        $senha = trim($_POST['senha_atual']);
        $nova_senha = trim($_POST['nova_senha']);
        $pesquisaSenha = mysql_query("SELECT * FROM usuarios WHERE idusuario='$idusuario'");
        while ($row = mysql_fetch_object($pesquisaSenha)) {
            $senha_atual = $row->senha;
        }
        
        if ($senha == $senha_atual) {
        mysql_query("UPDATE usuarios SET senha='$nova_senha' WHERE idusuario='$idusuario'");
        $sql = mysql_query("SELECT * FROM usuarios WHERE idusuario = '$idusuario'");
        session_start();
        unset($_SESSION['senha']);
        while ($linha = mysql_fetch_object($sql))
         {
            $_SESSION['senha'] = $linha->senha;
         }
        echo "<script>alert('Sua senha foi alterada com sucesso !');history.back();</script>";
        }

        else{
        echo "<script>alert('Sua senha está incorreta !');history.back();</script>";
        }
    }

    //-----------------------

    //cadastrar fornecedor

    if ($acao == 'cadastrarfornecedor') {
       fornecedor(0);
    }

    //mudar permição do usuário
    if ($acao == 'permissao') {
        $id = $_GET['id'];
        $pesquisaStatus = mysql_query("SELECT * FROM usuarios WHERE idusuario='$id'");
        while ($row = mysql_fetch_array($pesquisaStatus)) {
            $statusUsuario = $row['status'];
        }
        if ($statusUsuario == 0) {
            mysql_query("UPDATE usuarios SET status='1' WHERE idusuario='$id'");
            header('Refresh:0 usuarios.php');
        }

        elseif ($statusUsuario == 1) {
            mysql_query("UPDATE usuarios SET status='0' WHERE idusuario='$id'");
            header('Refresh:0 usuarios.php');
        }
    }

    //editar fornecedor

    if ($acao == 'editarfornecedor') {
        fornecedor(1);
    }

    //editar status do fornecedor

    if ($acao == 'statusF') {
        $id = $_GET['id'];
        $row = mysql_fetch_array(mysql_query("SELECT * FROM fornecedores WHERE idfornecedor = '$id'"));
        $sta = $row['status'];
        if ($sta == 0) {
            $sql = mysql_query("UPDATE fornecedores SET status = 1 WHERE idfornecedor = '$id'");
        }
        elseif ($sta == 1) {
            $sql = mysql_query("UPDATE fornecedores SET status = 0 WHERE idfornecedor = '$id'");
        }
        header('Location: fornecedores.php');
    }

    // registrar compra

    if ($acao == "regcompra") {
        //verifica se 
        if ($fornecedor = $_POST['fornecedor'] && $arquivo = $_FILES['arquivo']){
            $idfornecedor = $_POST['fornecedor'];
            $name = $arquivo['name'];
            $tmp = $arquivo['tmp_name']; 
            $extensao = strtolower(@end(explode('.', $name)));
            $novoNome = rand().".$extensao"; 
            if ( $extensao == "xml" && move_uploaded_file($tmp, 'fornecedores/'.$idfornecedor.'/'.$novoNome)){   
                $xml = simplexml_load_file("fornecedores/".$idfornecedor."/".$novoNome);
                mysql_query("INSERT INTO compras(arquivo_xml, data, hora, idfornecedor) VALUES('$novoNome', NOW(), NOW(), '$idfornecedor')");
                $idcompra = mysql_insert_id(); // pega o id da compra
                if (isset($xml->Nfse)) {
                    $nota = $xml->Nfse->IdentificacaoNfse->Numero;
                    $cod_verificacao = $xml->Nfse->IdentificacaoNfse->CodigoVerificacao;
                    $descriminacao = $xml->Nfse->DadosNfse->Discriminacao;
                    $data_emissao = $xml->Nfse->IdentificacaoNfse->DataEmissao;
                    $valor = $xml->Nfse->DadosNfse->ValorServicos;
                    $aliquota = $xml->Nfse->DadosNfse->Aliquota;
                    $vIss = $xml->Nfse->DadosNfse->ValorIss;
                    $vLiquido = $xml->Nfse->DadosNfse->ValorLiquidoNfse;
                    $data_emissao = explode("T", $data_emissao);
                    $sql = "INSERT INTO servicos(nota, cod_verificacao, descriminacao, data_emissao, valor, aliquota, vlss, vLiquido, idfornecedor, idcompra) VALUES('$nota', '$cod_verificacao', '$descriminacao', '$data_emissao[0]', '$valor', '$aliquota', '$vIss', '$vLiquido', '$idfornecedor', '$idcompra')";
                    if (mysql_query($sql) or die(mysql_error())) {
                        header('Location: historico_compras.php');
                    }
                    else {
                        echo "Erro";
                        unlink("fornecedores/".$idfornecedor."/".$novoNome);
                    }
                }
                else {
                    $nome = null;
                    $valor = null;
                    $quant = null;
                    $um = null;
                    foreach($xml->NFe->infNFe->det as $atributos){
                        $nome .=  $atributos->prod->xProd."+";

                        $valor .= $atributos->prod->vProd."+";

                        $quant .= $atributos->prod->qCom;

                        $quant .= $atributos->prod->uCom."+";

                    }
                    foreach($xml->NFe->infNFe->ide as $numero){
                        $nota = $numero->nNF;
                        $data = $numero->dhEmi;     
                    }
                    $data = explode("T", $data);
                    $quant = explode("+", $quant);
                    $um = explode("+", $um);
                    $nome = explode("+", $nome);
                    $valor = explode("+", $valor);
                    $cnome = count($nome);
                    for ($cont=0; $cont < $cnome-1; $cont++){
                    mysql_query("INSERT INTO produtos(nome, nota_fiscal, quantidade, valor, data, idfornecedor, idcompra) VALUES('$nome[$cont]', '$nota', '$quant[$cont]', '$valor[$cont]', '$data[0]', '$idfornecedor', '$idcompra')");
                    }
                    echo "<script>history.back();</script>";
                }
            }
            else{
                echo "<script>alert('O arquivo não é XML!'); history.back();</script>";
            }
        }
        else{
            echo "<script>alert('Preencha todos os campos!'); history.back();</script>";
        } 
    }

    //registra compra sem nota
    if ($acao == "regcompra2") {
        $for = $_POST['fornecedor'];
        $data = $_POST['data_emissao'];
        $nota = $_POST['nota'];
        $nome = $_POST['nome'];
        $quant = $_POST['quantidade'];
        $valor = $_POST['valor'];
        $ar = count($nome);
        mysql_query("INSERT INTO compras(data, hora, idfornecedor) VALUES(NOW(), NOW(), '$for')");
        $idcompra = mysql_insert_id();
        for ($i=0; $i <= $ar-1 ; $i++) {
        mysql_query("INSERT INTO produtos(nome, nota_fiscal, quantidade, valor, data, idfornecedor, idcompra) VALUES('$nome[$i]', '$nota', '$quant[$i]', '$valor[$i]', '$data', '$for', '$idcompra')") or die(mysql_error());
        header('Location: historico_compras.php');
        }
    }

    //registrar compra sem nota pt 2
    if ($acao == "regcompra3") {
        $for = $_POST['fornecedor'];
        $data = $_POST['data_emissao'];
        $cod_verificacao = $_POST['cod_ver'];
        $nota = $_POST['nota'];
        $descriminacao = $_POST['desc'];
        $valor = $_POST['v'];
        $aliquota = $_POST['al'];
        $vIss = $_POST['vi'];
        $vLiquido = $_POST['vl'];
        mysql_query("INSERT INTO compras(data, hora, idfornecedor) VALUES(NOW(), NOW(), '$for')");
        $idcompra = mysql_insert_id();
        mysql_query("INSERT INTO servicos(nota, cod_verificacao, descriminacao, data_emissao, valor, aliquota, vlss, vLiquido, idfornecedor, idcompra) VALUES('$nota', '$cod_verificacao', '$descriminacao', '$data', '$valor', '$aliquota', '$vIss', '$vLiquido', '$for', '$idcompra')");
        header('Location: historico_compras.php');
    }

    //editar compra
    if ($acao == "atcompra") {
        if ($arquivo = $_FILES['arquivo']){
            $idfornecedor = $_POST['fornecedor'];
            $idcompra = $_POST['compra'];
            $name = $arquivo['name'];
            $tmp = $arquivo['tmp_name']; 
            $extensao = strtolower(@end(explode('.', $name)));
            $novoNome = rand().".$extensao";
            if ( $extensao == "xml" && move_uploaded_file($tmp, 'fornecedores/'.$idfornecedor.'/'.$novoNome)){   
                $xml = simplexml_load_file("fornecedores/".$idfornecedor."/".$novoNome);
                $bla = mysql_fetch_array(mysql_query("SELECT arquivo_xml FROM compras WHERE idcompra = '$idcompra'"));
                $arq = $bla['arquivo_xml'];
                unlink("fornecedores/".$idfornecedor."/".$arq);
                mysql_query("UPDATE compras SET arquivo_xml = '$novoNome', data = NOW(), hora = NOW() WHERE idcompra = '$idcompra'");
                if (isset($xml->Nfse)) {
                    $nota = $xml->Nfse->IdentificacaoNfse->Numero;
                    $cod_verificacao = $xml->Nfse->IdentificacaoNfse->CodigoVerificacao;
                    $descriminacao = $xml->Nfse->DadosNfse->Discriminacao;
                    $data_emissao = $xml->Nfse->IdentificacaoNfse->DataEmissao;
                    $valor = $xml->Nfse->DadosNfse->ValorServicos;
                    $aliquota = $xml->Nfse->DadosNfse->Aliquota;
                    $vIss = $xml->Nfse->DadosNfse->ValorIss;
                    $vLiquido = $xml->Nfse->DadosNfse->ValorLiquidoNfse;
                    $data_emissao = explode("T", $data_emissao);
                    $sql2 = mysql_query("SELECT *, date_format(produtos.data, '%d/%m/%Y') AS data_e FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) WHERE compras.idcompra = '$idcompra'") or die(mysql_error());
                    $sql3 = mysql_query("SELECT *, date_format(servicos.data_emissao, '%d/%m/%Y') AS data_e FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) WHERE compras.idcompra = '$idcompra'");
                    if (mysql_num_rows($sql2)>=1) {
                        mysql_query("DELETE FROM produtos WHERE idcompra = '$idcompra'");
                    }
                    elseif (mysql_num_rows($sql3)>=1) {
                        mysql_query("DELETE FROM servicos WHERE idcompra = '$idcompra'");
                    }
                    $sql = "INSERT INTO servicos(nota, cod_verificacao, descriminacao, data_emissao, valor, aliquota, vlss, vLiquido, idfornecedor, idcompra) VALUES('$nota', '$cod_verificacao', '$descriminacao', '$data_emissao[0]', '$valor', '$aliquota', '$vIss', '$vLiquido', '$idfornecedor', '$idcompra')";
                    if (mysql_query($sql) or die(mysql_error())) {
                        header('Location: especificacoes_compra.php?id='.$idcompra);
                    }
                    else {
                        echo "Erro";
                        unlink("fornecedores/".$idfornecedor."/".$novoNome);
                    }
                }
                else {
                    $nome = null;
                    $valor = null;
                    $quant = null;
                    $um = null;
                    foreach($xml->NFe->infNFe->det as $atributos){
                        $nome .=  $atributos->prod->xProd."+";

                        $valor .= $atributos->prod->vProd."+";

                        $quant .= $atributos->prod->qCom;

                        $quant .= $atributos->prod->uCom."+";

                    }
                    foreach($xml->NFe->infNFe->ide as $numero){
                        $nota = $numero->nNF;
                        $data = $numero->dhEmi;     
                    }
                    $data = explode("T", $data);
                    $quant = explode("+", $quant);
                    $um = explode("+", $um);
                    $nome = explode("+", $nome);
                    $valor = explode("+", $valor);
                    $cnome = count($nome);
                    $sql2 = mysql_query("SELECT *, date_format(produtos.data, '%d/%m/%Y') AS data_e FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) WHERE compras.idcompra = '$idcompra'") or die(mysql_error());
                    $sql3 = mysql_query("SELECT *, date_format(servicos.data_emissao, '%d/%m/%Y') AS data_e FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) WHERE compras.idcompra = '$idcompra'");
                    if (mysql_num_rows($sql2)>=1) {
                        mysql_query("DELETE FROM produtos WHERE idcompra = '$idcompra'");
                    }
                    elseif (mysql_num_rows($sql3)>=1) {
                        mysql_query("DELETE FROM servicos WHERE idcompra = '$idcompra'");
                    }
                    for ($cont=0; $cont < $cnome-1; $cont++){
                    mysql_query("INSERT INTO produtos(nome, nota_fiscal, quantidade, valor, data, idfornecedor, idcompra) VALUES('$nome[$cont]', '$nota', '$quant[$cont]', '$valor[$cont]', '$data[0]', '$idfornecedor', '$idcompra')");
                    }
                    header('Location: especificacoes_compra.php?id='.$idcompra);
                }
            }
            else{
                echo "<b>$name :</b> Desculpe! Ocorreu um erro...";
            }
        }
        else{
            echo "<script>alert('Preencha todos os campos!'); window.location.href = 'historico_compras.php';</script>";
        }
    }
    //excluir compra
    if ($acao == "excluir_compra") {
        $id = $_GET['idc'];
        $for = $_GET['for'];
        $bla = mysql_fetch_array(mysql_query("SELECT * FROM compras WHERE idcompra = '$id'"));
        $aq = $bla['arquivo_xml'];
        if ($aq == null) {
            //se o arquivo for igual a null não faz nada
        }
        else {
            unlink('fornecedores/'.$for.'/'.$aq);
        }
        $sql2 = mysql_query("SELECT * FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) WHERE compras.idcompra = '$id'");
        $sql3 = mysql_query("SELECT * FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) WHERE compras.idcompra = '$id'");
        if (mysql_num_rows($sql2)>=1) {
            mysql_query("DELETE FROM produtos WHERE idcompra = '$id'");
        }
        elseif (mysql_num_rows($sql3)>=1) {
            mysql_query("DELETE FROM servicos WHERE idcompra = '$id'");
        }
        mysql_query("DELETE FROM compras WHERE idcompra = '$id'");
        header('Location: historico_compras.php');
    }

    //cadastrar tipo de fornecedor
    if ($acao == 'cadastrar_tipofornecedor') {
        $tipo_fornecedor = $_POST['tipo_fornecedor'];

        $query = mysql_num_rows(mysql_query("SELECT * FROM tipo_fornecedor WHERE tipo = '$tipo_fornecedor'"));
        if ($query>=1) {
                echo "<script>alert('Tipo de fornecedor já cadastrado!!');history.back();</script>";
        }
        else{
        $sql = mysql_query("INSERT INTO tipo_fornecedor (tipo) VALUES ('$tipo_fornecedor')");
        if ($sql) {
            echo "<script>history.back();</script>";
        }

        else{
            echo("<script>alert('Falha ao cadastrar!')</script>");
        }
      }
    }

    if ($acao == 'editar_tipofornecedor') {
        $id = $_GET['id'];
        $tipo = $_POST['tipo_fornecedor'];

        $sql = mysql_query("UPDATE tipo_fornecedor SET tipo='$tipo' WHERE idtipo_fornecedor='$id'");
        if ($sql) {
            header('location: tipo_fornecedor.php');
        }
        else{
            header('location: tipo_fornecedor.php');
        }
    }
}

//funçao de cadastrar e de editar forncedor

function fornecedor($ac){
    #pega os dados bancarios
    $banco = trim($_POST ['banco']);
    $agencia = trim($_POST['agencia']);
    $conta_corrente = trim($_POST['conta_corrente']);
    # Recebendo os dados do endereço
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $numero = trim($_POST['numero']);
    $estado = trim($_POST['estado']);
    $cep = trim($_POST['cep']);
    # Tratando os dados
    $rua1 = explode(" ", $rua);
    $numr = count($rua);
    $bairro1 = explode(" ", $bairro);
    $numb = count($bairro);
    $cidade1 = explode(" ", $cidade);
    $numc = count($cidade);
    for ($cont=0; $cont < $numr-1; $cont++) 
    { 
        $rua1[$cont] = $rua1[$cont]."+";
    }
    for ($cont=0; $cont < $numb-1 ; $cont++) 
    { 
        $bairro1[$cont] = $bairro1[$cont]."+";
    }
    for ($cont=0; $cont < $numc-1 ; $cont++) 
    { 
        $cidade1[$cont] = $cidade1[$cont]."+";
    }

    $link = "https://maps.googleapis.com/maps/api/geocode/xml?address=";

    for ($cont=0; $cont < $numr; $cont++) 
    { 
        $link .= $rua1[$cont];
    }
    $link .= ",+".$numero."+-+";
    for ($cont=0; $cont < $numb ; $cont++) 
    { 
         $link .= $bairro1[$cont];
    }
    $link .= ",+";
    for ($cont=0; $cont < $numc ; $cont++) 
    { 
         $link .= $cidade1[$cont];
    }
    $link .= "+-+".$estado.",+".$cep."&key=AIzaSyDMdHGZ5XyEuW7d6xXt7Vg1GrcqJAP7JXY";
    # Obtendo as coordenadas
    $url = simplexml_load_file($link);
    $latitude = $url->result->geometry->location->lat;
    $longitude = $url->result->geometry->location->lng;
    #obtendo a distância e a duraçao
    $link2 = "https://maps.googleapis.com/maps/api/distancematrix/xml?origins=-23.261251,-51.143284&destinations=".$latitude.",".$longitude."&mode=driving&language=pt-BR&key=AIzaSyDMdHGZ5XyEuW7d6xXt7Vg1GrcqJAP7JXY";
    $url = simplexml_load_file($link2);
    $distancia = $url->row->element->distance->text;
    $duracao = $url->row->element->duration->text;
    $mensagem = "A distância é de ".$distancia." e  deve levar ".$duracao.".";
    #pegando os dados do fornecedor
    $razao_social = trim($_POST['razao_social']);
    $tipo_empresa = trim($_POST['tipo_empresa']);
    $regime_tributacao = trim($_POST ['regime_tributacao']);
    $inscricao_municipal = trim($_POST['inscricao_municipal']);
    $inscricao_estadual = trim($_POST['inscricao_estadual']);
    $cnpj = trim($_POST['cnpj']);
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    $pessoa_contato = trim($_POST['pessoa_contato']);
    $avaliacao = $_POST['avaliacao'];
    $descricao = $_POST['descricao'];
    $palavra_chave = $_POST['palavra'];
    $site = $_POST['site'];
    if ($ac == 0) {
        //cadastra fornecedor
        //insere no banco        
        $dados_banco = mysql_query("INSERT INTO dados_bancarios (banco, agencia, conta_corrente) VALUES ('$banco', '$agencia', '$conta_corrente')");
        $chave1 = mysql_insert_id();
        //salvando no banco de dados
        mysql_query("INSERT INTO enderecos(rua, numero, bairro, cidade, cep, estado, lat, lon, distancia) VALUES('$rua', '$numero', '$bairro', 
            '$cidade', '$cep', '$estado', '$latitude', '$longitude', '$mensagem')");
        //pegando o id para passar como chave estrangeira
        $chave2 = mysql_insert_id();
        //insere no banco 
        $dados_fornecedor = mysql_query("INSERT INTO fornecedores (razao_social, idtipo_fornecedor, regime_tributacao, inscricao_municipal, inscricao_estadual, cnpj, telefone, email, pessoa_contato, iddados_bancarios, idendereco, descricao, status, idavaliacao, palavra_chave, site) VALUES ('$razao_social', '$tipo_empresa', '$regime_tributacao', '$inscricao_municipal', '$inscricao_estadual', '$cnpj', '$telefone', '$email', '$pessoa_contato', '$chave1', '$chave2', '$descricao', 1, '$avaliacao', '$palavra_chave', '$site')") or die(mysql_error());
        $chave3 = mysql_insert_id();
        if ($dados_fornecedor) {
            mkdir("fornecedores/$chave3");
            header('Location: fornecedores.php');
        }
        else {
            mysql_query("DELETE FROM dados_bancarios WHERE iddados_bancarios = '$chave1'");
        }
    }
    elseif ($ac == 1) {
        //edita fornecedor
        $idfornecedor = $_GET['id'];
        $pesquisafornecedor = mysql_query("SELECT * FROM fornecedores WHERE idfornecedor = '$idfornecedor'");
        //pegando o id dos dados bancarios e do indereco
        while ($row = mysql_fetch_array($pesquisafornecedor)) 
        {
            $idbanco = $row['iddados_bancarios'];
            $idendereco = $row['idendereco'];
        } 
        $dados_banco = mysql_query("UPDATE dados_bancarios SET banco='$banco', agencia='$agencia', conta_corrente='$conta_corrente' WHERE iddados_bancarios='$idbanco'");
        //salvando no banco de dados
        mysql_query("UPDATE  enderecos SET rua='$rua', numero='$numero', bairro='$bairro', cidade='$cidade', cep='$cep', lat='$latitude', lon='$longitude', distancia='$mensagem' WHERE idendereco = '$idendereco'");
        //pegando o id para passar como chave estrangeira
        $pesquisa2 = mysql_query("SELECT * FROM enderecos");
        while ($row = mysql_fetch_object($pesquisa2))
        {
            $chave2 = $row->idendereco;
        }
        //insere no banco 
        $dados_fornecedor = mysql_query("UPDATE fornecedores SET razao_social='$razao_social', idtipo_fornecedor='$tipo_empresa', regime_tributacao='$regime_tributacao', inscricao_municipal='$inscricao_municipal', inscricao_estadual='$inscricao_estadual', cnpj='$cnpj', telefone='$telefone', email='$email', pessoa_contato='$pessoa_contato', descricao = '$descricao', idavaliacao = '$avaliacao', palavra_chave = '$palavra_chave',  site=
        	'$site' WHERE idfornecedor='$idfornecedor'") or die(mysql_error());

        header('Location: fornecedores.php');
    }
}

//função de pesquisar histórico de compras quando houver o campo de pesquisa por produto ou serviço

function historico1($his, $di, $df, $f){
    $html1 = null;
    if ($f == 0) {
        if ($his == 0) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor)  ORDER BY(compras.data) DESC");
        }
        elseif ($his == 1) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE compras.data <= '$df' ORDER BY(compras.data) DESC");
        }
        elseif ($his == 2) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE compras.data = '$di'");
        }
        elseif ($his == 3) {
           $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE compras.data >= '$di' AND compras.data <= '$df'  ORDER BY(compras.data) DESC");
        }
    }
    else {
        if ($his == 0) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) AND fornecedores.idfornecedor = '$f' ORDER BY(compras.data) DESC");
        }
        elseif ($his == 1) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE compras.data <= '$df' AND fornecedores.idfornecedor = '$f' ORDER BY(compras.data) DESC");
        }
        elseif ($his == 2) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE compras.data = '$di' AND fornecedores.idfornecedor = '$f'");
        }
        elseif ($his == 3) {
           $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE compras.data >= '$di' AND compras.data <= '$df' AND fornecedores.idfornecedor = '$f'  ORDER BY(compras.data) DESC");
        }
    }
    if (mysql_num_rows($sql1)>=1) {
      $html1 = "<tr><th>Fornecedor</th><th>Produto/Serviço</th><th>Data</th></tr>";
      }
      else{
        $html1 = "<tr><td colspan='3'><i class='fa fa-exclamation-triangle'></i><b> Nenhum Registro!</b></td></tr>";
      }
    while ($row1 = mysql_fetch_array($sql1)) {
      $html1 .= "<tr><td>".$row1['razao_social']."</td>";
      $idcompra = $row1['idcompra'];
      $html1 .= "<td><a href='especificacoes_compra.php?id=".$idcompra."'>";
      $sql2 = mysql_query("SELECT * FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) WHERE compras.idcompra = '$idcompra' LIMIT 6") or die(mysql_error());
      $sql3 = mysql_query("SELECT * FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) WHERE compras.idcompra = '$idcompra'");
      if (mysql_num_rows($sql2)>=1) {
        $num = mysql_num_rows($sql2);
        while ($row2 = mysql_fetch_array($sql2)) {
          if ($num != 1) {
            $html1 .= $row2['nome'].", ";
          }
          else{
            $html1 .= $row2['nome'].", ...";
          }
          $num--;
        }
      }
      elseif (mysql_num_rows($sql3)>=1) {
        while ($row2 = mysql_fetch_array($sql3)) {
          $html1 .= $row2['descriminacao'];
        }
      }
      else{
        $html1 .= "Nenhum registro";
      }
      $html1 .= "</a></td><td>".$row1['data']."</td></tr>";
    }
    return $html1;
  }

//função de pesquisar histórico de compras quando houver o campo de pesquisa por produto ou serviço

function historico2($his, $pes, $di, $df, $f){
  $html1 = null;
    if ($f == 0) {
        if ($his == 0) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE produtos.nome like '%$pes%' ORDER BY(compras.data) DESC");
          $sql2 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE servicos.descriminacao like '%$pes%' ORDER BY(compras.data) DESC");
        }
        elseif ($his == 1) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE produtos.nome like '%$pes%' AND compras.data <= '$df' ORDER BY(compras.data) DESC ");
          $sql2 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE servicos.descriminacao like '%$pes%' AND compras.data <= '$df' ORDER BY(compras.data) DESC");
        }
        elseif ($his == 2) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE produtos.nome like '%$pes%' AND compras.data = '$di'");
          $sql2 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE servicos.descriminacao like '%$pes%' AND compras.data = '$di'");
        }
        elseif ($his == 3) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE produtos.nome like '%$pes%' AND compras.data >= '$di' AND compras.data <= '$df' ORDER BY(compras.data) DESC");
          $sql2 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE servicos.descriminacao like '%$pes%' AND compras.data >= '$di' AND compras.data <= '$df' ORDER BY(compras.data) DESC");
        }
    }
    else {
        if ($his == 0) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE produtos.nome like '%$pes%' AND fornecedores.idfornecedor = '$f' ORDER BY(compras.data) DESC");
          $sql2 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE servicos.descriminacao like '%$pes%' AND fornecedores.idfornecedor = '$f' ORDER BY(compras.data) DESC");
        }
        elseif ($his == 1) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE produtos.nome like '%$pes%' AND compras.data <= '$df' AND fornecedores.idfornecedor = '$f' ORDER BY(compras.data) DESC ");
          $sql2 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE servicos.descriminacao like '%$pes%' AND compras.data <= '$df' AND fornecedores.idfornecedor = '$f' ORDER BY(compras.data) DESC");
        }
        elseif ($his == 2) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE produtos.nome like '%$pes%' AND compras.data = '$di' AND fornecedores.idfornecedor = '$f'");
          $sql2 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE servicos.descriminacao like '%$pes%' AND compras.data = '$di' AND fornecedores.idfornecedor = '$f'");
        }
        elseif ($his == 3) {
          $sql1 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE produtos.nome like '%$pes%' AND compras.data >= '$di' AND compras.data <= '$df' AND fornecedores.idfornecedor = '$f' ORDER BY(compras.data) DESC");
          $sql2 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE servicos.descriminacao like '%$pes%' AND compras.data >= '$di' AND compras.data <= '$df' AND fornecedores.idfornecedor = '$f' ORDER BY(compras.data) DESC");
        }
    }
    if (mysql_num_rows($sql1)>=1 && mysql_num_rows($sql2)>=1) {
      $html1 .= "<tr><th>Fornecedor</th><th>Produto/Serviço</th><th>Data</th></tr>";
      #quando ha produtos e serviços
      $ids = array();
      $o = 0;
      while ($row1 = mysql_fetch_array($sql1)) {
        $ids[$o] = $row1['idcompra'];
        $o++;
      }
      while ($row1 = mysql_fetch_array($sql2)) {
        $ids[$o] = $row1['idcompra'];
        $o++;
      }
      $ids = array_unique($ids);
      rsort($ids);
      $q = count($ids);
      for ($i=0; $i < $q; $i++) { 
        $sql3 = mysql_fetch_array(mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE compras.idcompra = '$ids[$i]'"));
        $html1 .= "<tr><td>".$sql3['razao_social']."</td><td><a href='especificacoes_compra.php?id=".$ids[$i]."'>";

        $sql4 = mysql_query("SELECT * FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) WHERE compras.idcompra = '$ids[$i]' LIMIT 6") or die(mysql_error());
        $sql5 = mysql_query("SELECT * FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) WHERE compras.idcompra = '$ids[$i]'");
        if (mysql_num_rows($sql4)>=1) {
          $num = mysql_num_rows($sql4);
          while ($row2 = mysql_fetch_array($sql4)) {
            if ($num != 1) {
              $html1 .= $row2['nome'].", ";
            }
            else{
              $html1 .= $row2['nome'].", ...";
            }
            $num--;
          }
        }
        elseif (mysql_num_rows($sql5)>=1) {
          while ($row2 = mysql_fetch_array($sql5)) {
            $html1 .= $row2['descriminacao'];
          }
        }
        else{
          $html1 .= "Nenhum registro";
        }
        $html1 .= "</a></td><td>".$sql3['data']."</td></tr>";
      }
    }
    elseif (mysql_num_rows($sql1)>=1 && mysql_num_rows($sql2) == 0) {
      $html1 .= "<tr><th>Fornecedor</th><th>Produto/Serviço</th><th>Data</th></tr>";
      #se so haver produtos
      $row0 = mysql_fetch_array($sql1);
      $idcompra = $row0['idcompra'];
      $forn = $row0['razao_social'];
      $datac = $row0['data'];
      while ($row1 = mysql_fetch_array($sql1)) {
        if ($idcompra != $row1['idcompra']) {
          $sql3 = mysql_query("SELECT * FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) WHERE compras.idcompra = '$idcompra' LIMIT 6") or die(mysql_error());
          $html1 .= "<tr><td>".$forn."</td><td><a href='especificacoes_compra.php?id=".$idcompra."'>";
          $num = mysql_num_rows($sql3);
          while ($row2 = mysql_fetch_array($sql3)) {
            if ($num != 1) {
              $html1 .= $row2['nome'].", ";
            }
            else{
              $html1 .= $row2['nome'].", ...";
            }
            $num--;
          }
          $html1 .= "</a></td><td>".$datac."</td></tr>";
        }
        $forn = $row1['razao_social'];
        $idcompra = $row1['idcompra']; 
        $datac = $row1['data'];  
      }
      $sql3 = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) WHERE compras.idcompra = '$idcompra' LIMIT 6") or die(mysql_error());
      $html1 .= "<tr><td>".$forn."</td><td><a href='especificacoes_compra.php?id=".$idcompra."'>";
      $num = mysql_num_rows($sql3);

      while ($row2 = mysql_fetch_array($sql3)) {
        if ($num != 1) {
          $html1 .= $row2['nome'].", ";
        }
        else{
          $html1 .= $row2['nome'].", ...";
        }
        $num--;
        $datac = $row2['data'];
      }
      $html1 .= "</a></td><td>".$datac."</td></tr>";
    }
    elseif (mysql_num_rows($sql2)>=1 && mysql_num_rows($sql1) == 0) {
      $html1 .= "<tr><th>Fornecedor</th><th>Produto/Serviço</th><th>Data</th></tr>";
      while ($row1 = mysql_fetch_array($sql2)) { 
          $html1 .= "<tr><td>".$row1['razao_social']."</td><td><a href='especificacoes_compra.php?id=".$row1['idcompra']."'>".$row1['descriminacao']."</a></td><td>".$row1['data']."</td><tr>"; 
      }
    }
    else{
      $html1 = "<tr><td colspan='3'><i class='fa fa-exclamation-triangle'></i><b> Nenhum Registro!</b></td></tr>";
    }
    return $html1;
}

function historico3($his, $di, $df, $f)
{
  $html1 = null;
  if ($f == 0) {
    // Quando não houver um fornecedor especifico
    if ($his == 0) {
      $sql1 = mysql_query("SELECT * FROM produtos");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor)");
    }
    elseif ($his == 1) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data <= '$df'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao <= '$df'");
    }
    elseif ($his == 2) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data = '$di'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao = '$di'");
    }  
    elseif ($his == 3) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data >= '$di' AND data <='$df'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao >= '$di' AND data_emissao <='$df'");
    }
  }
  else {
    // Quando haver um fornecedor especifico
    if ($his == 0) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE idfornecedor = '$f'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE fornecedores.idfornecedor = '$f'");
    }
    elseif ($his == 1) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data <= '$df' AND idfornecedor = '$f'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao <= '$df' AND fornecedores.idfornecedor = '$f'");
    }
    elseif ($his == 2) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data = '$di' AND idfornecedor = '$f'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao = '$di' AND fornecedores.idfornecedor = '$f'");
    }
    elseif ($his == 3) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data >= '$di' AND data <='$df' AND idfornecedor = '$f'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao >= '$di' AND data_emissao <='$df' AND fornecedores.idfornecedor = '$f'");
    }
  }
  $html1 .= "<tr><th>Fornecedor</th><th>Produto/Serviço</th><th>Data</th></tr>";
  $a = array('a', 'b', 'c', 'd');
  $ids = array();
  $o = 0;
  $o2 = 0;
  if (mysql_num_rows($sql1)>=1) {
    while ($row1 = mysql_fetch_array($sql1)) {
      $ids[$o2] = $row1['idcompra'];
      $o2++;
    }
    $ids = array_unique($ids);
    sort($ids);
    for ($i=0; $i < count($ids); $i++) { 
      $ss = mysql_query("SELECT * FROM produtos JOIN fornecedores ON (produtos.idfornecedor = fornecedores.idfornecedor) WHERE idcompra = '$ids[$i]'") or die(mysql_error());
      $row5 = mysql_fetch_array($ss);
      $a['a'][$o] = $row5['razao_social'];
      $a['c'][$o] = $row5['data'];
      $a['d'][$o] = $row5['idcompra'];
      $ss2 = mysql_query("SELECT * FROM produtos WHERE idcompra = '$ids[$i]' LIMIT 6");
      $num = mysql_num_rows($ss2);
      while($row1 = mysql_fetch_array($ss2)) {
        if ($num != 1) {
          @$rr .= $row1['nome'].", ";
        }
        else {
          @$rr .= $row1['nome'].", ...";
        }
        $num--;
      }
      $a['b'][$o] = $rr;
      $o++;
      $rr = null;
    }
  }
  if (mysql_num_rows($sql2)>=1) {
    while ($row1 = mysql_fetch_array($sql2)) {
      $a['a'][$o] = $row1['razao_social'];
        $a['b'][$o] = $row1['descriminacao'].".";
        $a['c'][$o] = $row1['data_emissao'];
        $a['d'][$o] = $row1['idcompra'];
        $o++; // Reavaliar
    }
  }
  $cont = count($a['a']);
  if ($cont >= 1) {
    array_multisort($a['c'], SORT_DESC, $a['a'], $a['b'], $a['d']);
    for ($i=0; $i < $cont ; $i++) {
      $dateRun = $a['c'][$i];
      $dateRun = explode("-", $dateRun);
      $html1 .= "<tr><td>".$a['a'][$i]."</td><td><a href='especificacoes_compra.php?id=".$a['d'][$i]."'>".$a['b'][$i]."</a></td><td>".$dateRun[2]."/".$dateRun[1]."/".$dateRun[0]."</td>";
    }
  }
  else {
    $html1 = "<tr><td colspan='3'><i class='fa fa-exclamation-triangle'></i><b> Nenhum Registro!</b></td></tr>";
  } 
  return $html1;
}
function historico4($his, $pes, $di, $df, $f)
{
  $html1 = null; 
  if ($f == 0) {
    if ($his == 0) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE nome like '%$pes%'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE servicos.descriminacao like '%$pes%'");
    }
    elseif ($his == 1) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data <= '$df' AND nome like '%$pes%'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao <= '$df' AND servicos.descriminacao like '%$pes%'");
    }
    elseif ($his == 2) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data = '$di' AND nome like '%$pes%'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao = '$di' AND servicos.descriminacao like '%$pes%'");
    }  
    elseif ($his == 3) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data >= '$di' AND data <='$df'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao >= '$di' AND data_emissao <='$df' AND servicos.descriminacao like '%$pes%'");
    }
  }
  else {
    // Quando haver um fornecedor especifico
    if ($his == 0) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE idfornecedor = '$f' AND nome like '%$pes%'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE fornecedores.idfornecedor = '$f' AND servicos.descriminacao like '%$pes%'");
    }
    elseif ($his == 1) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data <= '$df' AND idfornecedor = '$f' AND nome like '%$pes%'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao <= '$df' AND fornecedores.idfornecedor = '$f' AND servicos.descriminacao like '%$pes%'");
    }
    elseif ($his == 2) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data = '$di' AND idfornecedor = '$f' AND nome like '%$pes%'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao = '$di' AND fornecedores.idfornecedor = '$f' AND servicos.descriminacao like '%$pes%'");
    }
    elseif ($his == 3) {
      $sql1 = mysql_query("SELECT * FROM produtos WHERE data >= '$di' AND data <='$df' AND idfornecedor = '$f' AND nome like '%$pes%'");
      $sql2 = mysql_query("SELECT * FROM servicos JOIN fornecedores ON (servicos.idfornecedor = fornecedores.idfornecedor) WHERE data_emissao >= '$di' AND data_emissao <='$df' AND fornecedores.idfornecedor = '$f' AND servicos.descriminacao like '%$pes%'");
    }
  }
  $html1 .= "<tr><th>Fornecedor</th><th>Produto/Serviço</th><th>Data</th></tr>";
  $a = array('a', 'b', 'c', 'd');
  $ids = array();
  $o = 0;
  $o2 = 0;
  if (mysql_num_rows($sql1)>=1) {
    while ($row1 = mysql_fetch_array($sql1)) {
      $ids[$o2] = $row1['idcompra'];
      $o2++;
    }
    $ids = array_unique($ids);
    sort($ids);
    for ($i=0; $i < count($ids); $i++) { 
      $ss = mysql_query("SELECT * FROM produtos JOIN fornecedores ON (produtos.idfornecedor = fornecedores.idfornecedor) WHERE idcompra = '$ids[$i]'") or die(mysql_error());
      $row4 = mysql_fetch_array($ss);
      $a['a'][$o] = $row4['razao_social'];
      $a['c'][$o] = $row4['data'];
      $a['d'][$o] = $row4['idcompra'];
      $ss2 = mysql_query("SELECT * FROM produtos WHERE idcompra = '$ids[$i]' LIMIT 6");
      $num = mysql_num_rows($ss2);
      while($row1 = mysql_fetch_array($ss2)) {
        if ($num != 1) {
          @$rr .= $row1['nome'].", ";
        }
        else {
          @$rr .= $row1['nome'].", ...";
        }
        $num--;
      }
      $a['b'][$o] = $rr;
      $o++;
      $rr = null;
    }
  }
  if (mysql_num_rows($sql2)>=1) {
    while ($row1 = mysql_fetch_array($sql2)) {
      $a['a'][$o] = $row1['razao_social'];
        $a['b'][$o] = $row1['descriminacao'].".";
        $a['c'][$o] = $row1['data_emissao'];
        $a['d'][$o] = $row1['idcompra'];
        $o++; // Reavaliar
    }
  }
  $cont = count($a['a']);
  if ($cont >= 1) {
    array_multisort($a['c'], SORT_DESC, $a['a'], $a['b'], $a['d']);
    for ($i=0; $i < $cont ; $i++) {
      $dateRun = $a['c'][$i];
      $dateRun = explode("-", $dateRun);
      $html1 .= "<tr><td>".$a['a'][$i]."</td><td><a href='especificacoes_compra.php?id=".$a['d'][$i]."'>".$a['b'][$i]."</a></td><td>".$dateRun[2]."/".$dateRun[1]."/".$dateRun[0]."</td>";
    }
  }
  else {
    $html1 = "<tr><td colspan='3'><i class='fa fa-exclamation-triangle'></i><b> Nenhum Registro!</b></td></tr>";
  }
  return $html1;
}
?>