<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Coleção Solo Leveling - NekoPrint</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- Fonte externa -->
    <link href="https://fonts.googleapis.com/css2?family=La+Roche+Serif&display=swap" rel="stylesheet">

    <!-- Seu CSS externo -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/estilos.css') ?>">
</head>
<body>

<!-- Fundo com partículas -->
<div id="particles-js">
  <canvas class="particles-js-canvas-el"></canvas>
</div>  

<?php if ($this->session->userdata('tipo') == 'gestor') : ?>
<!-- Modal de Acesso Rápido para Gestor -->
<div class="modal fade" id="modalGestor" tabindex="-1" role="dialog" aria-labelledby="modalGestorLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalGestorLabel">Acesso Rápido do Gestor</h4>
      </div>
      <div class="modal-body">
        <p><a href="<?= base_url('funcionarios') ?>" class="btn btn-primary btn-block">Lista de Funcionários</a></p>
        <p><a href="<?= base_url('roupa_list') ?>" class="btn btn-primary btn-block">Lista de Roupas</a></p>
        <p><a href="<?= base_url('historico-compras') ?>" class="btn btn-primary btn-block">historico-compras</a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

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

            <a href="<?= base_url('perfil') ?>">Quem somos</a>
            <a href="<?= base_url('meu-perfil') ?>">Meu perfil</a>
            <a href="<?= site_url('carrinho') ?>" class="carrinho">Carrinho (<?= total_itens_carrinho() ?>)</a>
        </div>
    </div>
</header>

<!-- Conteúdo principal -->
<main>

<!-- Importa SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($this->session->flashdata('alerta')): ?>
<script>
Swal.fire({
  position: 'top-end',
  title: '<?= $this->session->flashdata('alerta'); ?>',
  html: `<img src='<?= base_url("public/assets/imgens/shopping-cart.png") ?>' class='animated-cart' alt='Carrinho de compras'>`,
  showConfirmButton: false,
  timer: 1500
});
</script>
<?php endif; ?>

<?php
if (!isset($modo)) {
    echo "<p style='color:red'>ERRO: Variável \$modo não está definida. Usando valor padrão.</p>";
    $modo = 'padrao';
}
?>

<!-- Título da coleção -->
<section class="titulo-colecao">
    <div class="texto-titulo">
        <span class="colecao">COLEÇÃO</span>
        <span class="solo-leveling">solo leveling</span>
    </div>

    <div class="btn-group filtros" role="group" aria-label="Modos de exibição">
        <a href="<?= site_url('roupas?modo=padrao') ?>" class="btn btn-default <?= $modo == 'padrao' ? 'active' : '' ?>">Padrão</a>
        <a href="<?= site_url('roupas?modo=alfabetica') ?>" class="btn btn-default <?= $modo == 'alfabetica' ? 'active' : '' ?>">A-Z</a>
        <a href="<?= site_url('roupas?modo=lista') ?>" class="btn btn-default <?= $modo == 'lista' ? 'active' : '' ?>">Visualização de lista</a>
    </div>
</section>

<!-- Listagem dos produtos -->
<section class="produtos">
    <?php if ($modo === 'padrao' || $modo === 'alfabetica'): ?>
    <div class="row">
        <?php foreach ($roupas as $item): ?>
            <div class="col-md-4 col-sm-6">
                <div class="card-produto">
                    <img src="<?= base_url('public/assets/imgens/' . $item['imagem']) ?>" alt="<?= $item['nome'] ?>" style="width: 100%;">
                    <div class="card-content">
                        <div class="info-texto">
                            <h4><?= $item['nome'] ?></h4>
                            <p>R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
                            <p><small>Coleção: <?= $item['colecao'] ?></small></p>
                        </div>
                        <div class="btn-circular-wrapper">
                            <a href="<?= site_url('roupas/adicionar/' . $item['id']) ?>" class="btn-compra requere-login">
                                <img src="<?= base_url('public/assets/imgens copy/compra.png') ?>" alt="Comprar">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php elseif ($modo === 'lista'): ?>
        <div class="lista-produtos">
        <?php foreach ($roupas as $item): ?>
            <div class="item-lista">
                <img src="<?= base_url('public/assets/imgens/' . $item['imagem']) ?>" alt="<?= $item['nome'] ?>" class="item-imagem">

                <div class="item-info">
                    <h4><?= $item['nome'] ?></h4>
                    <p class="preco">R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
                    <p class="colecao">Coleção: <?= $item['colecao'] ?></p>
                </div>

                <div class="item-botao">
                    <a href="<?= site_url('roupas/adicionar/' . $item['id']) ?>" class="btn-compra requere-login">
                        <img src="<?= base_url('public/assets/imgens copy/compra.png') ?>" alt="Comprar">
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

</main>

<!-- Scripts Bootstrap e jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Script para bloquear cliques se não estiver logado -->
<script>
<?php if (!$this->session->userdata('id')): ?>
    $(document).ready(function(){
        $('.requere-login').click(function(e){
            e.preventDefault();
            window.location.href = "<?= base_url('logar') ?>";
        });
    });
<?php endif; ?>
</script>

<!-- Particles.js -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
  particlesJS('particles-js', {
    "particles": {
      "number": {"value":300,"density":{"enable":true,"value_area":700}},
      "color": {"value":["#a2d2ff","#669bbc","#005f73","#0a9396","#1e6091","#3a86ff"]},
      "shape": {"type":"circle"},
      "opacity": {"value":0.7,"random":true,"anim":{"enable":true,"speed":0.5,"opacity_min":0.3,"sync":false}},
      "size": {"value":5,"random":true},
      "move": {"enable":true,"speed":1.5,"direction":"bottom","random":true,"straight":false,"out_mode":"out","bounce":false}
    },
    "interactivity": {
      "detect_on":"window",
      "events": {
        "onhover": {"enable":true,"mode":"repulse"},
        "onclick": {"enable":false},
        "resize": true
      },
      "modes": {
        "repulse": {"distance":100,"duration":0.4}
      }
    },
    "retina_detect": true
  });
</script>

</body>
</html>
