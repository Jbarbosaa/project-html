<?php
require_once "../config/conexao.php";

$mensagem = "";
$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $senha = trim($_POST["senha"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $celular = trim($_POST["celular"] ?? "");
    $endereco = trim($_POST["endereco"] ?? "");
    $numero = trim($_POST["numero"] ?? "");
    $bairro = trim($_POST["bairro"] ?? "");
    $cidade = trim($_POST["cidade"] ?? "");
    $uf = trim($_POST["uf"] ?? "");
    $cep = trim($_POST["cep"] ?? "");
    $complemento = trim($_POST["complemento"] ?? "");
    $usuario = trim($_POST["usuario"] ?? "");
    $departamento = trim($_POST["departamento"] ?? "");
    $cargo = trim($_POST["cargo"] ?? "");

    if ($nome === "" || $senha === "" || $email === "" || $endereco === "" || $cidade === "" || $uf === "" || $cep === "" || $usuario === "" || $departamento === "" || $cargo === "") {
        $erro = "Preencha todos os campos obrigatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Informe um e-mail valido.";
    } elseif (strlen($usuario) > 8 || strlen($senha) > 8) {
        $erro = "Usuario e senha devem ter no maximo 8 caracteres.";
    } else {
        $sql = "INSERT INTO funcionarios (nome, celular, endereco, numero, complemento, bairro, cidade, cep, uf, email, cargo, departamento, usuario, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $nome, $celular, $endereco, $numero, $complemento, $bairro, $cidade, $cep, $uf, $email, $cargo, $departamento, $usuario, $senha);

        if (mysqli_stmt_execute($stmt)) {
            $mensagem = "Funcionario cadastrado com sucesso.";
        } else {
            $erro = "Erro ao cadastrar funcionario: " . mysqli_error($conexao);
        }
    }
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
<style type="text/css">
body {
    font-family: Arial, Helvetica, sans-serif;
    color: #222;
}

table {
    border-collapse: collapse;
}

input, select {
    font-family: inherit;
}

.mensagem {
    color: #176b2c;
}

.erro {
    color: #b00020;
}
</style>
</head>
<body style="background-image: url(../img/back.jpg); background-size: cover; background-position: center; margin: 0;">
<center style="display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px 0;">
<div style="background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0px 0px 10px gray; text-align: center;">
<?php if ($mensagem !== "") { ?><p class="mensagem"><?php echo htmlspecialchars($mensagem); ?></p><?php } ?>
<?php if ($erro !== "") { ?><p class="erro"><?php echo htmlspecialchars($erro); ?></p><?php } ?>
<form method="POST" action="register.php">
<table style="margin: 0 auto;">
<tr><td colspan="2" style="text-align: center;"><h2>Register</h2></td></tr>
<tr><td style="padding: 10px;">Nome:</td><td style="padding: 10px;"><input type="text" name="nome" size="30" maxlength="30" required></td></tr>
<tr><td style="padding: 10px;">Senha:</td><td style="padding: 10px;"><input type="password" name="senha" size="30" maxlength="8" required></td></tr>
<tr><td style="padding: 10px;">Email:</td><td style="padding: 10px;"><input type="email" name="email" size="30" maxlength="50" required></td></tr>
<tr><td style="padding: 10px;">Celular:</td><td style="padding: 10px;"><input type="tel" name="celular" size="30" maxlength="50"></td></tr>
<tr><td style="padding: 10px;">Endereco:</td><td style="padding: 10px;"><input type="text" name="endereco" size="30" maxlength="50" required></td></tr>
<tr><td style="padding: 10px;">Numero:</td><td style="padding: 10px;"><input type="text" name="numero" size="30" maxlength="20"></td></tr>
<tr><td style="padding: 10px;">Complemento:</td><td style="padding: 10px;"><input type="text" name="complemento" size="30" maxlength="50"></td></tr>
<tr><td style="padding: 10px;">Bairro:</td><td style="padding: 10px;"><input type="text" name="bairro" size="30" maxlength="30"></td></tr>
<tr><td style="padding: 10px;">Cidade:</td><td style="padding: 10px;"><input type="text" name="cidade" size="30" maxlength="50" required></td></tr>
<tr><td style="padding: 10px;">UF:</td><td style="padding: 10px;"><select name="uf" required>
    <option value="AC">AC</option>
    <option value="AL">AL</option>
    <option value="AP">AP</option>
    <option value="AM">AM</option>
    <option value="BA">BA</option>
    <option value="CE">CE</option>
    <option value="DF">DF</option>
    <option value="ES">ES</option>
    <option value="GO">GO</option>
    <option value="MA">MA</option>
    <option value="MT">MT</option>
    <option value="MS">MS</option>
    <option value="MG">MG</option>
    <option value="PA">PA</option>
    <option value="PB">PB</option>
    <option value="PR">PR</option>
    <option value="PE">PE</option>
    <option value="PI">PI</option>
    <option value="RJ">RJ</option>
    <option value="RN">RN</option>
    <option value="RS">RS</option>
    <option value="RO">RO</option>
    <option value="RR">RR</option>
    <option value="SC">SC</option>
    <option value="SP">SP</option>
    <option value="SE">SE</option>
    <option value="TO">TO</option>
  </select></td></tr>
<tr><td style="padding: 10px;">CEP:</td><td style="padding: 10px;"><input type="text" name="cep" size="30" maxlength="8" required></td></tr>
<tr><td style="padding: 10px;">Usuario:</td><td style="padding: 10px;"><input type="text" name="usuario" size="30" maxlength="8" required></td></tr>
<tr><td style="padding: 10px;">Departamento:</td><td style="padding: 10px;">
<select name="departamento" required>
    <option value="vendas">Vendas</option>
    <option value="marketing">Marketing</option>
    <option value="ti">TI</option>
    <option value="rh">RH</option>
</select>
</td></tr>
<tr><td style="padding: 10px;">Cargo:</td><td style="padding: 10px;"><select name="cargo" required>
    <option value="estagiario">Estagiario</option>
    <option value="analista">Analista</option>
    <option value="gerente">Gerente</option>
    <option value="diretor">Diretor</option>
    <option value="programador">Programador</option>
</select>
</td></tr>
<tr><td colspan="2" style="text-align: center; padding: 10px;">
<input type="submit" value="Enviar">
<input type="reset" value="Reset">
</td></tr>
</table>
</form>
</div>
</center>
</body>
</html>
