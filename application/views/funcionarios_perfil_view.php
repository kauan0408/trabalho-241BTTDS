<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Perfil</title>
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= base_url('public/assets/css/funcionarios_perfil.css') ?>" />

</head>
<body>
	<?php if ($this->session->userdata('tipo') == 'gestor') : ?>
		<div id="modalGestor" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Opções do Gestor</h4>
					</div>
					<div class="modal-body">
						<p><a href="<?= base_url('funcionarios') ?>">Lista de funcionários</a></p>
						<p><a href="<?= base_url('roupa_list') ?>">Lista de roupas</a></p>
            <p><a href="<?= base_url('historico-compras') ?>">Histórico de compras</a></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!-- Barra de navegação superior -->
	<div class="navbar">
        <div class="left-group">
            <button class="elemento" onclick="window.history.back()">
                <img src="<?= base_url('public/assets/imgens/voltar.png') ?>" alt="Voltar">
            </button>
            <div class="logo">NekoPrint</div>
        </div>

        <div class="menu">
            <?php if ($this->session->userdata('tipo') == 'gestor') : ?>
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalGestor">Acesso do Gestor</button>
            <?php endif; ?>

            <?php if ($this->session->userdata('id')): ?>
                <a href="<?= base_url('deslogar') ?>" class="sair-sistema">Sair do sistema</a>
            <?php else: ?>
                <a href="<?= base_url('logar') ?>" class="sair-sistema">Logar</a>
            <?php endif; ?>

            <?php if ($this->session->userdata('id')): ?>
                <a href="<?= base_url('meu-perfil') ?>" class="sair-sistema">Meu perfil</a>
            <?php endif; ?>

            <?php if ($this->session->userdata('id')): ?>
                <a href="<?= site_url('carrinho') ?>" class="carrinho">Carrinho (<?= total_itens_carrinho() ?>)</a>
            <?php endif; ?>
        </div>
    </div>

	<!-- Fundo animado bolinhas -->
	<div class="bolinhas"></div>

	<!-- Conteúdo principal -->
	<div class="header">
		<br /><br /><br />
		<h1>Bem-vindo à NekoPrint - O Paraíso das <br /> Camisetas de Anime Personalizadas!</h1>
		<br /><br />
		<a href="<?= base_url('roupas') ?>" class="botao">Navegue em nossa loja</a>
		<br /><br />

		<div class="container">
			<div class="produtos">
				<div class="produto grande">
					<img src="<?= base_url('public/assets/imgens/blusa2.jpeg') ?>" alt="Camiseta com estampa de anime roxa" />
				</div>

				<div class="grupo">
					<div class="linha">
						<div class="produto">
							<img src="<?= base_url('public/assets/imgens/blusa1.jpeg') ?>" alt="Camiseta com estampa de personagem de cabelo branco" />
						</div>
						<div class="produto">
							<img src="<?= base_url('public/assets/imgens/blusa3.jpeg') ?>" alt="Camiseta preta com arte sombria" />
						</div>
					</div>

					<p class="descricao">
						Camiseta estilosa e confortável, feita com tecido macio e respirável. Possui estampa de alta qualidade,
						garantindo durabilidade e estilo.
					</p>
				</div>
			</div>
		</div>

		<br /><br /><br />

		<div class="secao-acreditamos">
			<h2>NO QUE ACREDITAMOS</h2>
			<div class="meus-paragrafos">
				<p>Se você é um verdadeiro fã de anime e quer expressar sua paixão com autenticidade,
					a NekoPrint é o lugar perfeito para você! Nossa loja online oferece camisetas de alta
					qualidade com estampas exclusivas, inspiradas nos animes mais icônicos e
					nos personagens que marcaram gerações.</p>

				<p>Aqui, unimos conforto, durabilidade e um design incrível para que você possa vestir
					seu anime favorito com orgulho. Nossas camisetas são feitas com materiais premium e
					estampas vibrantes, garantindo um visual estiloso e duradouro.</p>

				<p>Seja para colecionar, presentear ou simplesmente adicionar um toque otaku ao seu dia
					a dia, na NekoPrint você encontra as melhores opções. Explore nossa coleção e leve a
					cultura anime para o seu guarda-roupa!</p>
			</div>
		</div>
	</div>

	<!-- JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<!-- Bloqueia cliques se não estiver logado -->
	<script>
		<?php if (!$this->session->userdata('id')) : ?>
			document.addEventListener('DOMContentLoaded', function () {
				const permitido = ['roupas', 'logar'];

				document.querySelectorAll('a, button').forEach(el => {
					const href = el.getAttribute('href');
					const onclick = el.getAttribute('onclick');

					const ehPermitido = (href && permitido.some(p => href.includes(p)))
						|| (onclick && onclick.includes("window.history.back"))
						|| el.getAttribute("data-toggle") === "modal";

					if (!ehPermitido) {
						el.addEventListener('click', function (e) {
							e.preventDefault();
							window.location.href = "<?= base_url('logar') ?>";
						});
					}
				});

				// Bloqueia clique nas imagens
				document.querySelectorAll('img').forEach(img => {
					img.style.cursor = 'pointer';
					img.addEventListener('click', function () {
						window.location.href = "<?= base_url('logar') ?>";
					});
				});
			});
		<?php endif; ?>
	</script>

	<!-- Script para bolinhas caindo no fundo -->
	<script>
		const bolinhasContainer = document.querySelector('.bolinhas');

		for (let i = 0; i < 150; i++) {
			const bolinha = document.createElement('div');
			const tamanho = Math.random() * 8 + 4 + 'px'; // Tamanho entre 4 e 12px
			const left = Math.random() * 100 + 'vw';
			const duracao = Math.random() * 5 + 5 + 's'; // Duração entre 5 e 10s
			const delay = Math.random() * 5 + 's';

			bolinha.classList.add('bolinha');
			bolinha.style.width = tamanho;
			bolinha.style.height = tamanho;
			bolinha.style.left = left;
			bolinha.style.animationDuration = duracao;
			bolinha.style.animationDelay = delay;
			bolinhasContainer.appendChild(bolinha);
		}
	</script>

</body>
</html>
