<?php
    require 'cabecalho.php';
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
        <h3>Almoço</h3>
        <p>12:00 | Informações Adicionais</p>
        <table class="table-refeicao">
            <thead>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Proteina</th>
                <th>Carboidrato</th>
                <th>Gordura</th>
                <th>Kcal</th>
            </thead>
            <tbody>
                <td>Arroz</td>
                <td>250</td>
                <td>5</td>
                <td>100</td>
                <td>0</td>
                <td>500</td>
            </tbody>
        </table>
        
    </div>

</div> <!-- Fim container da página-->