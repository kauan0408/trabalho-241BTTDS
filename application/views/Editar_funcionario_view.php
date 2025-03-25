<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar funcionario</title>
    <style>
        /* Paleta de tons de azul */
        :root {
            --azul-escuro: #003366;
            --azul-medio: #0066cc;
            --azul-claro: #66ccff;
            --azul-pastel: #99c2ff;
            --azul-ciano: #00b3b3;
        }

        /* Corpo da página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: var(--azul-pastel);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--azul-escuro);
            text-align: center;
        }

        .form-label {
            color: var(--azul-escuro);
            font-weight: bold;
        }

        .form-control, .form-select {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid var(--azul-medio);
            border-radius: 5px;
            background-color: var(--azul-claro);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--azul-escuro);
            background-color: #fff;
        }

        .btn {
            background-color: var(--azul-ciano);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: var(--azul-medio);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .col-12 {
            flex: 1 1 100%;
        }

        .col-md-6 {
            flex: 1 1 48%;
        }

        .mt-3 {
            margin-top: 20px;
        }
    </style>
</style>
</head>
<body>
    <div class="container">
        <h1>Aqui vai o formulário para editar funcionário</h1>
        <form action="editar-funcionario" method="post">
            <div class="row">
                <input type="hidden" name="id" value="<?= $funcionario['id'] ?>">
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="nome">Nome</label>
                    <input class="form-control" required type="text" placeholder="nome" name="nome" value="<?= $funcionario['nome'] ?>" id="nome">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="cargo">Cargo</label>
                    <input class="form-control" required type="text" placeholder="cargo" name="cargo" value="<?= $funcionario['cargo'] ?>" id="cargo">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="setor">Setor</label>
                    <input class="form-control" required type="text" placeholder="setor" name="setor" value="<?= $funcionario['setor'] ?>" id="setor">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="cpf">CPF</label>
                    <input class="form-control" required type="text" placeholder="cpf" name="cpf" value="<?= $funcionario['cpf'] ?>" id="cpf">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" required type="email" placeholder="email" name="email" value="<?= $funcionario['email'] ?>" id="email">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="telefone">Telefone</label>
                    <input class="form-control" type="text" placeholder="telefone" name="telefone" value="<?= $funcionario['telefone'] ?>" id="telefone">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="senha">Senha</label>
                    <input class="form-control" required type="text" placeholder="senha" name="senha" value="<?= $funcionario['senha'] ?>" id="senha">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="tipo">Tipo</label>
                    <select class="form-select" required name="tipo" id="tipo" onchange="mostrarTipo()">
                        <option value="gestor">Gestor</option>
                        <option value="comum">Comum</option>
                    </select>
                </div>
            </div>
            <button class="btn mt-3" type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>