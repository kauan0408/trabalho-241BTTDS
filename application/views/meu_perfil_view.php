<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - NekoPrint</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Seu CSS -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/meu_perfil.css') ?>" />
</head>

<body>

<!-- Partículas -->
<div id="particles-js"></div>

<style>
#particles-js {
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: -1;
    top: 0;
    left: 0;
}
</style>

<!-- Navbar -->
<header>
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
            <a href="<?= base_url('perfil') ?>" class="sair-sistema">Quem somos</a>
            <a href="<?= base_url('roupas') ?>" class="sair-sistema">Compra</a>
            <a href="<?= site_url('carrinho') ?>" class="carrinho">Carrinho (<?= total_itens_carrinho() ?>)</a>
        </div>
    </div>
</header>

<!-- Modal do Gestor -->
<?php if ($this->session->userdata('tipo') == 'gestor') : ?>
<div class="modal fade" id="modalGestor" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#0d47a1; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Acesso Rápido do Gestor</h4>
            </div>
            <div class="modal-body" style="background-color: #e3f2fd;">
                <a href="<?= base_url('funcionarios') ?>" class="btn btn-primary btn-block">Lista de Funcionários</a>
                <a href="<?= base_url('roupa_list') ?>" class="btn btn-primary btn-block">Lista de Roupas</a>
                <a href="<?= base_url('historico-compras') ?>" class="btn btn-primary btn-block">Histórico de compras</a>
            </div>
            <div class="modal-footer" style="background-color: #bbdefb;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Conteúdo do Perfil -->
<div class="container">
    <h2>Meu Perfil</h2>
    <form action="<?= base_url('meu-perfil') ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <label>Nome</label>
                <input class="form-control" type="text" name="nome" value="<?= $funcionario['nome'] ?>" required>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input class="form-control" type="email" name="email" value="<?= $funcionario['email'] ?>" required>
            </div>
            <div class="col-md-6">
                <label>Rua</label>
                <input class="form-control" type="text" name="rua" value="<?= $funcionario['rua'] ?>" required>
            </div>
            <div class="col-md-6">
                <label>Número</label>
                <input class="form-control" type="text" name="numero" value="<?= $funcionario['numero'] ?>" required>
            </div>
            <div class="col-md-6">
                <label>Complemento</label>
                <input class="form-control" type="text" name="complemento" value="<?= $funcionario['complemento'] ?>">
            </div>
            <div class="col-md-6">
                <label>Bairro</label>
                <input class="form-control" type="text" name="bairro" value="<?= $funcionario['bairro'] ?>" required>
            </div>
            <div class="col-md-6">
                <label>Cidade</label>
                <input class="form-control" type="text" name="cidade" value="<?= $funcionario['cidade'] ?>" required>
            </div>
            <div class="col-md-6">
                <label>Estado</label>
                <input class="form-control" type="text" name="estado" value="<?= $funcionario['estado'] ?>" required>
            </div>
            <div class="col-md-6">
                <label>CPF</label>
                <input class="form-control" type="text" name="cpf" value="<?= $funcionario['cpf'] ?>" required>
            </div>
            <div class="col-md-6">
                <label>Telefone</label>
                <input class="form-control" type="text" name="telefone" value="<?= $funcionario['telefone'] ?>" required>
            </div>
            <div class="col-md-6">
                <label>CEP</label>
                <input class="form-control" type="text" name="cep" value="<?= $funcionario['cep'] ?>" required>
            </div>
        </div>

        <br>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Atualizar</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= base_url('deslogar') ?>'">Sair do sistema</button>
            <button type="button" onclick="apagar_meu_perfil(this)" class="btn btn-danger" data-url="<?= base_url('meu-perfil/apagar') ?>">
                Apagar minha conta
            </button>
        </div>
    </form>
</div>

    <!-- seu conteúdo aqui -->

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

<!-- Script para apagar conta -->
<script>
function apagar_meu_perfil(element) {
    const url = element.getAttribute('data-url');
    Swal.fire({
        title: 'Tem certeza?',
        text: "Esta ação vai apagar sua conta e não poderá ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, apagar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>

<!-- Flashdata -->
<?php if ($msg = $this->session->flashdata('alerta')): ?>
<script>
Swal.fire({
    title: 'Atenção!',
    text: '<?= addslashes($msg) ?>',
    confirmButtonText: 'OK',
    confirmButtonColor: '#3085d6'
});
</script>
<?php endif; ?>

<!-- Configuração do Particles.js -->
<script>
particlesJS('particles-js', {
  "particles": {
    "number": { "value": 80 },
    "color": { "value": "#003366" }, // azul escuro
    "shape": {
      "type": "line", // formato pauzinho
      "stroke": { "width": 1, "color": "#003366" }
    },
    "opacity": { "value": 0.6 },
    "size": { "value": 2 },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#003366",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 2,
      "direction": "none",
      "straight": false
    }
  },
  "interactivity": {
    "events": {
      "onhover": { "enable": true, "mode": "grab" },
      "onclick": { "enable": true, "mode": "push" }
    },
    "modes": {
      "grab": { "distance": 200, "line_linked": { "opacity": 0.6 } }
    }
  },
  "retina_detect": true
});
</script>

</body>
</html>
