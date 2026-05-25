<?php
session_start();
require_once "../config/conexao.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if ($usuario === "" || $senha === "") {
        $erro = "Informe usuario e senha.";
    } else {
        $sql = "SELECT id, nome, usuario, senha, email, departamento, cargo FROM funcionarios WHERE usuario = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "s", $usuario);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $nome, $usuarioBanco, $senhaBanco, $email, $departamento, $cargo);
        $encontrouFuncionario = mysqli_stmt_fetch($stmt);

        if ($encontrouFuncionario && $senha === $senhaBanco) {
            $_SESSION["funcionario_id"] = $id;
            $_SESSION["funcionario_nome"] = $nome;
            $_SESSION["funcionario_usuario"] = $usuarioBanco;
            $_SESSION["funcionario_email"] = $email;
            $_SESSION["funcionario_departamento"] = $departamento;
            $_SESSION["funcionario_cargo"] = $cargo;

            header("Location: dashboard.php");
            exit();
        }

        $erro = "Usuario ou senha invalidos.";
    }
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>Aware Company</title>
<style type="text/css">
body {
    font-family: Arial, Helvetica, sans-serif;
    color: #222;
}

input {
    font-family: inherit;
}

.erro {
    color: #b00020;
    margin-bottom: 15px;
}
</style>
</head>

<body style="background-image: url(../img/back.jpg); background-size: cover; background-position: center; text-align: center; height: 100vh; margin: 0; display: flex; justify-content: center; align-items: center;">
<center>
    <div style="background-color: rgba(255,255,255,0.92); padding: 30px; border-radius: 10px; box-shadow: 0px 0px 10px gray;">
        <h2>Login</h2>
        <?php if ($erro !== "") { ?>
            <div class="erro"><?php echo htmlspecialchars($erro); ?></div>
        <?php } ?>
        <form action="login.php" method="post">
            <input type="text" name="usuario" placeholder="Usuario" maxlength="8"><br><br>
            <input type="password" name="senha" placeholder="Senha" maxlength="8"><br><br>
            <input type="submit" value="Entrar">
        </form>
    </div>
</center>
</body>
</html>
