<?php
require_once "../config/conexao.php";

$sql = "SELECT id, nome, cargo, email FROM funcionarios ORDER BY id";
$resultado = mysqli_query($conexao, $sql);
?>
<html>
<head>
<meta charset="UTF-8">
<title>Lista de Funcionarios</title>
<style type="text/css">
body {
    font-family: Arial, Helvetica, sans-serif;
    color: #222;
}

table {
    border-collapse: collapse;
}

td {
    vertical-align: middle;
}
</style>
</head>

<body background="../img/back.jpg">

<table width="80%" border="0" align="center" cellpadding="15" style="background-color: rgba(255,255,255,0.9); border-radius: 10px; box-shadow: 0px 0px 15px gray; margin: 20px auto;">

<tr height="50" style="background-color: #333; color: white;">
<td align="center" valign="middle" colspan="4" style="font-size: 24px; font-weight: bold;">
Lista de Funcionarios
</td>
</tr>

<tr style="background-color: #666; color: white; font-weight: bold;">
<td align="center">Num</td>
<td align="center">Nome</td>
<td align="center">Cargo</td>
<td align="center">Email</td>
</tr>

<?php if ($resultado && mysqli_num_rows($resultado) > 0) { ?>
    <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
        <tr style="background-color: #f9f9f9;">
        <td align="center"><?php echo htmlspecialchars($row["id"]); ?></td>
        <td><?php echo htmlspecialchars($row["nome"]); ?></td>
        <td><?php echo htmlspecialchars($row["cargo"]); ?></td>
        <td><?php echo htmlspecialchars($row["email"]); ?></td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr style="background-color: #f9f9f9;">
    <td align="center" colspan="4">Nenhum funcionario cadastrado.</td>
    </tr>
<?php } ?>
</table>

</body>
</html>
