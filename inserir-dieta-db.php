<?php
    session_start();

    //verifica se o array-ref já possui
    if(!isset($_SESSION['array-ref'])){
        $_SESSION['array-ref'] = [];
    }

    //recebe os dados enviados pelo ajax
    $dados = $_POST['data'];
    //"decode" o json e passa para a variavel alimentos
    $alimentos = json_decode($dados, true);
    //cria um PDO com a conexão com o banco de dados
    $pdo = new PDO('mysql:host=localhost; dbname=nutri_db;', 'root', 'root');

    function armazenaArrayRef(){
        //query com o ultimo id
        $queryLastId = 'SELECT id_ref FROM refeicoes_tbl
        WHERE id_ref = LAST_INSERT_ID();';
        global $pdo;
        //cria um query preparada pelo PDO para pesquisar o ultimo ID inserido na tabela de refeições
        $teste = $pdo->prepare($queryLastId);
        //executa a query
        $teste->execute();
        //realiza um fetch para criar um array e armazenar na variavel resultado
        $resultado = $teste->fetch();
        $resultadoArray = [$resultado[0]];
        $_SESSION['array-ref'] = array_merge($_SESSION['array-ref'],$resultadoArray);
    }

    

    //prepara a query com o pdo
    $query = $pdo->prepare('INSERT INTO refeicoes_tbl 
    (id_cliente, nome_ref, horario_ref, info_adicional_ref, ali_um, quant_um, ali_dois, quant_dois, 
    ali_tres, quant_tres, ali_quatro, quant_quatro, ali_cinco, quant_cinco, ali_seis, quant_seis, 
    ali_sete, quant_sete, ali_oito, quant_oito, ali_nove, quant_nove, ali_dez, quant_dez) VALUES
    (1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?);');

    // VERIFICA SE A INFORMAÇÕES ISSET, caso tenha sido recebida troca o '?' para a informação recebida
    // CASO NÃO TENHA SIDO RECEBIDA, ALTERA PARA NULL NOS ALIMENTOS E OUTRO TIPO DE DADOS NOS VARCHAR

    //altera os dados com a informações corretas recebidas pelo ajax
    isset($alimentos['nome-ref']) ? $query->bindValue(1, $alimentos['nome-ref']) : $query->bindValue(1, "Sem nome");
    isset($alimentos['horario']) ? $query->bindValue(2, $alimentos['horario']) : $query->bindValue(2, "00:00");
    isset($alimentos['info-adicional']) ? $query->bindValue(3, $alimentos['info-adicional']) : $query->bindValue(3, "Sem info adicional");
    //alimento 1
    isset($alimentos['alimentos'][0]['id_alimento']) ? $query->bindValue(4, $alimentos['alimentos'][0]['id_alimento']) : $query->bindValue(4, null);
    isset($alimentos['alimentos'][0]['quant_alimento']) ? $query->bindValue(5, $alimentos['alimentos'][0]['quant_alimento']) : $query->bindValue(5, null);
    //alimento 2
    isset($alimentos['alimentos'][1]['id_alimento']) ? $query->bindValue(6, $alimentos['alimentos'][1]['id_alimento']) : $query->bindValue(6, null);
    isset($alimentos['alimentos'][1]['quant_alimento']) ? $query->bindValue(7, $alimentos['alimentos'][1]['quant_alimento']) : $query->bindValue(7, null);
    //alimento 3
    isset($alimentos['alimentos'][2]['id_alimento']) ? $query->bindValue(8, $alimentos['alimentos'][2]['id_alimento']) : $query->bindValue(8, null);
    isset($alimentos['alimentos'][2]['quant_alimento']) ? $query->bindValue(9, $alimentos['alimentos'][2]['quant_alimento']) : $query->bindValue(9, null);
    //alimento 4
    isset($alimentos['alimentos'][3]['id_alimento']) ? $query->bindValue(10, $alimentos['alimentos'][3]['id_alimento']) : $query->bindValue(10, null);
    isset($alimentos['alimentos'][3]['quant_alimento']) ? $query->bindValue(11, $alimentos['alimentos'][3]['quant_alimento']) : $query->bindValue(11, null);
    //alimento 5
    isset($alimentos['alimentos'][4]['id_alimento']) ? $query->bindValue(12, $alimentos['alimentos'][4]['id_alimento']) : $query->bindValue(12, null);
    isset($alimentos['alimentos'][4]['quant_alimento']) ? $query->bindValue(13, $alimentos['alimentos'][4]['quant_alimento']) : $query->bindValue(13, null);
    //alimento 6
    isset($alimentos['alimentos'][5]['id_alimento']) ? $query->bindValue(14, $alimentos['alimentos'][5]['id_alimento']) : $query->bindValue(14, null);
    isset($alimentos['alimentos'][5]['quant_alimento']) ? $query->bindValue(15, $alimentos['alimentos'][5]['quant_alimento']) : $query->bindValue(15, null);
    //alimento 7
    isset($alimentos['alimentos'][6]['id_alimento']) ? $query->bindValue(16, $alimentos['alimentos'][6]['id_alimento']) : $query->bindValue(16, null);
    isset($alimentos['alimentos'][6]['quant_alimento']) ? $query->bindValue(17, $alimentos['alimentos'][6]['quant_alimento']) : $query->bindValue(17, null);
    //alimento 8
    isset($alimentos['alimentos'][7]['id_alimento']) ? $query->bindValue(18, $alimentos['alimentos'][7]['id_alimento']) : $query->bindValue(18, null);
    isset($alimentos['alimentos'][7]['quant_alimento']) ? $query->bindValue(19, $alimentos['alimentos'][7]['quant_alimento']) : $query->bindValue(19, null);
    //alimento 9
    isset($alimentos['alimentos'][8]['id_alimento']) ? $query->bindValue(20, $alimentos['alimentos'][8]['id_alimento']) : $query->bindValue(20, null);
    isset($alimentos['alimentos'][8]['quant_alimento']) ? $query->bindValue(21, $alimentos['alimentos'][8]['quant_alimento']) : $query->bindValue(21, null);
    //alimento 10
    isset($alimentos['alimentos'][9]['id_alimento']) ? $query->bindValue(22, $alimentos['alimentos'][9]['id_alimento']) : $query->bindValue(22, null);
    isset($alimentos['alimentos'][9]['quant_alimento']) ? $query->bindValue(23, $alimentos['alimentos'][9]['quant_alimento']) : $query->bindValue(23, null);

    //executa a query com os dados alterados
    $query->execute();

    //retorna se a query foi bem sucedidade ou não
    if ($query->rowCount() >= 1){
        armazenaArrayRef();
        echo json_encode($_SESSION['array-ref']);
        
    }else {
        echo json_encode("Erro ao salvar");
    }

?>
