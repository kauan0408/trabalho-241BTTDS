<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar funcionario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Aqui vai o formulario para adicionar funcionario</h1>
        <form action="adicionar-funcionario" method='post'>
            <div class="row">
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="nome">Nome</label>
                    <input class="form-control" required type="text" placeholder="nome" name="nome" id="nome">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="cargo">Cargo</label>
                    <input class="form-control" required type="text" placeholder="cargo" name="cargo" id="cargo">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="setor">Setor</label>
                    <input class="form-control" required type="text" placeholder="setor" name="setor" id="setor">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="cpf">CPF</label>
                    <input class="form-control" required type="text" placeholder="cpf" name="cpf" id="cpf">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" required type="email" placeholder="email" name="email" id="email">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="telefone">Telefone</label>
                    <input class="form-control" type="text" placeholder="telefone" name="telefone" id="telefone">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="senha">Senha</label>
                    <input class="form-control" required type="text" placeholder="senha" name="senha" id="senha">
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <label class="form-label" for="tipo">Tipo</label>
                    <select class="form-select" required name="tipo" id="tipo">
                        <option value="comun">Comun</option>
                        <option value="gestor">Gestor</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary mt-3" type="submit">Enviar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>