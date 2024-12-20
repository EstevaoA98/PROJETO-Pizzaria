<?php
include_once("templates/header.php");
include_once("process/pizza.php");

?>

<body>

    <body>
        <div id="main-banner" class="text-center bg-light py-5">
            <h1>Faça seu pedido</h1>
        </div>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <h2 class="text-center">Monte sua pizza:</h2>
                        <form action="process/pizza.php" method="POST" id="pizza-form">
                            <div class="form-group mb-3">
                                <label for="borda">Borda:</label>
                                <select name="borda" id="borda" class="form-control">
                                    <option value="">Selecione a borda</option>
                                    <?php foreach ($bordas as $borda): ?>
                                        <option value="<?= $borda["id"] ?>"><?= $borda["tipo"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="massa">Massa:</label>
                                <select name="massa" id="massa" class="form-control">
                                    <option value="">Selecione a massa</option>
                                    <?php foreach ($massas as $massa): ?>
                                        <option value="<?= $massa["id"] ?>"><?= $massa["tipo"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sabores">Sabor: (Máximo 3) </label>
                                <div id="sabores-container">
                                <div id="sabores">
                                    <?php foreach ($sabores as $sabor): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="sabores[]" value="<?= $sabor["id"] ?>" id="sabor<?= $sabor["id"] ?>">
                                            <label class="form-check-label" for="sabor<?= $sabor["id"] ?>">
                                                <?= $sabor["nome"] ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                </div>
                            </div>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-primary" value="Fazer pedido!">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        include_once("templates/footer.php");
        ?>