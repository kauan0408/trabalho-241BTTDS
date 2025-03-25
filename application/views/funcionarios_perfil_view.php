<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=], initial-scale=1.0">
	<title>perfil</title>
</head>
<style>
        /* Estilo geral da página */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: ffffff;
            margin: 0;
            padding: 0;
        }

        /* Estilização do menu de navegação */
        .navbar {
            background-color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar a {
            text-decoration: none;
            color: black;
            margin: 0 15px;
            font-weight: bold;
        }

        .navbar .logo {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar .menu {
            display: flex;
            align-items: center;
        }

        /* Estilização do cabeçalho principal */
        .header {
            background: url('fundo-azul.png') no-repeat center center;
            background-size: cover;
            padding: 50px;
            color: black;
        }

        .header h1 {
            font-size: 28px;
        }

        /* Botão de navegação */
        .botao {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #79b9ff;
            color: #003366;            
            text-decoration: none;
            border-radius: 5px;
        }

        /* Área de produtos */
        .produtos {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
        }

        /* Primeira camiseta grande e isolada */
        .produto.grande {
            flex: 1 1 40%;
            max-width: 40%;
        }

        /* Grupo das duas últimas camisetas e legenda */
        .grupo {
            display: flex;
            flex-direction: column;
            flex: 1 1 50%;
            max-width: 50%;
        }

        /* Ajuste para as duas últimas camisetas */
        .grupo .produto {
            display: flex;
            flex: 1;
            justify-content: center;
            max-width: 100%;
        }

        /* Ajuste nas imagens */
        .produto img {
            width: 100%;
            border-radius: 5px;
        }

        /* Centralizar a legenda abaixo das duas camisetas */
        .descricao {
            text-align: center;
             /* Tamanho da fonte menor */
            font-size: 10px;
            margin-top: 10px;
            padding: 10px;
            max-width: 100%;
            /* Cor um pouco mais suave */
            color: #555; 
        }       

        .secao-acreditamos {
            display: flex;
            align-items: flex-start;
            max-width: 900px;
            margin: 0 auto;
            /* Espaço entre título e parágrafos */
            gap: 40px; 
        }

        .secao-acreditamos h2 {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            /* Define um tamanho fixo para o título */
            width: 200px; 
            text-align: left;
            /* Evita que ele diminua */
            flex-shrink: 0; 
}

        .secao-acreditamos .meus-paragrafos {
            flex: 1;
            max-width: 600px;
            /* Justifica o texto */
            text-align: justify; 
            /* Dá mais espaço entre as linhas */
            line-height: 1.6; 

        }

        .secao-acreditamos p {
            /* Espaço entre os parágrafos */
            margin-bottom: 15px; 
            color: #333;
        }
    </style>
</head>
<body>

    <!-- Barra de navegação superior -->
    <div class="navbar">
        <div class="logo">olá <?= $this->session->userdata('nome'); ?></div>
        <div class="menu">
            <a href="deslogar">Sair do sistema</a>
			<?php if ($this->session->userdata('tipo') == 'gestor') { ?><?php } ?> 
            <a href="funcionarios">Lista de funcinarios</a>
            <a href="#">Meu Perfil</a>
        </div>
    </div>

        <!-- Cabeçalho principal da página -->
        <div class="header">
            <br/><br/><br/>
            <h1>Bem-vindo à NekoPrint - O Paraíso das <br/> Camisetas de Anime Personalizadas!</h1>
            <br/><br/>
            <a href="#" class="botao">Navegue em nossa loja</a>
            <br/><br/>
        </div>

    <div class="container">
        <div class="produtos">
            <!-- Primeira camiseta sozinha -->
            <div class="produto grande">
                <img src="camiseta1.jpg" alt="Camiseta com estampa de anime roxa">
            </div>

            <!-- Contêiner para as duas últimas camisetas -->
            <div class="grupo">
                <div class="produto">
                    <img src="camiseta2.jpg" alt="Camiseta com estampa de personagem de cabelo branco">
                </div>
                <div class="produto">
                    <img src="camiseta3.jpg" alt="Camiseta preta com arte sombria">
                </div>

                <!-- Descrição dos produtos -->
                <p class="descricao">
                    Camiseta estilosa e confortável, feita com tecido macio e respirável. 
                    Possui estampa de alta qualidade, garantindo durabilidade e estilo.
                </p>
            </div>
        </div>
        <br/><br/><br/>

        <!-- Seção de informações sobre a loja -->
        <div class="secao-acreditamos">
    <h2>NO QUE ACREDITAMOS</h2>
    <div class="meus-paragrafos">
        <p>
            Se você é um verdadeiro fã de anime e quer expressar sua paixão com autenticidade, 
            a NekoPrint é o lugar perfeito para você! Nossa loja online oferece camisetas de alta 
            qualidade com estampas exclusivas, inspiradas nos animes mais icônicos e nos 
            personagens que marcaram gerações.
        </p>
        <p>
            Aqui, unimos conforto, durabilidade e um design incrível para que você possa vestir 
            seu anime favorito com orgulho. Nossas camisetas são feitas com materiais premium e 
            estampas vibrantes, garantindo um visual estiloso e duradouro.
        </p>
        <p>
            Seja para colecionar, presentear ou simplesmente adicionar um toque otaku ao seu dia a dia, 
            na NekoPrint você encontra as melhores opções. Explore nossa coleção e leve a 
            cultura anime para o seu guarda-roupa!
        </p>
    </div>
</div>   
    </div>
</body>
</html>