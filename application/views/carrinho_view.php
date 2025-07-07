<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Carrinho de Compras</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    
  <!-- Seu CSS separado -->
  <link rel="stylesheet" href="<?= base_url('public\assets\css\carrinho.css') ?>">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<?php if ($this->session->userdata('tipo') == 'gestor') : ?>
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

<header>
  <div class="navbar">
    <div class="left-group">
      <button class="elemento" onclick="window.history.back()">
        <img src="<?= base_url('public/assets/imgens/voltar.png') ?>" alt="Voltar" />
      </button>
      <div class="logo">NekoPrint</div>
    </div>

    <div class="menu">
      <?php if ($this->session->userdata('tipo') == 'gestor') : ?>
        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalGestor">Acesso do Gestor</button>
      <?php endif; ?>

      <a href="<?= base_url('perfil') ?>" class="sair-sistema">Quem somos</a>
      <a href="<?= base_url('meu-perfil') ?>" class="sair-sistema">Meu perfil</a>
      <a href="<?= base_url('roupas') ?>" class="sair-sistema">Compra</a>
    </div>
  </div>
</header>

<!-- Canvas para fundo animado -->
<canvas id="hexCanvas"></canvas>

<!-- Título Carrinho -->
<div class="titulo-carrinho">
    <h1>Carrinho</h1>
    <span class="contador"><?= isset($totalItensCarrinho) ? $totalItensCarrinho : 0 ?></span>
    <span class="itens-texto">itens</span>
</div>

<?php if (!empty($itens)): ?> 
<div class="row">
  <div class="col-md-8">
    <table class="table">
        <div class="produtos-container">
        <?php foreach ($itens as $item): 
            $valor_total = $item['preco'] + $item['frete'];
        ?>
            <div class="produto-card">
            <img src="<?= base_url('public/assets/imgens/' . $item['imagem']) ?>" class="produto-img" alt="<?= $item['nome'] ?>">
            
            <div class="produto-info">
                <div class="produto-nome"><?= $item['nome'] ?></div>
                <div class="produto-precos">
                <span class="preco-final">Preço: R$ <?= number_format($item['preco'], 2, ',', '.') ?></span>
                <span class="frete">Frete: R$ <?= number_format($item['frete'], 2, ',', '.') ?></span>
                <span class="quantidade">Qtd: <?= $item['quantidade'] ?></span>
                </div>
            </div>

            <div class="produto-lado-direito">
            <?php
                $subtotal = $item['preco'] * $item['quantidade'];
                $frete = 3 * $item['quantidade'];
                $total_item = $subtotal + $frete;
            ?>
            <div class="valor-total">
                Total: R$ <?= number_format($total_item, 2, ',', '.') ?>
            </div>
            <a href="<?= base_url('remover/' . $item['id']) ?>" class="btn btn-danger btn-xs">Remover</a>
            </div>
            </div>
        <?php endforeach; ?>
</div>
    </table>
  </div>
  <div class="col-md-4">
    <div class="resumo">
        <h4>Resumo do pedido</h4>
        <p><strong>Valor das roupas:</strong><br>R$ <?= number_format($total, 2, ',', '.') ?></p>
        <p><strong>Total dos fretes:</strong><br>R$ <?= number_format($total_frete, 2, ',', '.') ?></p>
        <hr>
        <h5><strong>Total a pagar:</strong><br>R$ <?= number_format($total_geral, 2, ',', '.') ?></h5>

        <a href="<?= base_url('finalizar-compra') ?>" class="btn btn-primary btn-block mt-4">
            Continuar para o pagamento
        </a>
    </div>
  </div>
</div>
<?php else: ?>
    <p class="text-center">Seu carrinho está vazio.</p>
<?php endif; ?>

<?php if ($msg = $this->session->flashdata('alerta')): ?>
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: '<?= addslashes($msg) ?>',
        showConfirmButton: false,
        timer: 1500
    });
</script>
<?php endif; ?>

<!-- Scripts bootstrap/jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Script dos hexágonos animados -->
<script>
  const canvas = document.getElementById('hexCanvas');
  const ctx = canvas.getContext('2d');

  function resize() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }
  resize();
  window.addEventListener('resize', resize);

  class Hexagono {
    constructor(x, y, size, dx, dy, color) {
      this.x = x;
      this.y = y;
      this.size = size;
      this.dx = dx;
      this.dy = dy;
      this.color = color;
    }
    desenhar() {
      const angle = Math.PI / 3;
      ctx.beginPath();
      for (let i = 0; i < 6; i++) {
        const vx = this.x + this.size * Math.cos(angle * i);
        const vy = this.y + this.size * Math.sin(angle * i);
        if (i === 0) {
          ctx.moveTo(vx, vy);
        } else {
          ctx.lineTo(vx, vy);
        }
      }
      ctx.closePath();
      ctx.fillStyle = this.color;
      ctx.fill();
      ctx.strokeStyle = '#1565c0'; // Contorno azul escuro
      ctx.stroke();
    }
    atualizar(hexagonos) {
      this.x += this.dx;
      this.y += this.dy;

      // Bater nas bordas
      if (this.x - this.size < 0 || this.x + this.size > canvas.width) {
        this.dx *= -1;
      }
      if (this.y - this.size < 0 || this.y + this.size > canvas.height) {
        this.dy *= -1;
      }

      // Colisão com outros hexágonos
      for (let outro of hexagonos) {
        if (this === outro) continue;
        const dist = Math.hypot(this.x - outro.x, this.y - outro.y);
        if (dist < this.size * 2) {
          // Troca simples de direção
          const tempDx = this.dx;
          const tempDy = this.dy;
          this.dx = outro.dx;
          this.dy = outro.dy;
          outro.dx = tempDx;
          outro.dy = tempDy;
        }
      }
      this.desenhar();
    }
  }

  const cores = ["#90caf9", "#42a5f5", "#64b5f6", "#1e88e5", "#1565c0"];
  const hexagonos = [];

  for (let i = 0; i < 15; i++) {
    const size = 80;
    let x = Math.random() * (canvas.width - size * 2) + size;
    let y = Math.random() * (canvas.height - size * 2) + size;
    const dx = (Math.random() - 0.5) * 3;
    const dy = (Math.random() - 0.5) * 3;
    const color = cores[Math.floor(Math.random() * cores.length)];

    // Evitar sobreposição inicial
    if (hexagonos.length > 0) {
      for (let j = 0; j < hexagonos.length; j++) {
        const dist = Math.hypot(x - hexagonos[j].x, y - hexagonos[j].y);
        if (dist < size * 2) {
          x = Math.random() * (canvas.width - size * 2) + size;
          y = Math.random() * (canvas.height - size * 2) + size;
          j = -1;
        }
      }
    }

    hexagonos.push(new Hexagono(x, y, size, dx, dy, color));
  }

  function animar() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    hexagonos.forEach(h => h.atualizar(hexagonos));
    requestAnimationFrame(animar);
  }

  animar();
</script>

</body>
</html>
