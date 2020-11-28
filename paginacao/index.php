<!-- Chama a biblioteca jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style>
    .paginacao{
        position:relative;
        top:500px;
        font-size:30px;
    }
    .divProdutos{
        position:absolute;
        top:100px;
        width:100%;
    }
    .produtos {
        font-size:20px;
    }
</style>
<center>
<?php
 session_start();

 if(!empty($_GET['pagina'])){
    $_SESSION['pagina'] = $_GET['pagina'];
 }else{
    $_SESSION['pagina'] = 1;
 }

 for($i = 1; $i <= $_SESSION['totalPaginas']; $i++){
    echo  "<a href = 'index.php?pagina=$i' class = 'paginacao' >" .$i. "</a>";
}
?>
</center>
<center> <h1 style = "color:#483D8B;font-family:arial;top:50px;position:relative;"> CADASTRO </h1> </center>
<script type = "text/javascript">
jQuery(document).ready(function(){
var param = 10;
    jQuery.ajax({
        url: 'teste2.php',
        ascyn: false,
        data:{
            'param': param
        },
        type: 'POST',
        dataType: 'html',
        success: function (data){
        /*Recebe os dados*/
        var dados = [];
        var produtos = [];
        dados.push(JSON.parse(data));
        /* Salva os dados na localStorage para gerar o PDF */
        localStorage.setItem("dadosPDF",(data));
        /* Carrega os dados da tabela */
        dados.forEach((elem) => {
            for(i = 0; i <= (elem.length-1); i++)
            {
                produtos.push
                (`
                    <tr>
                        <td>${elem[i].idprod}</td>
                        <td>${elem[i].nome}</td>
                        <td>${elem[i].cor}</td>
                        <td>${elem[i].preco}</td>
                    </tr>
                `);
            }
        });
        jQuery(".produtos").html(produtos.join(''));
        /* Tabela 
        tabela.innerHTML = [`
            <table class='table table-dark tabela'>
            <thead>
                <tr>
                <th scope='col'>ID Produto</th>
                <th scope='col'>Cor</th>
                <th scope='col'>Nome</th>
                <th scope='col'>Preço</th>
                </tr>
            </thead>
            <tbody id = 'produtos'>
            ${produtos.join('')}
            </tbody>
            </table>
        `];*/
    }
});
});
</script>

<div class = "divProdutos">
<table class='table table-dark tabela'>
    <thead>
        <tr>
            <th scope='col'>ID Produto</th>
            <th scope='col'>Cor</th>
            <th scope='col'>Nome</th>
            <th scope='col'>Preço</th>
        </tr>
    </thead>
    <tbody class = 'produtos'>
    </tbody>
</table>
</div>

<style>
.tabela{
    position:relative;
    top:50px;
}
.icons{
    width:150px;
    right:60px;
    top:100px;
    position:absolute;

}
</style>
<div class = "icons">
<img src = "pdf.png" style = "cursor:pointer;" onclick = "gerarPDF();" id = 'download-btn'/>
<img src = "word.png" style = "cursor:pointer;"/>
<img src = "imprimir.png" onclick = "window.print()" style = "cursor:pointer;"/>
</div>
<div id = "tabela">
</div>


<!-- Gerar PDF -->

<script src="dist/jspdf.umd.js"></script>
<script>if (!window.jsPDF) window.jsPDF = window.jspdf.jsPDF</script>
<script src="dist/jspdf.plugin.autotable.js"></script>
<script src="dist/examples.js"></script>

<script>
    document.getElementById('download-btn').onclick = function () {
        update(true);
    };

    function update(shouldDownload) {
        var funcStr = window.location.hash.replace(/#/g, '') || 'basic';
        var doc = window.examples[funcStr]();

        doc.setProperties({
            title: 'Example: ' + funcStr,
            subject: 'A jspdf-autotable example pdf (' + funcStr + ')'
        });

        if (shouldDownload) {
            doc.save('table.pdf');
        }
    }
</script>