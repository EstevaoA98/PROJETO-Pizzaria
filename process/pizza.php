<?php

    include_once("conn.php");

    $method = $_SERVER["REQUEST_METHOD"];


//Resgate dos dados, montagem do pedido
if($method === "GET") {

$bordasQuery = $conn->query("SELECT * FROM bordas;");

$bordas = $bordasQuery->fetchAll();

$massasQuery = $conn->query("SELECT * FROM massas;");

$massas = $massasQuery->fetchAll();

$saboresQuery = $conn->query("SELECT * FROM sabores;");

$sabores = $saboresQuery->fetchAll();

}else if($method === "POST") {

    $data = $_POST;
    
    $borda = $data["borda"];
    $massa = $data["massa"];
    $sabores = $data["sabores"];

    // valores de sabores limites
    if(count($sabores) > 3 ) {
        $_SESSION["msg"] = "Selecione no máximo 3 sabores";
        $_SESSION["status"] = "warning"; 
    } else {
        try {
            // borda e massa da pizza
            $stmt = $conn->prepare("INSERT INTO pizzas (borda_id, massa_id) VALUES (:borda, :massa)");
            $stmt->bindParam(":borda", $borda, PDO::PARAM_INT);
            $stmt->bindParam(":massa", $massa, PDO::PARAM_INT);
            $stmt->execute();

            // resgatando o último ID da pizza
            $pizzaId = $conn->lastInsertId();

            // adicionando os sabores da pizza
            $stmt = $conn->prepare("INSERT INTO pizza_sabor (pizza_id, sabor_id) VALUES (:pizza, :sabor)");
            foreach ($sabores as $sabor) {
                $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
                $stmt->bindParam(":sabor", $sabor, PDO::PARAM_INT);
                $stmt->execute();
            }

            // criando o pedido
            $stmt = $conn->prepare("INSERT INTO pedidos (pizza_id, status_id) VALUES (:pizza, :status)");
            $statusId = 1;
            $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
            $stmt->bindParam(":status", $statusId, PDO::PARAM_INT);
            $stmt->execute();

            // exibindo mensagem de sucesso
            $_SESSION["msg"] = "Pedido realizado com sucesso";
            $_SESSION["status"] = "success"; 
        } catch (PDOException $e) {
            // exibindo mensagem de erro
            echo "Erro ao inserir no banco: " . $e->getMessage();
            exit;
        }
    }

    // redireciona para o menu principal
    header("Location: ..");
    exit;
}
