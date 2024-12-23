<?php

include_once("templates/header.php");
include_once("process/orden.php");

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
                            <th scope="col"><span>Pedido</span></th>
                            <th scope="col">Borda</th>
                            <th scope="col">Massa</th>
                            <th scope="col">Sabores</th>
                            <th scope="col">Tamanho</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        <?php if (!empty($pizzas) && is_array($pizzas)): ?>
                            <?php foreach ($pizzas as $pizza): ?>
                                <tr>
                                    <td><?= ($pizza["id"]) ?></td>
                                    <td><?= ($pizza["borda"]) ?></td>
                                    <td><?= ($pizza["massa"]) ?></td>
                                    <td>
                                        <ul>
                                            <?php if (!empty($pizza["sabores"]) && is_array($pizza["sabores"])): ?>
                                                <?php foreach ($pizza["sabores"] as $sabor): ?>
                                                    <li><?= ($sabor) ?></li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li>Sem sabores definidos</li>
                                            <?php endif; ?>
                                        </ul>
                                    </td>
                                    
                                    <td><?= ($pizza)["tamanho"]?></td>

                                    <td>
                                        <form action="process/orden.php" method="POST" class="form-group update-form">
                                            <input type="hidden" name="type" value="update">
                                            <input type="hidden" name="id" value="<?= ($pizza["id"]) ?>">
                                            <select name="status" class="form-control status-input">
                                                <?php
                                                // Definindo os status de acodo com o banco de dados
                                                $status = [
                                                    ["id" => 1, "tipo" => "Produção"],
                                                    ["id" => 2, "tipo" => "Entrega"],
                                                    ["id" => 3, "tipo" => "Concluído"]];
                                                foreach ($status as $s):
                                                ?>
                                                    <option value="<?= $s["id"] ?>" <?php echo ($s["id"] == $pizza["status"]) ? "selected" : ""; ?>>
                                                        <?= $s["tipo"] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" class="update-btn">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="process/orden.php" method="POST">
                                            <input type="hidden" name="type" value="delete">
                                            <input type="hidden" name="id" value="<?= ($pizza["id"]) ?>">
                                            <button type="submit" class="delete-btn">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">Nenhum pedido encontrado</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once("templates/footer.php");
?>