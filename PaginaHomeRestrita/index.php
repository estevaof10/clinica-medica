<?php

require_once "../conectaMySQL.php";
require_once "../PaginaLogin/autentica.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

try {

    $sql = <<<SQL
    SELECT email, nome
    FROM pessoa
    SQL;

    $stmt = $pdo->query($sql);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
$emails = '';
$emailLog = '';
$nome = '';
$emailLog = $_SESSION['emailUsuario'];
while ($row = $stmt->fetch()) {
    $emails = htmlspecialchars($row['email']);

    if ($emails == $emailLog) {
        $nome = htmlspecialchars($row['nome']);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset = "utf-8">
        <meta name="viewport" content="width=devide-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
            crossorigin="anonymous">

        <title>Clínica Médica E2V</title>
        <link rel="icon" href="../imagem/E2V-title.png">
    
        <style>
            *{
                margin: 0;
                padding: 0;
                outline: 0;
                box-sizing: border-box;
            }
            html{ /* stilização do html */
                font-size: 62.5%; /* define o tamanho da fonte do codigo para que a cada 1rem seja considerado 10px */
            }
            body{ /* estilização do body */
                font-size: 1.6rem; /* define o tamanho da fonte do body em rem para responsividade */
            }
            body, html{ /* estilização do body e html */
                height: 100%; /* define a altura do body e html em 100% */
            }
            main{
                font-size: 2rem;
                text-align: center; /*Alinha no centro todo o texto que contem no body */
            }
            header{
                background-color: #7AC2C3; /* define a cor e efeito do background com degradê */
                position: fixed;
                z-index: 12;
                width: 100%;
            }
            header .container{ /* estilização do container contido no header */
                height: 80px; /* define a altura da header */
                display: flex; /* alinha o items do header na horizontal/em linha */
                justify-content: space-between; /* posiciona os elementos nas extremidades direita e esquerda */
                align-items: center; /* alinha os items no centro */
                width: 90%; /* define o tamanho do header em 90% */
                max-width: 1100px; /* define o tamanho maximo da largura do header */
                margin: auto; /* define a margem do header como automatica pra redimencionamento automatico*/
            }
            nav ul{ /* estilização da lista de itens do nav */
                display: flex; /* alinhao a lista de itens na horizontal */
            }
            ul{
                margin: auto;
            }
            li{ /* estilização da lista de itens */
                list-style: none; /* oculta os icones/pontos padroes dos itens de lista */
            }
            nav ul li a{ /* estilização da tag a*/
                text-decoration: none; /* retira a decoração de link */
                color: #f8f9f7; /* define a cor do texto */
                font-size: 2rem; /* define o tamanho da fonte em rem para responsividade */
                margin-left: 30px; /* define a margem esquerda entre os itens */
                padding: 6px 10px; /* define o padding de 6px top e botton e 10px left e right */
                font-family: Arial, Helvetica, sans-serif ; /* define a fonte dos links */
            }
            nav ul li a:hover{ /* estilização da animação de hover  */
                background-color: rgba(255, 255, 255, 0.356); /* define a cor do efeito ao passar o mouse sobre os links  */
                transition: 0.3s; /* define o tmepo do efeito de cor do hover */
                border-radius: 5px; /* define a curvatura da borda do efeito hover */
            }
            @media(max-width: 990px){ /* define estilização do header quando a tela tiver 990px */
                html{ /* estilização do html quando a tela tiver 990px */
                    font-size: 50%; /* define o tamanho da fonte do header em 50% quando a tela tiver 990px */
                }
                .logo img{ /* estilização do tamanho da logo quando a tela tiver 990px*/
                    width: 85%; 
                }
            }
            @media(max-width: 850px){ /*  define estilização do header quando a tela tiver850px */ 
                html{ /* estilização do html quando a tela tiver 850px */
                    font-size: 45%; /* define o tamanho da fonte do header em 45% quando a tela tiver 850px */
                }
                
            }
            @media(max-width: 790px){ /*  define estilização do header quando a tela tiver 790px */
                header nav{ /* /* estilização do nav quando a tela chegar em 790px */ 
                display: none; /* oculta os itens da barra de navegação do header quando a tela chegar 790px*/
                }
                .one,
                .two,
                .three{ /* estilização das barras usadas no menu expansivo'modelo de haburguer' */
                    background-color: white; /* define a cor das barras do menu expansivo */
                    height: 5px;  /* define a altura das barras do menu expansivo  */
                    width: 100%; /* define a largura das barras do menu expansivo*/
                    margin: 6px auto; /*  */
                    transition-duration: 0.3s; /* define o tempo da animação das barras do menu expansivo depois do click */
                }
                .menu-burguer{ /* estilização do menu expansivo modelo de hamburguer */
                    width: 40px; /* define a largura do menu expansivo */
                    height: 30px; /* define a altura do menu exoansivo */
                } 
                .menu-section.on{ /* estilização do menu que mostrara os itens que estavam ocultos */
                    position: absolute; /* define a posição do elemento em qualquer lugar da tela */
                    top: 0; /* define o recuo superior em 0 */
                    left: 0; /* define o recuo esquerdo em 0 */
                    width: 100vw; /* define a largura em 100vw, toda a largura da tela */
                    height: 100vh; /* define a altura em 100vh, todaa altura da tela */
                    background-color: #7AC2C3;
                    display: flex; /* alinha os item em linha */
                    justify-content: center; /* posiciona os item ao centro do eixo x*/
                    align-items: center; /* posiciona os item ao centro do eixo y */
                    z-index: 12; /* define a profundidade do menu */
                }
                .menu-section.on nav{ /* estilização da nav om o menu expansivo ativo */
                    display: block; /* faz com que o conteudo dos itens ocultos voltem a aparecer */
                }
                .menu-section.on .menu-burguer{ /* estilização do icone do menu depois de ativo */
                    position: absolute; /* define a posição do menu depois de ativo */
                    right: 20px; /* define o recuo direito em 20px */ 
                    top: 20px; /* define o recuo superior em 20px */
                }
                .menu-section.on .menu-burguer .one{ /* estilização da primeira barra do menu depois de ativo */
                    transform: rotate(45deg) translate(7px, 7px); /* move a barra do icone do menu para a diagonal depois de ativo */
                }
                .menu-section.on .menu-burguer .two{ /* estilização da segunda barra do menu depois de ativo */
                    opacity: 0; /* oculta a segunda barra do icone do menu depois de ativo */
                }
                .menu-section.on .menu-burguer .three{ /* estilização da terceira barra do menu depois de ativo */
                    transform: rotate(-45deg) translate(9px, -9px); /* move a barra do icone do menu para a diagonal depois de ativo */
                }
                .menu-section.on nav ul{ /* estilização da lista depois do menu depois de ativo */
                    display: block; /* faz com que os item da lista fiquem alinhadosna vertical, um abaixo do outro */
                    text-align: center; /* alinha os itens da lista no centro */
                }
                .menu-section.on nav ul li a{ /* estilização dos links dos itens no menu depois de ativo */
                    transition-duration: 0.3s; /* define o tempo do efeito hover */
                    font-size: 3rem; /* define o tamanho da fonte em rem para responsividade */
                    line-height: 10rem; /* define o tamanho da linha */
                    margin-left: 0; /* define a margem esquerda em 0 */
                }    
            }
            .banner{
                width: 100%; /*Define o tamanho da area do banner */
                height: 800px; /*Define o tamanho da altura do banner*/
                position: fixed; /*Define como elemento pode ser posicionado no documento */
                background: url(../imagem/bn3.jpg) no-repeat center/cover;
                margin-top: 80px;
            }
            .info{
                width: 100%;/*Define a largura do elemento*/
                height: 550px; /*Define a altura em px*/
                position: relative; /*Define como elemento pode ser posicionado no documento */
                top: 350px; /*Define o*/
                background: #ffffff; /*Define a cor de fundo*/
                opacity: 0.9;  
            }
            nav button {
                position: relative;
                top: 0;
                width: 100%;
                text-align: center;
            }            
            .info nav ul{ /* estilização da lista de itens do nav */
                display: flex; /* alinhao a lista de itens na horizontal */
                padding: 0;
            }
            .info ul{
                margin: auto;
            }
            .info li{ /* estilização da lista de itens */
                list-style: none; /* oculta os icones/pontos padroes dos itens de lista */
            }
            .info nav ul li button{ /* estilização da tag a*/
                text-decoration: none; /* retira a decoração de link */
                color: #003029; /* define a cor do texto */
                font-size: 1.8rem; /* define o tamanho da fonte em rem para responsividade */
                margin-left: 20px; /* define a margem esquerda entre os itens */
                padding: 6px 10px; /* define o padding de 6px top e botton e 10px left e right */
                font-family: Arial, Helvetica, sans-serif ; /* define a fonte dos links */
                margin: 10px auto;
                border-radius: 5px;
                border: none;
            }
            .info nav ul li button:hover{ /* estilização da animação de hover  */
                background-color: #003029e7; /* define a cor do efeito ao passar o mouse sobre os links  */
                transition: 0.3s; /* define o tmepo do efeito de cor do hover */
                border-radius: 5px; /* define a curvatura da borda do efeito hover */
                color: #f8f9f7;
            }
            .tabs section {
                display: none;
                width: 70%;
                margin: 0 auto;
            }
            section.tabActive{
                display: block; 
            }
            .tabs a{
                text-decoration: none;
                font-size: 1.8rem; /* define o tamanho da fonte em rem para responsividade */
                margin-left: 20px; /* define a margem esquerda entre os itens */
                padding: 6px 10px; /* define o padding de 6px top e botton e 10px left e right */
                font-family: Arial, Helvetica, sans-serif ; /* define a fonte dos links */
                background-color: #e0e0e086;
                border-radius: 5px;
            }
            .tabs a:hover{
                background-color: #003029e7; /* define a cor do efeito ao passar o mouse sobre os links  */
                transition: 0.3s; /* define o tmepo do efeito de cor do hover */
                border-radius: 5px; /* define a curvatura da borda do efeito hover */
                color: #f8f9f7;
            }
            footer{
                bottom: 0;
                position: fixed;
                background-color: #266566;
                width: 100%;
            }
            footer p{
                color: white;
                text-align: center;
                font-size: 1.5rem;
            }
        </style>
    </head>
    
    <body>
        <header>           
            <div class="container"> <!-- div principal -->
                <div class="logo"> <!-- div com a classe logo -->
                    <img src="../imagem/LogoHeaderMini.png" alt="Logo da E2V Clínica Médica">                  
                </div>
        
                <div class="menu-section"> <!-- classe que é responsavel pela barra de navegação -->
                    <div class="menu-burguer"> <!-- define a classe menu-burguer para o formato do menu expansivo -->
                        <div class="one"></div> <!-- div que representa a primeira barra do menu expansivo -->
                        <div class="two"></div> <!-- div que representa a segunda barra do menu expansivo -->
                        <div class="three"></div> <!-- div que representa a terceira barra do menu expansivo-->
                    </div>
        
                    <nav> <!-- barra de navegação -->
                        <ul> <!-- lista com opçoes da barra de navegação -->
                            <li><a id="sair-button" href="../PaginaLogin/logout.php">Sair</a></li> <!-- link para ir a pagina de login da clinica -->
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main>
            <div class="banner"></div>

            <div class="info">
                <nav class="container"> <!-- barra de navegação -->
                    <ul class="row"> <!-- lista com opçoes da barra de navegação -->
                        <li class="col-md-2"><button>Cadastro de Funcionário</button></li>
                        <li class="col-md-2"><button>Cadastro de Paciente</button></li>
                        <li class="col-md-2"><button>Listagem Funcionários</button></li>
                        <li class="col-md-2"><button>Listagem Pacientes</button></li>
                        <li class="col-md-2"><button>Listagem Endereços</button></li>
                        <li class="col-md-2"><button>Listar Todos Agendamentos</button></li>
                    </ul>
                </nav>

                <div class = "tabs">
                    <section>
                        <h2>Cadastro de novo Funcionário</h2>
                        <p>Nesta página é possível cadastrar um novo funcionário a Clínica Médica</p>
                        <p>Para realizar o cadastro de um novo funcionário, clique no link abaixo e realize o cadastro dos dados.</p> 
                        <p><a href="../PaginaCadFunc/index.html">Cadastro de Novo Funcionário</a></p>     
                    </section>
                    <section>
                        <h2>Cadastro de novo Paciente</h2>
                        <p>Nesta página é possível cadastrar um novo paciente na E2V Clínica Médica</p>
                        <p>Para realizar o cadastro de um novo paciente, clique no link abaixo e realize o cadastro dos dados.</p>
                        <p><a href="../PaginaCadPaciente/index.php">Cadastro de Novo Paciente</a></p>
                    </section>
                    <section>
                        <h2>Listagem dos Funcionários</h2>
                        <p>Nesta página é possível encontrar a listagem dos funcionários cadastrados na E2V Clínica Médica.</p>
                        <p>Para visualizar a listagens dos dados, acesse o link abaixo.</p>
                        <p><a href="../ListagemFunc/index.php">Listagem dos Funcionários</a></p>
                    </section>
                    <section>
                        <h2>Listagem dos Pacientes</h2>
                        <p>Nesta página é possível encontrar a listagem dos pacientes cadastrados na E2V Clínica Médica.</p>
                        <p>Para visualizar a listagens dos dados, acesse o link abaixo.</p>
                        <p><a href="../ListagemPac/index.php">Listagem dos Pacientes</a></p>
                    </section>
                    <section>
                        <h2>Listegem dos Endereços</h2>
                        <p>Nesta página é possível encontrar a listagem dos endereços cadastrados na E2V Clínica Médica.</p>
                        <p>Para visualizar a listagens dos dados, acesse o link abaixo.</p>
                        <p><a href="../ListagemEnd/index.php">Listegem dos Endereços</a></p>
                    </section>
                    <section>
                        <h2>Listagem de todos os Agendamentos de Consultas</h2>
                        <p>Nesta página é possível encontrar a listagem de todos os agendamentos de consultas da E2V Clínica Médica.</p>
                        <p>Para visualizar a listagens dos dados, acesse os links abaixo.</p>
                        <p><a href="../ListagemAgend/index.php">Listagem de todos os Agendamentos</a></p>
                        
                        <div class="agendMed">
                            <?php
                                $pdo = mysqlConnect();

                                try {

                                $sql = <<<SQL
                                SELECT p.email, p.codigo
                                FROM medico m, pessoa p
                                WHERE p.codigo = m.codigo
                                SQL;
                            
                                $stmt = $pdo->query($sql);
                                } 
                                catch (Exception $e) {
                                    exit('Ocorreu uma falha: ' . $e->getMessage());
                                }
                                $result_ok = '';
                                $emails = '';
                                $emailLog = '';
                                $emailLog = $_SESSION['emailUsuario'];
                                while ($row = $stmt->fetch()) {                                    
                                    $emails = htmlspecialchars($row['email']);              
                                    if($emails == $emailLog){ 
                                        $result_ok = true;
                                    }
                                }
                                
                                if($result_ok == true){
                                echo<<<HTML
                                    <p><a href="../ListagemAgendMed/index.php">Listagem dos Meus Agendamentos</a></p>
                                    <p>Neste link é possível visualizar a listagens dos meus agendamentos de consultas da E2V Clínica Médica.</p>
                                HTML;
                                }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </main>

        <script>  
            let show = true //inicializa o show como true
            const menuSection = document.querySelector(".menu-section") // busca na div menu-section e armazena na variavel menuSection
            const menuBurguer = menuSection.querySelector(".menu-burguer") // busca na menuSection e armazena na variavel menuBurguer

             menuBurguer.addEventListener("click", () =>{ //crição do evento de click no menuBurguer e dispara a função
            menuSection.classList.toggle("on", show) //menuSection adciona uma lista de classe "on" atraves da função toggle(função de adicionar e retirar do js)
            show = !show //atualiza o show apos o click, fazendo o valor dele se alterar
            })
        </script>

        <script>
            window.onload = function () { //execução de funções anonimas que vao ser executadas quando os botões para troca das abas forem acionados
                buttons = document.querySelectorAll("nav button"); //seleção de todos os boteos que aparecem na barra de navegação
                for (let button of buttons) {
                    button.addEventListener("click", changeTab); // função que muda a 'tab' de acordo com o click do usuario usando a função changeTab
                }
                openTab(0); // a função 'openTab abre a a section correspondente ao indice especificado 
            }
    
            function changeTab(e) { //a função 'changeTab' tem o papel de encontra o item de lista dentro da lista usando o parametro 'e' para obter detalhes do evento
                const botaoAcionado = e.target; // a propriedade 'e.target' permite saber qual foi o botao que foi disparado e ativou a chamada da função 'changeTab'
                const liDoBotao = botaoAcionado.parentNode; //a propriedade 'parentNode' da acesso ao no referente ao li; a variavel liDoBotao representa o no do botao, e 'liDoBotao.parentNode' da acesso ao nó do pai do li, ou seja, 'ul'
                const nodes = Array.from(liDoBotao.parentNode.children); // acessando o nó com '.children' da acesso a todos os nós filhos do 'ul', e o array permite converter a lista de elementos 'li' em um correspondente vetor
                const index = nodes.indexOf(liDoBotao); // metodo 'indexOf' permite saber qual a posição do 'li' em particular dentro da lista
                openTab(index); //o index(indice) que da a posição do 'li' dentro da lista é usado para chamar a função 'openTab'
            }
    
            function openTab(i) { // a função torna visivel o 'section' correspondente aquele indice  
                const tabActive = document.querySelector(".tabActive"); // faz com que a tab que esta sendo exibida fique oculta fazendo uma busca pela classe 'tabActive'
                if (tabActive !== null) // se o retorno da 'querySelector' do elemento 'tabActive' é diferente de 'null', remove a classe 
                tabActive.className = ""; // a classe tabActive é removida do section e assim ele se torna oculto
    
                const buttonActive = document.querySelector(".buttonActive"); //o botao que esta ativo no momento 
                if (buttonActive !== null) // se o retorno da 'querySelector' do elemento 'buttonActive' é diferente de 'null', remove a classe
                    buttonActive.className = ""; //a classe 'buttonActive' é removida do botão e ele passa a ficar desativado
    
                document.querySelectorAll(".tabs section")[i].className = "tabActive"; // o 'querSelectorAll' seleciona todas seções dentro do 'div', e o indice é usado para selecionar a seção em particular, e a propriedade 'className' recebe o novo valor de 'tabActive', o tornando visivel
                document.querySelectorAll("nav button")[i].className = "buttonActive"; // o 'querSelectorAll' seleciona todas seções dentro do menu de navegação, e o indice é usado para selecionar o botao em particular, e a propriedade 'className' recebe o novo valor de 'buttonActive', dexando-o com a cor azul e sublinhado
            }
        </script>
        
        <script>
            var botaoSair = document.getElementById("sair-button");
            botaoSair.onclick = function () {
                var confirmacao = confirm("Deseja realmente sair?");
                if(confirmacao==true)
                    window.location.href = "../PaginaLogin/index.html";
            }
        </script>

        <footer>
            <p>© Copyright 2021. Todos os direitos reservados. Vinícius Alves, Vinícius Adriano e Estevão Filipe.</p>
        </footer>
    </body>
</html>