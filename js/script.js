//objeto alimento para tabela da refeição do plano alimentar
var alimentoRefeicao = new Array;

function adicionarAlimento(){
    console.log(typeof localStorage.getItem("alimentoRefeicao"));
    if (typeof localStorage.getItem("alimentoRefeicao") != "object"){
        console.log('teset')
        alimentoRefeicao = localStorage.getItem("alimentoRefeicao") + ",";
    }
    console.log(typeof alimentoRefeicao);
    alimentoRefeicao += [document.getElementById("select-alimentos").value, document.getElementById("quant_alimento").value];
    console.log(alimentoRefeicao);
    localStorage.setItem("alimentoRefeicao", alimentoRefeicao);
}

//arthur h  hinc