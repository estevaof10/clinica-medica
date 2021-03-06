<?php

require_once "../conectaMySQL.php";
require_once "../PaginaLogin/autentica.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" 
            crossorigin="anonymous">

        <title>Listagem Funcionários - E2V Clínica Médica</title> 
        <link rel="icon" href="../imagem/E2V-title.png">

        <style>
            *{
                margin: 0; /* define a margem de todo o codigo em 0 */
                padding: 0; /* define o padding de todo o codigo em 0 */
                outline: 0; /* define o outline de todo o codigo em 0 */
                box-sizing: border-box; /* define o tamanho do elemento ate a borda,o width sera a soma do conteudo com a borda e o padding */
            }
            html{ /* stilização do html */
                font-size: 62.5%; /* define o tamanho da fonte do codigo para que a cada 1rem seja considerado 10px */
            }
            body{ /* estilização do body */
                font-size: 1.6rem; /* define o tamanho da fonte do body em rem para responsividade */
            }
            body, html{
                width: 100vw;
                height: 100%;
                background: linear-gradient(90deg, #d7fffa 20%,#1d858c 80%);
                overflow: auto;
            }
            /* ---------------------------NAVBAR ------------------------------*/
            header{
                background-color: #7AC2C3; /* define a cor do background*/
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
                nav{ /* /* estilização do nav quando a tela chegar em 790px */ 
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
                    background: linear-gradient(150deg,#86fff1 10%,#003029 90%);
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
            h2{ /* estilização do titulo */
                margin-top: 30px; /* define a margem top/recuo superior */
                color: white; /* define a cor do titulo */
                text-shadow: 0px 0px 5px #004e53; /* define a cor do estlo de sombra das letras */
                text-align: center; /* define a posição do titulo no centro */
                font-size: 30px;
            }
            p{ /* estilizção do paragrafo */
                text-align: center; /* define a posição do texto no centro */
                color: black; /* define a cor da fonte */
                font-size: 18px; /* defiune o tamanho da fonte */
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* define a fonte do texto */
            }
            footer{
                bottom: 0;
                position: absolute;
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
                            <li><a href="../PaginaHomeRestrita/index.php">Home</a></li> <!-- link pra voltar a home da clinica-->
                            <li><a id="sair-button" href="../PaginaLogin/logout.php">Sair</a></li> <!-- link para ir a pagina de login da clinica -->
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        
        <div class="container">
            <main>
                <h2>Listagem dos Funcionários</h2>
                <p>Segue abaixo a listagem com as informações dos funcionários já cadastrados</p>
                <table class="tabela-exibicao table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Sexo</th>
                            <th>CEP</th>
                            <th>Logradouro</th>
                            <th>Estado</th>
                            <th>Cidade</th>
                            <th>Início de Contrato</th>
                            <th>Salário</th>                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $pdo = mysqlConnect();

                            try {
                                $sql = <<<SQL
                                    SELECT pessoa.nome, pessoa.email, pessoa.telefone, pessoa.sexo, 
                                        pessoa.cep, pessoa.logradouro, pessoa.estado, pessoa.cidade,
                                        funcionario.dataContrato, funcionario.salario, funcionario.senhaHash,
                                        funcionario.codigo
                                    FROM pessoa, funcionario
                                    WHERE pessoa.codigo = funcionario.codigo
                                SQL;

                                $stmt = $pdo->query($sql);
                            } 
                            catch (Exception $e) {
                                exit('Erro ao executar seleção! ' . $e->getMessage());
                            }

                            while ($row = $stmt->fetch()) {                                    
                                $nome = htmlspecialchars($row['nome']);
                                $email = htmlspecialchars($row['email']);
                                $telefone = htmlspecialchars($row['telefone']);
                                $cep = htmlspecialchars($row['cep']);
                                $logradouro = htmlspecialchars($row['logradouro']);
                                $cidade = htmlspecialchars($row['cidade']);
                                $salario = htmlspecialchars($row['salario']);
                                $data = new DateTime($row['dataContrato']);
                                $data_contrato = $data->format('d/m/Y');

                                echo <<<HTML
                                    <tr>
                                        <td>{$row['codigo']}</td>                       
                                        <td>$nome</td> 
                                        <td>$email</td>
                                        <td>$telefone</td>
                                        <td>{$row['sexo']}</td>
                                        <td>$cep</td>
                                        <td>$logradouro</td>
                                        <td>{$row['estado']}</td>
                                        <td>$cidade</td>                                    
                                        <td>$data_contrato</td>            
                                        <td>$salario</td>                  
                                    </tr>
                                HTML;
                            }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>

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