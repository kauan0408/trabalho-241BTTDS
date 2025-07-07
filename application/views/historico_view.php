<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Compras</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css') ?>">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('public\assets\css\historico.css') ?>" />
</head>
<body>

    <div id="particles-js"></div>

    <style>
    /* Particles.js Background */
    #particles-js {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;
        background-color: #e3f2fd; /* Fundo azul clarinho */
    }
    </style>

    <button class="elemento" onclick="window.history.back()">
        <img src="<?= base_url('public/assets/imgens/voltar.png') ?>" alt="Voltar" width="30">
    </button>

<div class="container">
    <h1>Histórico de Compras</h1>

    <?php if (empty($compras)): ?>
        <p>Nenhuma compra registrada.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Funcionário</th>
                    <th>Roupa</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Data da Compra</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compras as $compra): ?>
                <tr>
                    <td><?= htmlspecialchars($compra['nome_funcionario']) ?></td>
                    <td><?= htmlspecialchars($compra['nome_roupa']) ?></td>
                    <td><?= (int)$compra['quantidade'] ?></td>
                    <td>R$ <?= number_format($compra['preco'], 2, ',', '.') ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($compra['data_compra'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

    <script>
    particlesJS('particles-js',
    {
    "particles": {
        "number": {
        "value": 150,
        "density": {
            "enable": true,
            "value_area": 900
        }
        },
        "color": {
        "value": ["#90caf9", "#42a5f5", "#64b5f6", "#1e88e5", "#1565c0"]
        },
        "shape": {
        "type": "edge", // 🔷 Retângulos/quadrados
        "stroke": {
            "width": 0,
            "color": "#000000"
        },
        },
        "opacity": {
        "value": 0.7,
        "random": true
        },
        "size": {
        "value": 12,
        "random": true
        },
        "line_linked": {
        "enable": false // ❌ Sem linhas ligando, fica mais limpo
        },
        "move": {
        "enable": true,
        "speed": 2,
        "direction": "none",
        "random": true,
        "straight": false,
        "out_mode": "out",
        "bounce": false
        }
    },
    "interactivity": {
        "detect_on": "canvas",
        "events": {
        "onhover": {
            "enable": true,
            "mode": "repulse" // 🚫 Afasta quando passa o mouse
        },
        "onclick": {
            "enable": true,
            "mode": "push" // ➕ Adiciona quadradinhos ao clicar
        },
        "resize": true
        },
        "modes": {
        "repulse": {
            "distance": 100,
            "duration": 0.4
        },
        "push": {
            "particles_nb": 4
        }
        }
    },
    "retina_detect": true
    });
    </script>

</body>
</html>
