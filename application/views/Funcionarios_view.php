<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagen de Funcionários</title>
    <style>
        /* Estilos gerais da página */
        body {
            font-family: Arial, sans-serif; /* Define a fonte do texto */
            background-color: #e3f2fd; /* Cor de fundo da página */
            color: #0d47a1; /* Cor do texto */
            margin: 0; /* Remove margens padrão */
            padding: 0; /* Remove preenchimento padrão */
        }

        /* Contêiner principal da página */
        .wrapper {
            width: 80%; /* Define a largura do contêiner */
            margin: 20px auto; /* Centraliza o contêiner horizontalmente */
            background: #bbdefb; /* Define a cor de fundo */
            padding: 20px; /* Adiciona preenchimento interno */
            border-radius: 10px; /* Arredonda os cantos */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Adiciona uma sombra sutil */
        }

        /* Cabeçalho principal */
        .header {
            display: flex; /* Usa flexbox para alinhar elementos */
            justify-content: space-between; /* Distribui os elementos horizontalmente */
            align-items: center; /* Centraliza os itens verticalmente */
            background: #0d47a1; /* Define a cor de fundo */
            color: white; /* Define a cor do texto */
            padding: 15px; /* Adiciona preenchimento interno */
            border-radius: 10px; /* Arredonda os cantos */
        }

        .header span {
            font-size: 20px; /* Define o tamanho da fonte */
            font-weight: bold; /* Define o texto como negrito */
        }

        .header a button {
            background: #1e88e5; /* Define a cor de fundo do botão */
            color: white; /* Define a cor do texto */
            border: none; /* Remove a borda padrão */
            padding: 10px 15px; /* Define preenchimento interno */
            cursor: pointer; /* Muda o cursor ao passar por cima */
            border-radius: 5px; /* Arredonda os cantos do botão */
            transition: 0.3s; /* Adiciona efeito de transição */
        }

        .header a button:hover {
            background: #1565c0; /* Muda a cor do botão ao passar o mouse */
        }

        /* Estilos para a tabela */
        .table {
            width: 100%; /* Define a largura total */
            border-collapse: collapse; /* Remove os espaços entre as bordas */
            margin-top: 20px; /* Adiciona espaçamento acima da tabela */
        }

        .table th, .table td {
            border: 1px solid #90caf9; /* Define a cor e espessura da borda */
            padding: 10px; /* Adiciona preenchimento interno */
            text-align: left; /* Alinha o texto à esquerda */
        }

        .table th {
        background: #42a5f5; /* Cor de fundo dos cabeçalhos */
        color: white; /* Cor do texto dos cabeçalhos */
        }

        .table tr:nth-child(even) {
            background: #e3f2fd; /* Define uma cor diferente para linhas pares */
        }

        /* Estilos para botões de ação */
        .btn-warning {
            background: #ffb300; /* Cor de fundo do botão de aviso */
            color: white; /* Cor do texto */
            border: none; /* Remove a borda */
            padding: 5px 10px; /* Define preenchimento interno */
            border-radius: 5px; /* Arredonda os cantos */
            cursor: pointer; /* Muda o cursor ao passar por cima */
        }

        .btn-danger {
            background: #d32f2f; /* Cor de fundo do botão de perigo */
            color: white; /* Cor do texto */
            border: none; /* Remove a borda */
            padding: 5px 10px; /* Define preenchimento interno */
            border-radius: 5px; /* Arredonda os cantos */
            cursor: pointer; /* Muda o cursor ao passar por cima */
        }

        /* Estilos para o modal */
        .modal-wrapper {
            display: none; /* Inicialmente oculto */
            position: fixed; /* Fixa o modal na tela */
            top: 0; /* Define a posição no topo */
            left: 0; /* Define a posição à esquerda */
            width: 100%; /* Ocupa toda a largura da tela */
            height: 100%; /* Ocupa toda a altura da tela */
            background: rgba(0, 0, 0, 0.5); /* Adiciona fundo escuro semi-transparente */
            justify-content: center; /* Centraliza o modal */
            align-items: center; /* Centraliza o modal verticalmente */
        }

        .modal {
            background: white; /* Define o fundo branco para o modal */
            padding: 20px; /* Adiciona preenchimento interno */
            border-radius: 10px; /* Arredonda os cantos do modal */
            width: 300px; /* Define a largura do modal */
        }

        .modal input {
            width: 100%; /* Define a largura total */
            padding: 8px; /* Adiciona preenchimento interno */
            margin: 5px 0; /* Adiciona espaçamento entre inputs */
            border: 1px solid #90caf9; /* Define a borda */
            border-radius: 5px; /* Arredonda os cantos */
        }

        .modal button {
            width: 100%; /* Define a largura total do botão */
            padding: 10px; /* Adiciona preenchimento interno */
            margin-top: 10px; /* Adiciona espaçamento superior */
            border: none; /* Remove a borda */
            background: #1e88e5; /* Define a cor de fundo */
            color: white; /* Define a cor do texto */
            cursor: pointer; /* Muda o cursor ao passar por cima */
            border-radius: 5px; /* Arredonda os cantos */
            transition: 0.3s; /* Adiciona transição suave */
        }

        .modal button:hover {
            background: #1565c0; /* Muda a cor do botão ao passar o mouse */
        }


        .modal button:hover {
            background: #1565c0;
        }

</style>

</head>
<body>
<!-- HTML e PHP -->
<div class="wrapper">
    <!-- Cabeçalho com o título e o botão para adicionar um novo funcionário -->
    <div class="header">
        <span>Cadastro de Funcionários</span>  <!-- Título da página -->
        
        <!-- Botão para abrir o modal de adição de funcionário -->
        <a href="adicionar-funcionario"> <button onclick="" >Adicionar</button></a>  <!-- Botão para adicionar funcionário -->
    </div>
    </div>

    <!-- Seção para exibir a tabela de funcionários -->
    <div class="header-info">
        <table class="table table-striped small mt-3">
            <thead>
                <!-- Cabeçalhos das colunas da tabela -->
                <tr>
                    <th>#</th>       <!-- Coluna para o ID do funcionário -->
                    <th>Nome</th>    <!-- Coluna para o nome do funcionário -->
                    <th>Cpf</th>     <!-- Coluna para o CPF do funcionário -->
                    <th>Cargo</th>   <!-- Coluna para o cargo do funcionário -->
                    <th>Setor</th>   <!-- Coluna para o setor do funcionário -->
                    <th>Email</th>   <!-- Coluna para o email do funcionário -->
                    <th class="acao">Editar</th>  <!-- Coluna para o botão de editar -->
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
                        
                        <!-- Coluna para editar e excluir -->
                        <td>
                            <!-- Link para editar o funcionário, passando o ID na URL -->
                            <a href="editar-funcionario?id=<?= $funcionario['id'] ?>">
                                <button class="btn btn-warning btn-sm">Editar</button>
                            </a>
                        </td>
                        <td>
                            <!-- Botão para apagar o funcionário, chama a função 'apagar_funcionario' com o ID -->
                            <button onclick="apagar_funcionario(<?= $funcionario['id'] ?>)" class="btn btn-danger btn-sm">Apagar</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para adicionar ou editar um funcionário -->
    <div class="modal-wrapper" id="modal-wrapper">
        <div class="modal">
            <!-- Formulário para adicionar ou editar funcionário -->
            <form action="salvar-funcionario" method="POST" id="form-funcionario">
                <label for="m-nome">Nome</label>
                <input id="m-name" name="nome" type="text" required />
                
                <label for="m-cpf">CPF</label>
                <input id="m-cpf" name="cpf" type="text" required />
                
                <label for="m-cargo">Cargo</label>
                <input id="m-cargo" name="cargo" type="text" required />
                
                <label for="m-setor">Setor</label>
                <input id="m-setor" name="setor" type="text" required />
                
                <label for="m-email">Email</label>
                <input id="m-email" name="email" type="email" required />
                
                <button id="btn-salvar" type="submit">Salvar</button>
                <button type="button" onclick="closeModal()">Cancelar</button>
            </form>
        </div>
    </div>

</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript -->
<script>
    // Função para abrir o modal de cadastro
    function openModal() {
        document.getElementById('modal-wrapper').style.display = 'block';
    }

    // Função para fechar o modal
    function closeModal() {
        document.getElementById('modal-wrapper').style.display = 'none';
    }

    // Função para confirmar e apagar um funcionário
    const apagar_funcionario = (id) => {
        // SweetAlert2 para confirmação de exclusão
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
                // Caso a confirmação seja positiva, redireciona para a rota de exclusão
                window.location.href = `deletar-funcionario?id=${id}`;
            }
        });
    }
</script>

</body>
</html>