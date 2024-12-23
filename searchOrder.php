<?php
include_once("templates/header.php");
include_once("process/conn.php");

// Mensagem se caso tiver algum erro
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$status = null; 
$tipo_pedido = null; 
$status_id = null;
$pedido_nao_encontrado = false; 

if (isset($_POST['codigo'])) {
    $order_id = $_POST['codigo'];
    $result = getOrderStatus($conn, $order_id);
    if (is_array($result)) {
        $status = $result['status'];
        $tipo_pedido = $result['tipo_pedido'];
        $status_id = $result['status_id'];
    } else {
        $pedido_nao_encontrado = true;
    }
}

function getOrderStatus($conn, $pedido_id) {
    $stmt = $conn->prepare("SELECT status_id, pizza_id FROM pedidos WHERE id = :id");
    $stmt->bindParam(':id', $pedido_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Verifica se o pedido foi encontrado
    if ($result) {
        $status_map = [
            1 => "Em produção",
            2 => "Rota de entrega",
            3 => "Pedido entregue"
        ];
        return [
            'status' => $status_map[$result['status_id']] ?? "Status desconhecido",
            'tipo_pedido' => $result['pizza_id'],
            'status_id' => $result['status_id'] 
        ];
    } else {
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localizar Pedido</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <link rel="stylesheet" href="css/style.css"> 
   
</head>
<body>
    <div id="main-banner2" class="text-center bg-light py-5">
        <h1>Localize seu pedido</h1>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Digite o código do seu pedido:</h2>
                <form action="searchOrder.php" method="POST" id="search-form">
                    <div class="form-group mb-3">
                        <input type="text" name="codigo" id="codigo" class="text-center form-control" placeholder="Digite o código do pedido" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="hidden" name="type" value="search">
                        <input type="submit" class="btn btn-primary" value="Procurar">
                    </div>
                </form>
                <?php if ($tipo_pedido !== null): ?>
                    <div class="alert-custom text-center">
                        <p>Número do Pedido: <?= htmlspecialchars($tipo_pedido) ?></p>
                        <?php if ($status !== null): ?>
                            <p>Status do Pedido: <?= htmlspecialchars($status) ?></p>
                            
                            <?php if ($status_id == 1): ?>
                                <img src="img/preparapandpPizza.png" alt="Em produção" id="brand-logo">
                            <?php elseif ($status_id == 2): ?>
                                <img src="img/entregaPizza.png" alt="Saindo para entrega" id="brand-logo">
                            <?php elseif ($status_id == 3): ?>
                                <img src="img/concluido.png" alt="Pedido concluído" id="brand-logo">
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php elseif ($pedido_nao_encontrado): ?>
                    <div class="alert-custom-searchNo text-center">
                        <p>Pedido de "<?= htmlspecialchars($order_id) ?>" Pedido não localizado, verifique o código.</p>
                        <img src="img/naoEncontrado.png" alt="nao encontrado" id="brand-logo">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include_once("templates/footer.php"); ?>
</body>
</html>