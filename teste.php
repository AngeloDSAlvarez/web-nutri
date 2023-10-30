<?php
    //conexão com o BANCO DE DADOS
    $connection = mysqli_connect("localhost","root","root","nutri_db") or die ("Error " . mysqli_error($connection));

    //query com o que eu quero da tabela
    $query = "SELECT * FROM clientes";
    //executa a query ou da o código de erro
    $result = mysqli_query($connection, $query) or die ("Erro ao selecionar " . mysqli_error($connection));

    //cria um array para armazenar o resultado
    $emparray = array();

    while($row = mysqli_fetch_assoc($result)){
        $emparray[] = $row;
    }

    //variável recebe o caminho do JSON para escrever nele "w"
    $fp = fopen('./jsons/clientes.JSON', 'w');
    //escreve no caminho "$fp", e utiliza a função json_encode para transformar o array em JSON
    fwrite($fp, json_encode($emparray));
    fclose($fp);

    $json = file_get_contents('./jsons/clientes.JSON');
    $data = json_decode($json);

    echo $data[1]->nome;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
    </body>
</html>