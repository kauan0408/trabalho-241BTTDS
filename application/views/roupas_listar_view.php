<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Roupas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('public/assets/css/roupas.css') ?>" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
</head>
<body>

<div id="particles-js"></div>

<style>
    #particles-js {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;
        background-color: #e3f2fd;
    }
</style>

<div class="container">

    <button class="elemento" onclick="window.history.back()">
        <img src="<?= base_url('public/assets/imgens/voltar.png') ?>" alt="Voltar" width="30">
    </button>

    <h2 class="text-center">Roupas Cadastradas</h2>

    <!-- Botão que abre o modal de Adição -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionar">Adicionar Nova Roupa</button>
    <br><br>

    <!-- Modal de Adicionar Roupa -->
    <div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('index.php/roupas-admin/adicionar') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="modalAdicionarLabel">Adicionar Nova Roupa</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Nome da Roupa:</label>
                            <input type="text" name="nome" id="nome" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="colecao">Coleção:</label>
                            <input type="text" name="colecao" id="colecao" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="preco">Preço:</label>
                            <input type="number" name="preco" id="preco" class="form-control" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="estoque">Estoque:</label>
                            <input type="number" name="quantidade" id="quantidade" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="imagem">Imagem:</label>
                            <input type="file" name="imagem" id="imagem" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if (!empty($roupas)) : ?>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Coleção</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Imagem</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roupas as $roupa) : ?>
                    <tr>
                        <td><?= $roupa['nome'] ?></td>
                        <td><?= $roupa['colecao'] ?></td>
                        <td>R$ <?= number_format($roupa['preco'], 2, ',', '.') ?></td>
                        <td><?= (int)$roupa['estoque'] ?> un</td>
                        <td>
                            <img src="<?= base_url('public/assets/imgens/' . $roupa['imagem']) ?>" alt="<?= $roupa['nome'] ?>" style="height: 60px;">
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar<?= $roupa['id'] ?>">Editar</button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="confirmarExclusao(event, this)" data-url="<?= base_url('roupas-admin/excluir/' . $roupa['id']) ?>">Excluir</button>
                        </td>
                    </tr>

                    <!-- Modal de Edição -->
                    <div class="modal fade" id="modalEditar<?= $roupa['id'] ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="post" action="<?= base_url('index.php/roupas/editar/' . $roupa['id']) ?>">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Editar Roupa</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nome:</label>
                                            <input type="text" name="nome" class="form-control" value="<?= $roupa['nome'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Coleção:</label>
                                            <input type="text" name="colecao" class="form-control" value="<?= $roupa['colecao'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Estoque:</label>
                                            <input type="number" name="estoque" class="form-control" value="<?= $roupa['estoque'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Preço:</label>
                                            <input type="text" name="preco" class="form-control" value="<?= $roupa['preco'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Imagem (nome do arquivo):</label>
                                            <input type="text" name="imagem" class="form-control" value="<?= $roupa['imagem'] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="text-center">Nenhuma roupa cadastrada.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($this->session->flashdata('sucesso')) : ?>
<script>
    Swal.fire({
        icon: 'success',
        text: '<?= $this->session->flashdata('sucesso') ?>',
        confirmButtonColor: '#3085d6'
    });
</script>
<?php endif; ?>

<script>
function confirmarExclusao(event, element) {
    event.preventDefault();
    const url = element.getAttribute('data-url');

    Swal.fire({
        title: "Tem certeza?",
        text: "Você não poderá reverter esta ação!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, excluir!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Excluído!",
                text: "O item foi removido com sucesso.",
                icon: "success",
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = url;
            });
        }
    });
}
</script>

<script>
particlesJS('particles-js', {
    "particles": {
        "number": {
            "value": 150,
            "density": { "enable": true, "value_area": 900 }
        },
        "color": { "value": ["#90caf9", "#42a5f5", "#64b5f6", "#1e88e5", "#1565c0"] },
        "shape": {
            "type": "edge",
            "stroke": { "width": 0, "color": "#000000" }
        },
        "opacity": { "value": 0.7, "random": true },
        "size": { "value": 12, "random": true },
        "line_linked": { "enable": false },
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
            "onhover": { "enable": true, "mode": "repulse" },
            "onclick": { "enable": true, "mode": "push" },
            "resize": true
        },
        "modes": {
            "repulse": { "distance": 100, "duration": 0.4 },
            "push": { "particles_nb": 4 }
        }
    },
    "retina_detect": true
});
</script>

</body>
</html>
