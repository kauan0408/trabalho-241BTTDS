<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagen de Funcionários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Listagem de funcionarios</h1>
        <a href="adicionar-funcionario"><button class="btn btn-primary my-3">Adicionar</button></a>
        <table class="table table-striped small mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Cpf</th>
                    <th>Cargo</th>
                    <th>Setor</th>
                    <th>Email</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($funcionarios as $funcionario) { ?>
                <tr>
                    <td><?= $funcionario['id'] ?></td>
                    <td><?= $funcionario['nome'] ?></td>
                    <td><?= $funcionario['cpf'] ?></td>
                    <td><?= $funcionario['cargo'] ?></td>
                    <td><?= $funcionario['setor'] ?></td>
                    <td><?= $funcionario['email'] ?></td>
                    <td>
                        <a href="editar-funcionario?id=<?= $funcionario['id'] ?>">
                            <button class="btn btn-warning btn-sm">Editar</button>
                        </a>
                        <button onclick="apagar_funcionario(<?= $funcionario['id'] ?>)" class="btn btn-danger btn-sm">Apagar</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
         const apagar_funcionario = (id) => {
            Swal.fire({
                title: "Você tem certeza?",
                text: "Essacação não podera ser revertida",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "apagar"
              }).then((result) => {
                if (result.isConfirmed) {
                  // criar rota para apagar
                  window.location.href = 'deletar-funcinario?id=${id}';
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>