<html>
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
<meta http-equiv="Cache-Control" content="No-Cache">
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
<?php
function contem_comando_sql($valor) {
    $valor = strtolower($valor);

    if ((strrpos($valor, "drop") !== false) ||
        (strrpos($valor, "update") !== false) ||
        (strrpos($valor, "insert") !== false) ||
        (strrpos($valor, "delete") !== false) ||
        (strrpos($valor, "select") !== false)) {
        return true;
    }

    return false;
}

function processa_formulario() {
    if ($_GET["nome"] == "") {
        echo "<p class='erro'>Nome incorreto</p>";
        echo "<a href='javascript:history.back()'>Voltar</a>";
        exit;
    }

    if ($_GET["endereco"] == "") {
        echo "<p class='erro'>Endereco incorreto</p>";
        echo "<a href='javascript:history.back()'>Voltar</a>";
        exit;
    }

    if ($_GET["email"] == "") {
        echo "<p class='erro'>Email incorreto</p>";
        echo "<a href='javascript:history.back()'>Voltar</a>";
        exit;
    }

    if ($_GET["usuario"] == "") {
        echo "<p class='erro'>Usuario incorreto</p>";
        echo "<a href='javascript:history.back()'>Voltar</a>";
        exit;
    }

    if ($_GET["senha"] == "") {
        echo "<p class='erro'>Senha incorreta</p>";
        echo "<a href='javascript:history.back()'>Voltar</a>";
        exit;
    }

    foreach ($_GET as $campo => $valor) {
        if (contem_comando_sql($valor)) {
            echo "<p class='erro'>" . htmlspecialchars($campo) . " invalido</p>";
            echo "<a href='javascript:history.back()'>Voltar</a>";
            exit;
        }
    }
}

if ((isset($_GET["nome"])) && (isset($_GET["email"]))) {
    processa_formulario();

    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "empresa";

    $con = mysqli_connect($host, $username, $password, $db_name) or die("cannot connect");

    if (mysqli_connect_errno()) {
        echo "Falhou ao conectar ao MySQL: " . mysqli_connect_error();
        exit();
    }

    mysqli_set_charset($con, "utf8mb4");

    $nome = mysqli_real_escape_string($con, $_GET["nome"]);
    $celular = mysqli_real_escape_string($con, $_GET["celular"]);
    $endereco = mysqli_real_escape_string($con, $_GET["endereco"]);
    $numero = mysqli_real_escape_string($con, $_GET["numero"]);
    $complemento = mysqli_real_escape_string($con, $_GET["complemento"]);
    $bairro = mysqli_real_escape_string($con, $_GET["bairro"]);
    $cidade = mysqli_real_escape_string($con, $_GET["cidade"]);
    $cep = mysqli_real_escape_string($con, $_GET["cep"]);
    $uf = mysqli_real_escape_string($con, $_GET["uf"]);
    $email = mysqli_real_escape_string($con, $_GET["email"]);
    $cargo = mysqli_real_escape_string($con, $_GET["cargo"]);
    $departamento = mysqli_real_escape_string($con, $_GET["departamento"]);
    $usuario = mysqli_real_escape_string($con, $_GET["usuario"]);
    $senha = mysqli_real_escape_string($con, $_GET["senha"]);

    $sql = "INSERT INTO `funcionarios`
    (`nome`, `celular`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `cep`, `uf`, `email`, `cargo`, `departamento`, `usuario`, `senha`)
    VALUES ('".$nome."', '".$celular."', '".$endereco."', '".$numero."', '".$complemento."', '".$bairro."', '".$cidade."', '".$cep."', '".$uf."', '".$email."', '".$cargo."', '".$departamento."', '".$usuario."', '".$senha."')";

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Erro na inclusao: " . mysqli_error($con));
    } else {
        mysqli_close($con);
        echo "<p class='mensagem'>Funcionario cadastrado com sucesso</p>";
        echo "<a href='register.php'>Cadastrar outro funcionario</a>";
        exit;
    }
}
?>
<center style="display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px 0;">
<div style="background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0px 0px 10px gray; text-align: center;">
<form method="GET" action="register.php">
<table style="margin: 0 auto;">
<tr><td colspan="2" style="text-align: center;"><h2>Register</h2></td></tr>
<tr><td style="padding: 10px;">Nome:</td><td style="padding: 10px;"><input type="text" name="nome" size="30" maxlength="30"></td></tr>
<tr><td style="padding: 10px;">Senha:</td><td style="padding: 10px;"><input type="password" name="senha" size="30" maxlength="8"></td></tr>
<tr><td style="padding: 10px;">Email:</td><td style="padding: 10px;"><input type="email" name="email" size="30" maxlength="50"></td></tr>
<tr><td style="padding: 10px;">Celular:</td><td style="padding: 10px;"><input type="tel" name="celular" size="30" maxlength="50"></td></tr>
<tr><td style="padding: 10px;">Endereco:</td><td style="padding: 10px;"><input type="text" name="endereco" size="30" maxlength="50"></td></tr>
<tr><td style="padding: 10px;">Numero:</td><td style="padding: 10px;"><input type="text" name="numero" size="30" maxlength="20"></td></tr>
<tr><td style="padding: 10px;">Complemento:</td><td style="padding: 10px;"><input type="text" name="complemento" size="30" maxlength="50"></td></tr>
<tr><td style="padding: 10px;">Bairro:</td><td style="padding: 10px;"><input type="text" name="bairro" size="30" maxlength="30"></td></tr>
<tr><td style="padding: 10px;">Cidade:</td><td style="padding: 10px;"><input type="text" name="cidade" size="30" maxlength="50"></td></tr>
<tr><td style="padding: 10px;">UF:</td><td style="padding: 10px;"><select name="uf">
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
<tr><td style="padding: 10px;">CEP:</td><td style="padding: 10px;"><input type="text" name="cep" size="30" maxlength="8"></td></tr>
<tr><td style="padding: 10px;">Usuario:</td><td style="padding: 10px;"><input type="text" name="usuario" size="30" maxlength="8"></td></tr>
<tr><td style="padding: 10px;">Departamento:</td><td style="padding: 10px;">
<select name="departamento">
    <option value="vendas">Vendas</option>
    <option value="marketing">Marketing</option>
    <option value="ti">TI</option>
    <option value="rh">RH</option>
</select>
</td></tr>
<tr><td style="padding: 10px;">Cargo:</td><td style="padding: 10px;"><select name="cargo">
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
