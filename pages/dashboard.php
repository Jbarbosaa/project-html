<?php
require_once "../config/proteger.php";
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style type="text/css">
        html, body {
            margin: 0;
            padding: 0;
        }

        body {
            color: #fff;
            font-family: Arial, Helvetica, sans-serif;
            background-image: url(../img/back.jpg);
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1, h3, p, li {
            margin-top: 0;
        }

        .container {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: flex-start;
            background-color: rgba(0, 0, 0, 0.45);
            padding: 30px;
            border-radius: 12px;
        }

        .card {
            background: white;
            padding: 20px;
            width: 200px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
            text-align: center;
        }

        .numero {
            font-size: 30px;
            font-weight: bold;
            color: blue;
        }

        h1, li {
            color: white;
        }

        a {
            color: white;
        }
    </style>
</head>

<body>
    <h1>Dashboard</h1>
    <div class="container">
        <div class="card">
            <h3>Usuario</h3>
            <p class="numero"><?php echo htmlspecialchars($_SESSION["funcionario_nome"]); ?></p>
        </div>
        <ul>
            <li>Departamento
                <ul>
                    <li><?php echo htmlspecialchars($_SESSION["funcionario_departamento"]); ?></li>
                </ul>
            </li>
            <li>Cargo
                <ul>
                    <li><?php echo htmlspecialchars($_SESSION["funcionario_cargo"]); ?></li>
                </ul>
            </li>
            <li>E-mail
                <ul>
                    <li><?php echo htmlspecialchars($_SESSION["funcionario_email"]); ?></li>
                </ul>
            </li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </div>
</body>
</html>
