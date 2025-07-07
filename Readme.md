# 📈 Issues do Projeto - Sistema de Gestão de Treinamentos de Segurança

Cada **issue** representa uma funcionalidade importante e pode ser atribuída a diferentes membros do grupo.

---

## **🟢 1. Configuração inicial do projeto**

**Descrição:**

- Baixar e configurar o CodeIgniter 3.
- Configurar o arquivo `config/config.php` para definir a URL base do sistema.
- Configurar a conexão com o banco de dados em `config/database.php`.

**Tarefas:**

1. Baixar o CodeIgniter 3 e extrair os arquivos no servidor local.
2. Criar um banco de dados no **phpMyAdmin** chamado `treinamentos`.
3. Configurar `application/config/config.php` e `application/config/database.php`.

---

## **🟢 2. Criar a tabela **`funcionarios`** no banco de dados**

**Descrição:**\
Essa tabela armazenará os funcionários e seus dados.

**Tarefas:**

1. Criar a tabela `funcionarios` no banco de dados.
2. A senha deve ser criptografada com `password_hash()`.

**SQL para criar a tabela **``**:**

    ```sql
    CREATE TABLE funcionarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        cargo VARCHAR(50) NOT NULL,
        setor VARCHAR(50) NOT NULL,
        cpf VARCHAR(14) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        telefone VARCHAR(20),
        senha VARCHAR(255) NOT NULL,
        tipo ENUM('comum', 'gestor') DEFAULT 'comum',
        rua VARCHAR(100) NOT NULL,
        numero VARCHAR(10) NOT NULL,
        complemento VARCHAR(50),
        bairro VARCHAR(50) NOT NULL,
        cidade VARCHAR(50) NOT NULL,
        estado CHAR(2) NOT NULL,
        cep VARCHAR(10) NOT NULL
    );
    ```

---

## **🟢 3. Criar a tela de login**

**Descrição:**\
Criar a tela de login para permitir que funcionários acessem o sistema.

**Tarefas:**

1. Criar um formulário com email e senha.
2. Criar um controlador `Auth.php` para processar o login.
3. Verificar a senha usando `password_verify()`.

---

## **🟢 4. Criar CRUD de Funcionários (apenas gestores podem acessar)**

**Descrição:**\
Permitir que **gestores** cadastrem, editem e removam funcionários.

**Tarefas:**

1. Criar um controlador `Funcionarios.php`.
2. Criar métodos para `index()`, `create()`, `store()`, `edit()`, `update()` e `delete()`.
3. Permitir que apenas **gestores** realizem essas ações.

---

## **🟢 5. Criar a tabela **

**Descrição:**\
Essa tabela armazenará os treinamentos realizados pelos funcionários.

**SQL para criar a tabela **`treinamentos`**:**

```sql
CREATE TABLE treinamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    funcionario_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    data_realizacao DATE NOT NULL,
    data_vencimento DATE NOT NULL,
    FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id) ON DELETE CASCADE
);
```

**Tarefas:**

1. Criar a tabela `treinamentos` no banco de dados.
2. Criar relação entre `treinamentos` e `funcionarios`.

---

## **🟢 6. Criar CRUD de Treinamentos**

**Descrição:**\
Permitir que gestores cadastrem, editem e removam treinamentos de funcionários.

**Tarefas:**

1. Criar um controlador `Treinamentos.php`.
2. Criar métodos para `index()`, `create()`, `store()`, `edit()`, `update()` e `delete()`.
3. Mostrar a lista de treinamentos no perfil do funcionário.

---

## **🟢 7. Implementar alertas de vencimento de treinamentos**

**Descrição:**\
Exibir alertas quando um treinamento estiver perto do vencimento.

**Tarefas:**

1. Criar uma função que verifica **se faltam menos de 30 dias** para vencer um treinamento.
2. Salvar um alerta no campo `alerta_treinamento` da tabela `funcionarios`.
3. Exibir os alertas na tela de perfil do funcionário.

**SQL para verificar treinamentos vencendo em 30 dias:**

```sql
SELECT * FROM treinamentos
WHERE DATEDIFF(data_vencimento, CURDATE()) <= 30;
```

---

## **🟢 8. Criar relatórios gerenciais**

### **8.1 Relatório de funcionários que precisam renovar treinamento**

- Criar um método `relatorio()` no controlador `Treinamentos.php`.
- Exibir funcionários que possuem treinamentos vencidos ou prestes a vencer.

### **8.2 Relatório de treinamentos por setor**

- Criar um método `relatorio_por_setor()` no controlador `Treinamentos.php`.
- Agrupar os treinamentos por setor.

**SQL para contar treinamentos por setor:**

```sql
SELECT setor, COUNT(*) as total_treinamentos
FROM funcionarios
JOIN treinamentos ON funcionarios.id = treinamentos.funcionario_id
GROUP BY setor;
```

---

## **🟢 9. Criar um dashboard com estatísticas**

**Descrição:**\
Exibir um resumo geral do sistema, incluindo:

- Quantidade de funcionários cadastrados.
- Quantidade de treinamentos realizados.
- Quantidade de treinamentos vencendo nos próximos 30 dias.
- Percentual de conformidade da empresa.

**SQL para calcular percentual de conformidade:**

```sql
SELECT
    (COUNT(CASE WHEN data_vencimento >= CURDATE() THEN 1 END) * 100) / COUNT(*) AS percentual_conformidade
FROM treinamentos;
```
<!--aqui vai pucahar as coisa do banco de dados-->
<table class="table table-striped small mt-3">
            <thead>
                <!-- Cabeçalhos das colunas da tabela -->
                <tr>
                    <th>#</th>       <!-- Coluna para o ID do funcionário -->
                    <th>Nome</th>    <!-- Coluna para o nome do funcionário -->
                    <th>preço</th>     <!-- Coluna para o CPF do funcionário -->
                    <th>Foto</th>   <!-- Coluna para o cargo do funcionário -->
                    <th>colecao</th>   <!-- Coluna para a foto do funcionário -->
                </tr>
            </thead>
            <tbody>
                <!-- Loop PHP para exibir os dados dos funcionários -->
                <?php foreach($roupas as $item) { ?>  
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['nome'] ?></td>
            <td><?= $item['preco']?> R$</td>
            <td><?= $item['colecao']?> R$</td>
            <td>
                <img src="<?= base_url('public/uploads/' . $item['imagem']) ?>" alt="Foto" width="60" height="60">
            </td>

        <!-- vaificar dentro de roupas -->
            
    <?php } ?>

    <!-- tabela de roupa-->

    CREATE TABLE roupa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    colecao VARCHAR(50),
    preco DECIMAL(10, 2),
    imagem VARCHAR(255)  -- caminho ou nome do arquivo da imagem
);

CREATE TABLE historico_compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    roupa_id INT,
    quantidade INT,
    data_compra DATETIME DEFAULT CURRENT_TIMESTAMP
);
