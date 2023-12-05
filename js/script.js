//objeto alimento para tabela da refeição do plano alimentar
var alimentoRefeicao = new Array;

//função para adicionar alimentos a tabela de refeição

function atualizarTabela(array){
    //seleciona o body da tabela de alimentos da refeição
    let bodyTabelaAlimentos = document.querySelector("#body-tabela-alimentos");
    //exclui o que possui no body atual da tabela
    bodyTabelaAlimentos.innerHTML = ` `;
    //transforma em JSON o array que recebeu como parametro
    let jsonAlimentos = alimentoParaJson(array);

    //pega o JSON de alimentos e transforma a resposta em "response"
    fetch("./jsons/alimentos.json").then((response) => {
        //converte a resposta em JSON e após for convertido (.then) possuo os "alimentos"
        response.json().then((alimentos) =>{
            //map pelo JSON de alimentos para percorrer por todos
            alimentos.map((alimento) => {
                //percorre pelo array recebido como parametro
                for(row in jsonAlimentos){
                    //busca os dados dos alimentos que estão no array que foi adicionado
                    if (jsonAlimentos[row].id_alimento == alimento.id_alimento) {
                        //chamada do HTML para inserçã na tabela
                        bodyTabelaAlimentos.innerHTML += 
                        //prot, carb, gord e calorias são multiplicados pela quantidade de alimentos/100 para dar o resultado correto
                        `
                        <tr> 
                            <td>${alimento.nome_alimento}</td>
                            <td>${jsonAlimentos[row].quant_alimento}</td>
                            <td>${jsonAlimentos[row].quant_alimento / 100 * alimento.proteina}</td>
                            <td>${jsonAlimentos[row].quant_alimento / 100 * alimento.carboidrato}</td>
                            <td>${jsonAlimentos[row].quant_alimento / 100 * alimento.gordura}</td>
                            <td>${jsonAlimentos[row].quant_alimento / 100 * alimento.calorias}</td>
                        </tr>
                        `
                    }
                }
            })
        })
    })

}

function adicionarAlimento(){
    //verifica se já possui alimento no localStorage
    if (typeof localStorage.getItem("alimentoRefeicao") != "object"){
        //caso já alimento no localStorage, armazena em alimentoRefeicao e adiciona "/" ao final
        alimentoRefeicao = localStorage.getItem("alimentoRefeicao") + "/";
    }
    //concatena o que estava no localStorage com o valor atual do select de alimentos (id do alimento) e a quantidade
    alimentoRefeicao += [document.getElementById("select-alimentos").value, document.getElementById("quant_alimento").value];
    //adiciona a variavel concatenada no localStorage
    localStorage.setItem("alimentoRefeicao", alimentoRefeicao);
    //cria um array separando pelos "/", para cada index do array seja um alimento diferente
    alimentoRefeicao = alimentoRefeicao.split("/");
    //percorre o array recem criado
    for (let i = 0; i < alimentoRefeicao.length; i++) {
        //cria uma matriz separando pela "," para que consiga acessar o id e a quantidade separadamente
        alimentoRefeicao[i] = alimentoRefeicao[i].split(",");
    }
 
    //atualiza a tabela chamando a função e enviando a matriz como parametro
    atualizarTabela(alimentoRefeicao);
}

//função para passar o array do alimento e quantidade para variavel JSON
function alimentoParaJson(array){
    //cria a variavel que se tornara o json
    let json = [];
    //percorre o array
    for (row in array){
        //concatena o que possui no json com o array
        json = json.concat({
            'id_alimento': array[row][0],
            'quant_alimento': array[row][1]
        },);
    }
    //retorna o json
    return json;
}

//adicionar os alimentos do JSON dentro das options
function atualizaSelect(){
    //usa o querySelector para pegar o select dos alimentos
    let selectAlimentos = document.querySelector("#select-alimentos");
    //pega o JSON de alimentos e transforma a resposta em "response"
    fetch("./jsons/alimentos.json").then((response) => {
        //converte a resposta em JSON e após for convertido (.then) possuo os "alimentos"
        response.json().then((alimentos) =>{
            //map pelo JSON de alimentos para percorrer por todos
            selectAlimentos.innerHTML = ``;
            alimentos.map((alimento) => {
                //innerHTML no "selectAlimentos" para inserir os alimentos no select
                selectAlimentos.innerHTML += `<option value="${alimento.id_alimento}"> ${alimento.nome_alimento} </option>`;
            })
        })
    })
}

//funcao para deixar no padrão de envia necessário pro ajax, recebe como parametro o json de alimentos
function formatoJsonPhp(jsonAlimentos){
    //cria variavel para receber o JSON
    let json = [];
    //seleciona os inputs com a classe ".input-form-ref"
    let seletorInputs = document.querySelectorAll(".input-form-ref");
    //seta a variavel json para o formato necessário
    json = {
        'nome-ref': seletorInputs[0].value,
        'horario': seletorInputs[1].value,
        'info-adicional': seletorInputs[2].value,
        'alimentos': jsonAlimentos
    }
    //retorna o json já com o formato stringify
    return JSON.stringify(json);
}


function enviaProPhp(){
    //transforma o array de alimentos em formato json
    let jsonAlimentos = alimentoParaJson(alimentoRefeicao);
    //envia o json de alimentos para colocar no padrão necessário para o AJAX
    jsonRef = formatoJsonPhp(jsonAlimentos);
    
    //chama o ajax onde sera feito a inserção da refeição no banco de dados
    $.ajax({
    url: 'inserir-dieta-db.php', //envia os dados para a página 'inserir-dieta-db.php'
    type: 'POST', //método post
    data: {data: jsonRef}, //data com o JSON da refeição
    success: function(result){
        console.log(result);
        localStorage.clear();
    },
    error: function(jqXHR, textStatus, errorThrown) {
        // Retorno caso algum erro ocorra
    }
    });


    
}

function funcaoJs(array){
    console.log(array);
}