<?php

    $dados = $_POST['data'];

    $alimentos = json_decode($dados, true);

    var_dump($alimentos);
    /*echo $alimentos['nome-ref'];
    echo $alimentos['horario'];
    echo $alimentos['info-adicional'];
    echo $alimentos['alimentos'][0]['id_alimento'];
    echo $alimentos['alimentos'][0]['quant_alimento'];
    echo $alimentos['alimentos'][1]['id_alimento'];
    echo $alimentos['alimentos'][1]['quant_alimento'];*/

    $pdo = new PDO('mysql:host=localhost; dbname=nutri_db;', 'root', 'root');

    /*$query = $pdo->prepare('INSERT INTO refeicoes_tbl 
    (id_cliente, nome_ref, horario_ref, info_adicional_ref, ali_um, quant_um, ali_dois, quant_dois, ali_tres, quant_tres, ali_quatro, quant_quatro, 
    ali_cinco, quant_cinco, ali_seis, quant_seis, ali_sete, quant_sete, 
    ali_oito, quant_oito, ali_nove, quant_nove, ali_dez, quant_dez) VALUES
    (1, ":nome_ref", ":info_ref", :ali1, :quant1, :ali2, :quant2, :ali3, :quant3, :ali4, :quant4, :ali5, :quant5, :ali6,
    :quant6, :ali7, :quant7, :ali8, :quant8, :ali9, :quant9, :ali10, :quant10);');*/ 

    $query = $pdo->prepare('INSERT INTO refeicoes_tbl 
    (id_cliente, nome_ref, horario_ref, info_adicional_ref, ali_um, quant_um, ali_dois, quant_dois, 
    ali_tres, quant_tres, ali_quatro, quant_quatro, ali_cinco, quant_cinco, ali_seis, quant_seis, 
    ali_sete, quant_sete, ali_oito, quant_oito, ali_nove, quant_nove, ali_dez, quant_dez) VALUES
    (1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?);');



    isset($alimentos['nome-ref']) ? $query->bindValue(1, $alimentos['nome-ref']) : $query->bindValue(1, "Sem nome");
    isset($alimentos['horario']) ? $query->bindValue(2, $alimentos['horario']) : $query->bindValue(2, "00:00");
    isset($alimentos['info-adicional']) ? $query->bindValue(3, $alimentos['info-adicional']) : $query->bindValue(3, "Sem info adicional");
   
    isset($alimentos['alimentos'][0]['id_alimento']) ? $query->bindValue(4, $alimentos['alimentos'][0]['id_alimento']) : $query->bindValue(4, "null");
    isset($alimentos['alimentos'][0]['quant_alimento']) ? $query->bindValue(5, $alimentos['alimentos'][0]['quant_alimento']) : $query->bindValue(5, "null");

    isset($alimentos['alimentos'][1]['id_alimento']) ? $query->bindValue(6, $alimentos['alimentos'][1]['id_alimento']) : $query->bindValue(6, "null");
    isset($alimentos['alimentos'][1]['quant_alimento']) ? $query->bindValue(7, $alimentos['alimentos'][1]['quant_alimento']) : $query->bindValue(7, "null");

    isset($alimentos['alimentos'][2]['id_alimento']) ? $query->bindValue(8, $alimentos['alimentos'][2]['id_alimento']) : $query->bindValue(8, "null");
    isset($alimentos['alimentos'][2]['quant_alimento']) ? $query->bindValue(9, $alimentos['alimentos'][2]['quant_alimento']) : $query->bindValue(9, "null");

    isset($alimentos['alimentos'][3]['id_alimento']) ? $query->bindValue(10, $alimentos['alimentos'][3]['id_alimento']) : $query->bindValue(10, "null");
    isset($alimentos['alimentos'][3]['quant_alimento']) ? $query->bindValue(11, $alimentos['alimentos'][3]['quant_alimento']) : $query->bindValue(11, "null");

    isset($alimentos['alimentos'][4]['id_alimento']) ? $query->bindValue(12, $alimentos['alimentos'][4]['id_alimento']) : $query->bindValue(12, "null");
    isset($alimentos['alimentos'][4]['quant_alimento']) ? $query->bindValue(13, $alimentos['alimentos'][4]['quant_alimento']) : $query->bindValue(13, "null");

    isset($alimentos['alimentos'][5]['id_alimento']) ? $query->bindValue(14, $alimentos['alimentos'][5]['id_alimento']) : $query->bindValue(14, "null");
    isset($alimentos['alimentos'][5]['quant_alimento']) ? $query->bindValue(15, $alimentos['alimentos'][5]['quant_alimento']) : $query->bindValue(15, "null");

    isset($alimentos['alimentos'][6]['id_alimento']) ? $query->bindValue(16, $alimentos['alimentos'][6]['id_alimento']) : $query->bindValue(16, "null");
    isset($alimentos['alimentos'][6]['quant_alimento']) ? $query->bindValue(17, $alimentos['alimentos'][6]['quant_alimento']) : $query->bindValue(17, "null");

    isset($alimentos['alimentos'][7]['id_alimento']) ? $query->bindValue(18, $alimentos['alimentos'][7]['id_alimento']) : $query->bindValue(18, "null");
    isset($alimentos['alimentos'][7]['quant_alimento']) ? $query->bindValue(19, $alimentos['alimentos'][7]['quant_alimento']) : $query->bindValue(19, "null");

    isset($alimentos['alimentos'][8]['id_alimento']) ? $query->bindValue(20, $alimentos['alimentos'][8]['id_alimento']) : $query->bindValue(20, "null");
    isset($alimentos['alimentos'][8]['quant_alimento']) ? $query->bindValue(21, $alimentos['alimentos'][8]['quant_alimento']) : $query->bindValue(21, "null");

    isset($alimentos['alimentos'][9]['id_alimento']) ? $query->bindValue(22, $alimentos['alimentos'][9]['id_alimento']) : $query->bindValue(22, "null");
    isset($alimentos['alimentos'][9]['quant_alimento']) ? $query->bindValue(23, $alimentos['alimentos'][9]['quant_alimento']) : $query->bindValue(23, "null");


    $query->execute();

    if ($query->rowCount() >= 1){
        echo json_encode("Comentario salvo");
    }else {
        echo json_encode("Erro ao salvar");
    }

?>
