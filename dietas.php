<?php 
    require './cabecalho.php';
?>
<title>Dietas</title>

<div class="container-principal"> <!-- Container principal da pagina -->
    <div class="container-lateral"> <!-- sidebar da página -->
        <div class="container-info-cliente"> <!-- informações cliente -->
            <h4>Angelo Daniel Spavieri Alvarez</h4> <!-- Nome cliente -->
            Peso: 68<br> <!-- peso -->
            Altura: 1.72m<br> <!-- altura -->
            Idade: 21<br> <!-- idade -->
        </div> <!-- Fim informações Clientes -->
        
    </div> <!-- fim sidebar -->

    <div class="container-conteudo"> <!-- container conteudo -->
        <div class="container-add-dieta">
            <a href="adicionar-dieta.php">Adicionar dieta</a>
        </div>


        <div class="container-dieta"> <!-- container da dieta-->
            <div class="container-refeicao"> <!-- container de uma refeição -->
                <h3>Desjejum</h3> <!-- nome refeição -->
                10:00 - Informações Adicionais <!-- informações adicionais -->
                <table class="table-refeicao"> <!-- Tabela da refeição -->
                    <thead>
                        <th>
                            Alimento
                        </th>
                        <th>
                            Quantidade
                        </th>
                        <th>
                            Carboidrato
                        </th>
                        <th>
                            Proteina
                        </th>
                        <th>
                            Gordura
                        </th>
                        <th>
                            Calorias
                        </th>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                Ovo
                            </td>
                            <td>
                                2
                            </td>
                            <td>
                                4
                            </td>
                            <td>
                                30
                            </td>
                            <td>
                                20
                            </td>
                            <td>
                                100
                            </td>
                        </tr>
                    </tbody>

                </table> <!-- fim tabela refeição -->
            </div> <!-- Fim container de uma refeição -->
        </div> <!-- Fim container dieta -->
    </div> <!-- Fim container conteudo -->

</div> <!-- Fim Container principal da página -->