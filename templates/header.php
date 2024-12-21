<?php
include_once("process/conn.php");

$msg = "";

if (isset($_SESSION["msg"])) {

    $msg = $_SESSION["msg"];
    $status = $_SESSION["status"];

    $_SESSION["msg"] = "";
    $_SESSION["status"] = "";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça seu pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <a href="index.php" class="nav-brand">
                    <img src="img/pizza.png" alt="fazer pedido da pizza" id="brand-logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                            <a href="index.php" class="nav-link">Peça sua pizza</a>
                            </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center">
                    <a href="searchOrder.php" class="nav-brand-search">
                        <img src="img/lupa.png" alt="lupa" id="brand-logo">
                    </a>
                    <a href="searchOrder.php" class="nav-link">Localizar Pedido</a>
                </div>
            </div>
        </nav>
    </header>
    <?php if ($msg != ""): ?>
        <div class="alert alert-<?= $status ?>">
            <p><?= $msg ?></p>
        </div>
    <?php endif; ?>