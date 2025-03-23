<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=], initial-scale=1.0">
	<title>perfil</title>
</head>
<body>
	<h1>olá <?= $this->session->userdata('nome'); ?></h1>
	<a href="deslogar">
	<button>Sair do sistema</button><br><br>
    </a>
	<?php if ($this->session->userdata('tipo') == 'gestor') { ?>
		<a href="funcionarios">
			<button>Lista de funcinarios</button>
        </a>
	<?php } ?> 
	
</body>
</html>