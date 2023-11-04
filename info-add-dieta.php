<?php 
    //conexão com o BD
    $connection = mysqli_connect("localhost:3306", "root", "root", "nutri_db") or die ("Error: " . mysqli_error($connection));

    //query para pegar os alimentos do bd
    $query = "  SELECT * FROM alimentos_tbl
                JOIN nutrientes_tbl
                ON alimentos_tbl.id_alimento = nutrientes_tbl.id_alimento; ";

    //executa a query
    $resultado = mysqli_query($connection, $query) or die ("Erro ao selecionar " . mysqli_error($connection));

    //array para armazenar o resultado

    $arrayAlimentos = array();
    
    //passa o resultado para o array
    while($row = mysqli_fetch_assoc($resultado)){
        $arrayAlimentos[] = $row;
    }

    //caminho do JSON
    $jsonAlimentos = fopen('./jsons/alimentos.json', 'w');

    //escreve no JSON e utiliza a função JSON_encode
    fwrite($jsonAlimentos, json_encode($arrayAlimentos));
    fclose($jsonAlimentos);

    //encaminha para a pagina de adicionar a dieta
    header ('Location: ./adicionar-dieta.php')
?>