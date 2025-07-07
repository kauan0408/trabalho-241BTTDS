<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Cadastro</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('public\assets\css\login.css') ?>" />

    <style>
        /* Fundo da página */
        body {
            background-image: url(<?= base_url('public/assets/imgens/trabalho.jpg') ?>);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>

    <!-- Cabeçalho com logo e botão 'Quem somos' -->
    <div class="header">
        <div class="logo">NekoPrint</div>
        <a href="<?= base_url('perfil') ?>" class="menu">Quem somos</a>
    </div>

    <!-- Caixa do formulário -->
    <div class="teste">
        <!-- Login -->
        <form action="<?= base_url('auth_controller/logar') ?>" method="POST" class="form-box active" id="loginForm">
            <input type="email" name="email" placeholder="E-mail:" required>
            <input type="password" name="senha" placeholder="Senha:" required>
            <input type="submit" value="Login" class="button">
            <span class="toggle-link" onclick="toggleForms()">Não tem conta? Cadastre-se</span>
        </form>

        <!-- Cadastro -->
        <form action="<?= base_url('auth_controller/cadastrar') ?>" method="POST" class="form-box" id="cadastroForm">
            <input type="text" name="nome" placeholder="Nome completo" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" value="Cadastrar" class="button">
            <span class="toggle-link" onclick="toggleForms()">Já tem conta? Fazer login</span>
        </form>

    </div>

<!-- Adicione no final da sua view login_view -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Função para trocar o formulário
  function toggleForms() {
    document.getElementById("loginForm").classList.toggle("active");
    document.getElementById("cadastroForm").classList.toggle("active");
  }

  // Login via AJAX
  document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('<?= base_url("auth_controller/logar") ?>', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if(data.status === 'erro') {
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: data.mensagem,
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Login feito com sucesso!",
          showConfirmButton: false,
          timer: 1500
        }).then(() => {
          window.location.href = '<?= base_url("perfil") ?>'; // Redireciona após sucesso
        });
      }
    })
    .catch(() => {
      Swal.fire('Erro', 'Falha na comunicação com o servidor', 'error');
    });
  });

  // Cadastro via AJAX
  document.getElementById('cadastroForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('<?= base_url("auth_controller/cadastrar") ?>', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if(data.status === 'erro') {
        Swal.fire({
          position: "top-end",
          icon: "error",
          title: data.mensagem,
          showConfirmButton: false,
          timer: 1500
        });

        if(data.tipoErro === 'email_duplicado') {
          if(!document.getElementById('cadastroForm').classList.contains('active')) {
            toggleForms();
          }
        }
      } else {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Cadastro feito com sucesso!",
          showConfirmButton: false,
          timer: 1500
        }).then(() => {
          window.location.href = '<?= base_url("perfil") ?>'; // Redireciona após sucesso
        });
      }
    })
    .catch(() => {
      Swal.fire('Erro', 'Falha na comunicação com o servidor', 'error');
    });
  });
</script>


</body>
</html>
