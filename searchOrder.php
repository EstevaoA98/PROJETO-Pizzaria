<?php
include_once("templates/header.php");
include_once("process/conn.php");

// Mensagem se caso tiver algum erro
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$status = null; 
$tipo_pedido = null; 

if (isset($_POST['codigo'])) {
    $order_id = $_POST['codigo'];
    $result = getOrderStatus($conn, $order_id);
    if (is_array($result)) {
        $status = $result['status'];
        $tipo_pedido = $result['tipo_pedido'];
    } else {
        $status = $result;
    }
}

function getOrderStatus($conn, $pedido_id) {
    $stmt = $conn->prepare("SELECT status_id, pizza_id FROM pedidos WHERE id = :id");
    $stmt->bindParam(':id', $pedido_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $status_map = [
            1 => "Em produção",
            2 => "Saindo para entrega",
            3 => "Pedido concluído"
        ];
        return [
            'status' => $status_map[$result['status_id']] ?? "Status desconhecido",
            'tipo_pedido' => $result['pizza_id']
        ];
    } else {
        return "Pedido não encontrado.";
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
                        <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Digite o código do pedido" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="hidden" name="type" value="search">
                        <input type="submit" class="btn btn-primary" value="Procurar">
                    </div>
                </form>
                <?php if ($tipo_pedido !== null): ?>
                    <div class="alert alert-info text-center mt-4">
                    <p>Número id do Pedido: <?= htmlspecialchars($tipo_pedido) ?></p>
                        <?php if ($status !== null): ?>
                            <p>Status do Pedido: <?= htmlspecialchars($status) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include_once("templates/footer.php"); ?>
</body>
</html>