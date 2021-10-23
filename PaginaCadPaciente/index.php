<?php

require_once "../conectaMySQL.php";
require_once "../PaginaLogin/autentica.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" 
            crossorigin="anonymous">
        <title>Cadastro Paciente - E2V Clínica Médica</title> 
        <link rel="icon" href="../imagem/E2V title.png">

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

            .form-select{ /* estilização do input select pela classe */
                margin: 5px 0px 0px; /* define a margen do input select */
            }
            .form-label{ /* estilização do texto identificador pela classe */
                font-size: 15px; /* define o tamanho da fonte */
            }
            .form-control, 
            .form-select{ /* estilização do input select e control pela classe */
                margin-top: 5px; /*  */
                margin-bottom: 5px; /*  */
                padding: 10px; /* define o padding do input */
                border: 1px solid #1d858c; /* define a borda e cor do input */
                min-height: 50px;
                font-size: 15px;
            }
            .form-control:focus,
            .form-select:focus{ /* estilização do focus dos inputs pela classe */ 
                border: 1px solid #1d858c; /*  define a borda do input e a cor*/
                box-shadow: 0px 0px 5px #00ffc8; /* define a sombra da borda do input e cor */
                outline: none; /* retira o contorno do input */
            }

            #inputSexo,
            #inputEstado,
            #inputSangue{ /* estilização dos inputs de data e sexo pelos ids */
                cursor: pointer; /* define o efeito ao passar o mouse sobre os inputs*/
            }
            .btn.btn-primary {
                font-size: 18px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
                background-color: #004e53;  
                padding: 0px;
                margin-bottom: 0;
            }
            footer > p {
                color: white;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                text-align: center;
            }
            .btn.btn-primary {
                font-size: 18px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
                font-size: 18px;
            }
        </style>
    </head> 
    <body>
        <header>           
            <div class="container"> <!-- div principal -->
                <div class="logo"> <!-- div com a classe logo -->
                    <!--<h1>E2V Clinica Medica</h1> -->
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
                            <li><a id="sair-button" href="#">Sair</a></li> <!-- link para ir a pagina de login da clinica -->
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <div class="container">
            <main>
                <h2>Cadastrar Paciente</h2>
                <p>Preencha os campos abaixo com os dados correspondentes ao novo paciente que deseja cadastrar.</p>
                <form method="POST" action="cadPac.php" class="row g-2">
                    <div class="form-floating col-md-12 gy-2">
                        <input type="text" class="form-control" id="inputNome" name="nome" placeholder="">
                        <label for="inputNome" class="form-label">Nome</label>
                    </div>
                    <div class="form-floating col-md-12 gy-2">
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="" autocomplete="off">
                        <label for="inputEmail" class="form-label">Email</label>
                    </div>
                    <div class="form-floating col-md-8 gy-2">
                        <input type="tel" class="form-control" id="inputTelefone" name="telefone" placeholder="">
                        <label for="inputTelefone" class="form-label">Telefone</label>
                    </div>
                    <div class="form-floating col-md-4 gy-2">
                        <select name="sexo" class="form-select" id="inputSexo">
                            <option selected>Selecione</option>
                            <option>Masculino</option>
                            <option>Feminino</option>
                            <option>Outros</option>
                        </select>
                        <label for="inputSexo" class="form-label">Sexo</label>
                    </div>
                    <div class="form-floating col-md-4 gy-2">
                        <input type="text" class="form-control" id="inputCEP" name="cep" placeholder="">
                        <label for="inputCEP" class="form-label">CEP</label>
                    </div>
                    <div class="form-floating col-md-8 gy-2">
                        <input type="text" class="form-control" id="inputLogradouro" name="logradouro" placeholder="">
                        <label for="inputLogradouro" class="form-label">Logradouro</label>
                    </div>
                    <div class="form-floating col-md-4 gy-2">
                        <select name="estado" class="form-select" id="inputEstado">
                            <option selected>Selecione</option>
                            <option>Acre</option>
                            <option>Alagoas</option>
                            <option>Amapá</option>
                            <option>Amazonas</option>
                            <option>Bahia</option>
                            <option>Ceará</option>
                            <option>Distrito Federal</option>
                            <option>Espírito Santo</option>
                            <option>Goiás</option>
                            <option>Maranhão</option>
                            <option>Mato Grosso</option>
                            <option>Mato Grosso do Sul</option>
                            <option>Minas Gerais</option>
                            <option>Pará</option>
                            <option>Paraíba</option>
                            <option>Paraná</option>
                            <option>Pernambuco</option>
                            <option>Piauí</option>
                            <option>Rio de Janeiro</option>
                            <option>Rio Grande do Norte</option>
                            <option>Rio Grande do Sul</option>
                            <option>Rondônia</option>
                            <option>Roraima</option>
                            <option>Santa Catarina</option>
                            <option>São Paulo</option>
                            <option>Sergipe</option>
                            <option>Tocantins</option>
                        </select>
                        <label for="inputEstado" class="form-label">Estado</label>
                    </div>
                    <div class="form-floating col-md-8 gy-2">
                        <input type="text" class="form-control" id="inputCidade" name="cidade" placeholder="">
                        <label for="inputCidade" class="form-label">Cidade</label>
                    </div>
                    <div class="form-floating col-md-4 gy-2">
                        <input type="text" class="form-control" id="inputPeso" name="peso" placeholder="">
                        <label for="inputPeso" class="form-label">Peso (kg)</label>
                    </div>
                    <div class="form-floating col-md-4 gy-2">
                        <input type="text" class="form-control" id="inputAltura" name="altura" placeholder="">
                        <label for="inputAltura" class="form-label">Altura (cm)</label>
                    </div>
                    <div class="form-floating col-md-4 gy-2">
                        <select name="sangue" class="form-select" id="inputSangue">
                            <option selected>Selecione</option>
                            <option>A+</option>
                            <option>A-</option>
                            <option>B+</option>
                            <option>B-</option>
                            <option>AB+</option>
                            <option>AB-</option>
                            <option>O+</option>
                            <option>O-</option>
                        </select>
                        <label for="inputSangue" class="form-label">Tipo Sanguíneo</label>
                    </div>
                    
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Cadastrar
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                            </svg>
                        </button>
                    </div>
                </form>
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

        <!-- <script>
            function enviaFormulario() {
                let meuForm = document.querySelector("form");
                let formData = new FormData(meuForm);
                
                const options = {
                    method: "POST",
                    body: formData
                }
                
                fetch("cadPac.php", options)
                    .then(response => response.json()) 
                    .then(data =>{
                        console.log(data.success);
                        if(data.success == true){
                        meuForm.reset();
                        }else{
                                throw new Error(response.status);
                            }
                            })
                    .catch(error => {
                        console.error(error);
                    })
                }

                window.onload = function () {
                const botao = document.querySelector("#botao");
                botao.onclick = enviaFormulario;
                }
          </script> -->

        <script>
            var botaoSair = document.getElementById("sair-button");
            botaoSair.onclick = function () {
                var confirmacao = confirm("Deseja realmente sair?");
                if(confirmacao==true)
                    window.location.href = "../PaginaLogin/index.html";
            }
        </script>

        <script>
                //Busca cep

                function buscaEndereco(cep) {
                    if (cep.length != 9) return;

                    let xhr = new XMLHttpRequest();
                    xhr.open("GET", "getCep.php?cep=" + cep, true);

                    xhr.onload = function () {
                        if (xhr.status != 200) {
                            console.error("Falha inesperada: " + xhr.responseText);
                            return;
                        }
                        try {
                            var endereco = JSON.parse(xhr.responseText);
                        }
                        catch (e) {
                            console.error("String JSON inválida: " + xhr.responseText);
                            return;
                        }
                        let form = document.querySelector("form");
                        form.logradouro.value = endereco.logradouro;
                        form.cidade.value = endereco.cidade;
                        form.estado.value = endereco.estado;
                    }

                    xhr.onerror = function () {
                        console.error("Erro de rede - requisição não finalizada");
                    };

                    xhr.send();
                }

                window.onload = function(){
                const inputCep = document.querySelector("#inputCEP");
                inputCep.onkeyup = () => buscaEndereco(inputCep.value);
                }

                const botao = document.querySelector("#botao");

        </script>
          
          <div>
            <footer>
                <p>© Copyright 2021. Todos os direitos reservados. Vinícius Alves, Vinícius Adriano e Estevão Filipe.</p>
            </footer>
        </div>
    </body>
</html>