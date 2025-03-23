<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagen de Funcionários</title>
</head>
<body>
    <h1>Listagem de funcionarios</h1>
   <table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Cargo</th>
            <th>Setor</th>
            <th>Email</th>
        </tr>
    </thead>
<tbody>
    <?php foreach($funcionarios as $funcionario) { ?>
    <tr>
        <td><?= $funcionario['nome']?></td>
        <td><?= $funcionario['nome']?></td>
        <td>Professor</td>
        <td>Proz</td>
        <td>durvaldomarques@gmail.com</td>
        <td>
            <button>Editar</button>
            <button>Apagar</button>
        </td>
    </tr>
    <?php } ?>
</tbody>
</table>
</body>
</html>