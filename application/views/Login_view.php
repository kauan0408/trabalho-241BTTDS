<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(45deg, #064f77, #007fff);
        }
        
        /*body{
        a imagem de fundo não está funcionando
            font-family: Arial, Helvetica, sans-serif;
            background-image: url(../img/trabalho.jpeg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }*/

        div{
            background-color: #a3d3f5;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 50px;
            border-radius: 10px;
            color: #fff;
        }
        input{
            padding: 15px;
            border: none;
            outline: none;
            border-radius: 10px;
            font-size: 15px;
        }
        .button{
            background-color: #3973b5;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            
        }
    </style>  
</head>
<body>
<div>
    <form action="login" method="POST">
        <input name="email" type="email" placeholder="E-mail:" autofocus="true" />
        <br><br><br>
        <input name="senha" type="password" placeholder="Senha:" />
        <br><br><br>
        <input class="button" type="submit" value="Login" />
    </form>
</div>
    <!-- não sei como conequitar o codigo
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
         const apagar_funcionario = (id) =>
         Swal.fire({
                  title: "senha ou gamil invalido",
                  title: "Por favor, tente novamente",
                  icon: "error",
                  draggable: true
                })
    </script>-->
</body>
</html>