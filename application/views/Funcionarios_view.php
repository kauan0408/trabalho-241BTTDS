<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagen de Funcionários</title>

    <!-- Bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('public/assets/css/funcionarios.css') ?>" />

    <!-- jQuery completo para Bootstrap 3 -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap 3 JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    

</head>
<body>
    
    <?php 
        // Pega dados da sessão usando o CodeIgniter
        $usuario_id = $this->session->userdata('id');
        $usuario_tipo = $this->session->userdata('tipo');
    ?>

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

<div class="fundo-rotacionado"></div>

<div class="container">

    <!-- Botão Voltar -->
    <button class="elemento" onclick="window.history.back()">
        <img src="<?= base_url('public/assets/imgens/voltar.png') ?>" alt="Voltar" width="30">
    </button>

    <h2 class="text-center">Cadastro de Funcionários</h2>

    <!-- Botão que abre o modal de adicionar -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#adicionar">Adicionar Funcionário</button>

    <br><br>

    <!-- Modal de Adicionar Funcionário -->
    <div class="modal fade" id="adicionar" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="adicionar-funcionario" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Adicionar Funcionário</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Formulário -->
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cargo">Cargo:</label>
                            <input type="text" name="cargo" id="cargo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="setor">Setor:</label>
                            <input type="text" name="setor" id="setor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF:</label>
                            <input type="text" name="cpf" id="cpf" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" name="telefone" id="telefone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="text" name="senha" id="senha" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="rua">Rua:</label>
                            <input type="text" name="rua" id="rua" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="numero">Número:</label>
                            <input type="text" name="numero" id="numero" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="complemento">Complemento:</label>
                            <input type="text" name="complemento" id="complemento" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro:</label>
                            <input type="text" name="bairro" id="bairro" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade:</label>
                            <input type="text" name="cidade" id="cidade" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <input type="text" name="estado" id="estado" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cep">CEP:</label>
                            <input type="text" name="cep" id="cep" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo:</label>
                            <select name="tipo" id="tipo" class="form-control" required>
                                <option value="gestor">Gestor</option>
                                <option value="comum">Comum</option>
                            </select>
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

    <!-- Seção para exibir a tabela de funcionários -->
    <div id="teste" class="header-info">
        <table class="table table-striped small mt-3">
            <thead>
                <!-- Cabeçalhos das colunas da tabela -->
                <tr>
                    <th>#</th> <!-- Coluna para o ID do funcionário -->
                    <th>Nome</th> <!-- Coluna para o nome do funcionário -->
                    <th>CPF</th> <!-- Coluna para o CPF do funcionário -->
                    <th>Cargo</th> <!-- Coluna para o cargo do funcionário -->
                    <th>Setor</th> <!-- Coluna para o setor do funcionário -->
                    <th>Email</th> <!-- Coluna para o email do funcionário -->
                    <th>Rua</th> <!-- Coluna para a rua do endereço -->
                    <th>Número</th> <!-- Coluna para o número da residência -->
                    <th>Complemento</th> <!-- Coluna para o complemento do endereço -->
                    <th>Bairro</th> <!-- Coluna para o bairro -->
                    <th>Cidade</th> <!-- Coluna para a cidade -->
                    <th>Estado</th> <!-- Coluna para o estado -->
                    <th>CEP</th> <!-- Coluna para o código postal (CEP) -->
                    <th class="acao">Editar</th> <!-- Coluna para o botão de editar -->
                    <th class="acao">Excluir</th> <!-- Coluna para o botão de excluir -->
                </tr>
            </thead>
            <tbody>
                <!-- Loop PHP para exibir os dados dos funcionários -->
                <?php foreach($funcionarios as $funcionario) { ?>
                    <tr>
                            <!-- Exibe o ID do funcionário -->
                            <td><?= $funcionario['id'] ?></td>

                            <!-- Exibe o nome do funcionário -->
                            <td><?= $funcionario['nome'] ?></td>

                            <!-- Exibe o CPF do funcionário -->
                            <td><?= $funcionario['cpf'] ?></td>

                            <!-- Exibe o cargo do funcionário -->
                            <td><?= $funcionario['cargo'] ?></td>

                            <!-- Exibe o setor do funcionário -->
                            <td><?= $funcionario['setor'] ?></td>

                            <!-- Exibe o email do funcionário -->
                            <td><?= $funcionario['email'] ?></td>

                            <!-- Exibe a rua do endereço do funcionário -->
                            <td><?= $funcionario['rua'] ?></td>

                            <!-- Exibe o número da residência do funcionário -->
                            <td><?= $funcionario['numero'] ?></td>

                            <!-- Exibe o complemento do endereço do funcionário -->
                            <td><?= $funcionario['complemento'] ?></td>

                            <!-- Exibe o bairro do funcionário -->
                            <td><?= $funcionario['bairro'] ?></td>

                            <!-- Exibe a cidade do funcionário -->
                            <td><?= $funcionario['cidade'] ?></td>

                            <!-- Exibe o estado do funcionário -->
                            <td><?= $funcionario['estado'] ?></td>

                            <!-- Exibe o CEP do funcionário -->
                            <td><?= $funcionario['cep'] ?></td>

                            <!-- Coluna para editar e excluir -->
                            <td>
                        <!-- Link para editar o funcionário, passando o ID na URL -->
                               
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar<?= $funcionario['id'] ?>">
                                Editar
                            </button>
                            <!-- Modal -->
                            <!-- Modal de Edição de Funcionário -->
                            <div class="modal fade" id="editar<?= $funcionario['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel<?= $funcionario['id'] ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="editar-funcionario" method="post" name="formEditarFuncionario">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Editar Funcionário</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Campos com ID únicos -->
                                                <input type="hidden" name="id" value="<?= $funcionario['id'] ?>">

                                                <div class="form-group">
                                                    <label for="nome_<?= $funcionario['id'] ?>">Nome</label>
                                                    <input type="text" name="nome" class="form-control" id="nome_<?= $funcionario['id'] ?>" value="<?= $funcionario['nome'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cargo_<?= $funcionario['id'] ?>">Cargo</label>
                                                    <input type="text" name="cargo" class="form-control" id="cargo_<?= $funcionario['id'] ?>" value="<?= $funcionario['cargo'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="setor_<?= $funcionario['id'] ?>">Setor</label>
                                                    <input type="text" name="setor" class="form-control" id="setor_<?= $funcionario['id'] ?>" value="<?= $funcionario['setor'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cpf_<?= $funcionario['id'] ?>">CPF</label>
                                                    <input type="text" name="cpf" class="form-control" id="cpf_<?= $funcionario['id'] ?>" value="<?= $funcionario['cpf'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email_<?= $funcionario['id'] ?>">Email</label>
                                                    <input type="email" name="email" class="form-control" id="email_<?= $funcionario['id'] ?>" value="<?= $funcionario['email'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="telefone_<?= $funcionario['id'] ?>">Telefone</label>
                                                    <input type="text" name="telefone" class="form-control" id="telefone_<?= $funcionario['id'] ?>" value="<?= $funcionario['telefone'] ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="senha_<?= $funcionario['id'] ?>">Senha</label>
                                                    <input type="text" name="senha" class="form-control" id="senha_<?= $funcionario['id'] ?>" value="<?= $funcionario['senha'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="rua_<?= $funcionario['id'] ?>">Rua</label>
                                                    <input type="text" name="rua" class="form-control" id="rua_<?= $funcionario['id'] ?>" value="<?= $funcionario['rua'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="numero_<?= $funcionario['id'] ?>">Número</label>
                                                    <input type="text" name="numero" class="form-control" id="numero_<?= $funcionario['id'] ?>" value="<?= $funcionario['numero'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="complemento_<?= $funcionario['id'] ?>">Complemento</label>
                                                    <input type="text" name="complemento" class="form-control" id="complemento_<?= $funcionario['id'] ?>" value="<?= $funcionario['complemento'] ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="bairro_<?= $funcionario['id'] ?>">Bairro</label>
                                                    <input type="text" name="bairro" class="form-control" id="bairro_<?= $funcionario['id'] ?>" value="<?= $funcionario['bairro'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cidade_<?= $funcionario['id'] ?>">Cidade</label>
                                                    <input type="text" name="cidade" class="form-control" id="cidade_<?= $funcionario['id'] ?>" value="<?= $funcionario['cidade'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="estado_<?= $funcionario['id'] ?>">Estado</label>
                                                    <input type="text" name="estado" class="form-control" id="estado_<?= $funcionario['id'] ?>" value="<?= $funcionario['estado'] ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="cep_<?= $funcionario['id'] ?>">CEP</label>
                                                    <input type="text" name="cep" class="form-control" id="cep_<?= $funcionario['id'] ?>" value="<?= $funcionario['cep'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="tipo_<?= $funcionario['id'] ?>">Tipo</label>
                                                    <select name="tipo" class="form-control" id="tipo_<?= $funcionario['id'] ?>" required>
                                                        <option value="gestor" <?= $funcionario['tipo'] === 'gestor' ? 'selected' : '' ?>>Gestor</option>
                                                        <option value="comum" <?= $funcionario['tipo'] === 'comum' ? 'selected' : '' ?>>Comum</option>
                                                    </select>
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
                          </a>
                        </td>
                        <td>
                            <?php if ($usuario_tipo === 'gestor' && $usuario_id != $funcionario['id']) : ?>
                                <button onclick="apagar_funcionario(<?= $funcionario['id'] ?>)" class="btn btn-danger btn-sm">Apagar</button>
                            <?php else: ?>
                                <span>---</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript -->
<script>

    // Função para confirmar e apagar um funcionário
const apagar_funcionario = (id) => {
    Swal.fire({
        title: "Você tem certeza?",
        text: "Esta ação não poderá ser revertida",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Apagar"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `deletar-funcionario?id=${id}`;
        }
    });
}

        
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

$(document).ready(function() {
    $('#adicionar form').submit(function(e) {
        e.preventDefault(); // previne submit normal

        var formData = $(this).serialize();

        $.post('<?= base_url("adicionar-funcionario") ?>', formData, function(data) {
            if(data.status === 'erro') {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: data.mensagem,
                    timer: 2500,
                    showConfirmButton: false
                });

                if(data.tipoErro === 'cpf_duplicado') {
                    $('#cpf').focus();
                }

            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: data.mensagem || 'Funcionário adicionado com sucesso!',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    $('#adicionar').modal('hide'); // fecha modal
                    location.reload(); // recarrega a página/lista
                });
            }
        }, 'json').fail(function() {
            Swal.fire('Erro', 'Falha na comunicação com o servidor', 'error');
        });
    });
});

$(document).on('submit', 'form[name="formEditarFuncionario"]', function(e) {
    e.preventDefault();

    var form = $(this);
    var formData = form.serialize();

    $.post('<?= base_url("editar-funcionario") ?>', formData, function(data) {
        if (data.status === 'erro') {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: data.mensagem,
                timer: 2500,
                showConfirmButton: false
            });

            if (data.tipoErro === 'cpf_duplicado') {
                form.find('input[name="cpf"]').focus();
            } else if (data.tipoErro === 'email_duplicado') {
                form.find('input[name="email"]').focus();
            }

        } else {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: data.mensagem || 'Funcionário atualizado com sucesso!',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                form.closest('.modal').modal('hide'); // fecha o modal de edição
                location.reload(); // recarrega a página para atualizar a tabela
            });
        }
    }, 'json').fail(function() {
        Swal.fire('Erro', 'Falha na comunicação com o servidor', 'error');
    });
});

</script>

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