<?php
include_once("templates/header.php");
?>
<div id="main-conteiner">
    <div class="conteiner">
        <div class="row">
            <div class="col-md-12">
                <h2>Gerenciar pedidos:</h2>
            </div>
            <div class="col-md-12 table conteiner">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><span>Pedido</span> #</th>
                            <th scope= "col">Borda</th>
                            <th scope= "col">Massa</th>
                            <th scope= "col">Sabores</th>
                            <th scope= "col">Status</th>
                            <th scope= "col">Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1</td>
                            <td>Cheddar</td>
                            <td>Catupiry</td>
                            <td>4 Queijos</td>
                            <td>
                                <form action="process/orden.php" method= "POST" class="form-group update-form">
                                    <input type="hidden" name="type" value="upadate">
                                    <input type="hidden" name="id" value="1">
                                    <select name="status" class="form-control status-input">
                                        <option value="">Entrega</option>
                                    </select>
                                    <button type="submit" class="upadate-btn">
                                        <i class= "fas fa-sync-alt"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="process/orden.php" method="POST">
                                <input type="hidden" name="type" value="delete">
                                <input type="hidden" name="id" value="1">
                                <button type="submit" class="delete-btn">
                                        <i class= "fas fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once("templates/footer.php");
?>