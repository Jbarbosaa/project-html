<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "empresa";

$conexao = mysqli_connect($host, $usuario, $senha);

if (!$conexao) {
    die("Erro ao conectar ao MySQL: " . mysqli_connect_error());
}

mysqli_set_charset($conexao, "utf8mb4");

$sqlBanco = "CREATE DATABASE IF NOT EXISTS $banco CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (!mysqli_query($conexao, $sqlBanco)) {
    die("Erro ao criar banco de dados: " . mysqli_error($conexao));
}

if (!mysqli_select_db($conexao, $banco)) {
    die("Erro ao selecionar banco de dados: " . mysqli_error($conexao));
}

$sqlTabela = "
CREATE TABLE IF NOT EXISTS funcionarios (
    id INT(10) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(30) NULL DEFAULT NULL,
    celular VARCHAR(50) NULL DEFAULT NULL,
    endereco VARCHAR(50) NULL DEFAULT NULL,
    numero VARCHAR(20) NULL DEFAULT NULL,
    complemento VARCHAR(50) NULL DEFAULT NULL,
    bairro VARCHAR(30) NULL DEFAULT NULL,
    cidade VARCHAR(50) NULL DEFAULT NULL,
    cep VARCHAR(8) NULL DEFAULT NULL,
    uf VARCHAR(2) NULL DEFAULT NULL,
    email VARCHAR(50) NULL DEFAULT NULL,
    cargo VARCHAR(50) NULL DEFAULT NULL,
    departamento VARCHAR(50) NULL DEFAULT NULL,
    usuario VARCHAR(8) NULL DEFAULT NULL,
    senha VARCHAR(8) NULL DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB";

if (!mysqli_query($conexao, $sqlTabela)) {
    die("Erro ao criar tabela funcionarios: " . mysqli_error($conexao));
}
?>
