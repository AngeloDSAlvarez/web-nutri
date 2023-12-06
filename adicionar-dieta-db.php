<?php 
    //inicia a sessão
    session_start();

    //cria um PDO com a conexão com o banco de dados
    $pdo = new PDO('mysql:host=localhost; dbname=nutri_db;', 'root', 'root');

    //prepara a query com o insert na tabela de dieta
    $query = $pdo->prepare(' INSERT INTO dieta_tbl VALUES 
                            (null, 1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
    ');

    //inicializa a variavel $i que conta as refeições já adicionadas para usar no bindValue
    $i = 1;
    foreach ($_SESSION['array-ref'] as $ref) {
        $query->bindValue($i, $ref);
        $i++;
    }

    //Adiciona null para o restante das refeições não adicionadas
    for ($i; $i <= 10; $i++) {
        $query->bindValue($i, NULL,);
    }

    $query->execute();
    
    if ($query->rowCount() > 0) {
        $_SESSION['array-ref'] = [];
        echo "Top caraio";
    }
?>