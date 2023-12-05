<?php
    require 'cabecalho.php';

    session_start();
    
    // Função para executar a query para cada refeição dentro do arrayRef
    // E chamaar a função para imprimir a descrição da tabela e a tabela em si
    function imprimeRefeicao($arrayRef){
        //torna a variavel $pdo utilizavel dentro da função
        global $pdo;

        //query para pegar os dados da refeição
        $query = '
        SELECT * FROM refeicoes_tbl
        WHERE id_ref = ?;
        ';

        //prepara a query
        $query = $pdo->prepare($query);

        //foreach para cada refeição dentro do array
        foreach ($arrayRef as $ref){
            //altera o ? da query para a refeição atual
            $query->bindValue(1, $ref);
            $query->execute();
            //realiza o fetch no resultado (possui apenas 1 linha) e armazena no $resultado
            $resultado = $query->fetch();

            //chama função para imprimir a descrição da refeição, enviando o $resultado como parametro
            imprimeDescricaoRef($resultado);
            
            //chama função para imprimir a tabela da refeição, enviando o $resultado como parametro
            imprimeTabelaAlimento($resultado);
        }
    }
    //imprime a descrição da refeição que fica acima da tabela
    function imprimeDescricaoRef($ref){
        echo '<h3>', $ref['nome_ref'],'</h3>
        <p>',$ref['horario_ref'],' | ', $ref['info_adicional_ref'],'</p>';
    }

    //imprime a tabela de alimentos
    function imprimeTabelaAlimento($ref){
        //recebe os valores dos alimentos que estão no JSON
        $url = "./jsons/alimentos.json";
        $data = file_get_contents($url);
        //realiza um "decode" do JSON
        $alimentos = json_decode($data, true);
        //echo para o cabeçalho da tabela e o inicio do tbody
        echo '
        <table class="table-refeicao">
            <thead>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Proteina</th>
                <th>Carboidrato</th>
                <th>Gordura</th>
                <th>Kcal</th>
            </thead>
            <tbody>';
        //loop para percorrer todos os alimentos do json
        foreach($alimentos as $ali){
            //loop para percorrer por todo o select da refeição
            for ($j = 5; $j < 24; $j++){
                //verifica se o id do alimento é igual ao da refeição "ali_um", "ali_dois", etc.
                if ($ali['id_alimento'] == $ref[$j]){
                    //chama a função para imprimir a linha "<tr>" enviando os dados do alimento recebido do json e a quantidade
                    imprimeLinhaAlimento($ali, $ref[$j+1]);
                }
            }
        }
        //echo para o fim do tbody e da tabela
        echo
            '</tbody>
        </table>';
    }

    //função para imprimir a linha do alimento dentro da tabela da refeição
    //recebe os dados do alimento recebido do json e quantidade do alimento recebido pelo select no BD de ref "quant_um", "quanto_dois", etc
    function imprimeLinhaAlimento($alimentos, $quant){
        //echo para a linha da tabela
        //nas informações de proteina, carb, gord, etc. faz a quantidade recebida /100 e multiplica o valor
        //pois o valor no json é a cada 100g
        echo '
            <tr>
                <td>',$alimentos['nome_alimento'],'</td>
                <td>',$quant,'</td>
                <td>',$alimentos['proteina'] * ($quant/100),'</td>
                <td>',$alimentos['carboidrato'] * ($quant/100),'</td>
                <td>',$alimentos['gordura'] * ($quant/100),'</td>
                <td>',$alimentos['calorias'] * ($quant/100),'</td>
            </tr>
        ';
    }
    
    //verifica se o array-ref dentro da _SESSION está setado, indicando que já foi adicionado uma refeição a dieta
    if (isset($_SESSION['array-ref'])) {
        //conexão BD
        $pdo = new PDO('mysql:host=localhost; dbname=nutri_db;', 'root', 'root');
        $_SESSION['ref-alimentos'] = [];
    
        //querya com o select de refeições
        $querySelectRef = 'SELECT id_ref FROM refeicoes_tbl WHERE id_ref = ?';
        
        //loop para percorrer pelo array de refeições
        for ($i = 0; $i < count($_SESSION['array-ref']); $i++) {
            //prepara a busca com a query
            $stmt = $pdo->prepare($querySelectRef);
            //altera o ? para o id do alimento 
            $stmt->bindValue(1, $_SESSION['array-ref'][$i]);
            //executa a query
            $stmt->execute();
            //realiza um fetch para o resultado obtido
            $resultado = $stmt->fetchAll();
            //armazena no array ref-alimentos dentro da _SESSION
            $_SESSION['ref-alimentos'] = array_merge($_SESSION['ref-alimentos'], $resultado);
        }
    }
?>

<script>
    //LIMPA O LOCALSTORAGE AO ATUALIZAR A PÁGINA
    localStorage.clear();
</script>
<div class="container-principal"> <!-- container da página -->
    <div class="container-lateral"> <!-- sidebar da página -->
        <div class="container-info-cliente"> <!-- informações cliente -->
            <h4>Angelo Daniel Spavieri Alvarez</h4> <!-- Nome cliente -->
            Peso: 68<br> <!-- peso -->
            Altura: 1.72m<br> <!-- altura -->
            Idade: 21<br> <!-- idade -->
        </div> <!-- Fim informações Clientes -->
        
    </div> <!-- fim sidebar -->

    <div class="container-conteudo">
        <h2>
            Novo plano alimentar
        </h2>
        <form> <!-- FORM PARA ADICIONAR REFEIÇÃO -->
            <div class="linha-input"> <!-- Separação por linha para os inputs -->
                <label > <!-- Nome da refeição -->
                    Nome da Refeição
                    <input class="input-form-ref" id="nome-refeicao" type="text" placeholder="Desjejum" >
                </label>
                <label > <!-- Horário da refeição -->
                    Horário
                    <input class="input-form-ref" id="horario" type="text" placeholder="08:00" >
                </label>
                
            </div> <!-- fim linha -->

            <div class="linha-input"> <!-- Nova linha de inputs -->
                <label ><!-- Nome do alimento 
                            informação pega pelo JSON carregado quando inicia a página.
                        -->
                    Nome Alimento
                    <select name="select-alimentos" id="select-alimentos"> <!-- SELECT com os alimentos pego do JSON -->
                        <script>atualizaSelect()</script>
                    </select>            
                </label>

                <label> <!-- Quantidade em ml/g -->
                    Quantidade (ml/g)
                    <input id="quant_alimento" type="number" placeholder="120" >
                </label>

                <!-- botão para adicionar o alimento na refeição -->
                <input onclick="adicionarAlimento()" type="button" value="Adicionar"> 
            </div> <!-- fim da linha -->

                

            <div class="linha-input"> <!-- Nova linha de input -->
                <table name="tabela-refeicao" id="tabela-refeicao" class="table-refeicao"> <!-- tabela com os alimentos da refeição -->
                    <thead> <!-- cabeçalho tabela -->
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Proteina</th>
                        <th>Carboidrato</th>
                        <th>Gordura</th>
                        <th>Kcal</th>
                    </thead> <!-- fim cabeçalho tabela -->
                    <tbody id="body-tabela-alimentos"> <!-- corpo tabela -->
                        <!-- TODO O CORPO É GERADO PELO JS AO ADICIONAR NOVA REFEIÇÃO E ZERADO AO ATUALIZAR A PAGINA -->
                    </tbody> <!-- fim corpo tabela -->
                </table> <!-- fim tabela com a refeição -->
                
            </div> <!-- fim linha -->

            <div class="linha-input"> <!-- nova linha -->
                <label for="info-adicionais"> Informações Adicionais </label> <!-- informações adicionais da refeição-->
                <br>
                <!-- textarea com informações adicionais da tabela -->
                <textarea class="input-form-ref" id="info-adicionais" name="info-adicionais" rows="5" cols="55" maxlength="250"></textarea>
            </div> <!-- fim linha -->

            <!-- 
                SUBMIT do formulario (adicionar diretamente ao banco de dados e abaixo é mostrado o que já está no BD)

            -->
            <input onclick="enviaProPhp()" type="button" value="Adicionar Refeição">
        </form>
        <br>
        <hr>
        <br>
        <h1>Plano Alimentar</h1>
        <!-- DESCRIÇÃO DA REFEIÇÃO FEITA PELA FUNÇÃO imprimeDescricaoRef() -->
       
                <?php
                    //verifica 
                    if (isset($_SESSION['array-ref'])) {
                        imprimeRefeicao($_SESSION['array-ref']);
                    }
                ?>
        
    </div>

</div> <!-- Fim container da página-->