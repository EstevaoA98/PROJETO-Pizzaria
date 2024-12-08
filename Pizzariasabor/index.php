<?php
include_once("templates/header.php");
?>

<body>
<body>
    <div id="main-banner" class="text-center bg-light py-5">
        <h1>Faça seu pedido</h1>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Monte a pizza:</h2>
                <form action="process/pizza.php" method="POST" id="pizza-form">
                    <div class="form-group mb-3">
                        <label for="borda">Borda:</label>
                        <select name="borda" id="borda" class="form-control">
                            <option value="">Selecione a borda</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="massa">Massa:</label>
                        <select name="massa" id="massa" class="form-control">
                            <option value="">Selecione a massa</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="sabores">Sabores: (Máximo 3)</label>
                        <select multiple name="sabores[]" id="sabores" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Fazer pedido!">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include_once("templates/footer.php");
    ?>