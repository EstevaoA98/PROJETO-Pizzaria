<?php

    include_once("conn.php");

    $method = $_SERVER["REQUEST_METHOD"];


//Resgate dos dados, montagem do pedido
if($method === "GET") {

$bordasQuery = $conn->query("SELECT * FROM bordas;");

$bordas = $bordasQuery->fetchall();

$massasQuery = $conn->query("SELECT * FROM massas;");

$massas = $massasQuery->fetchall();

$saboresQuery = $conn->query("SELECT * FROM sabores;");

$sabores = $saboresQuery->fetchall();


//criacao do pedido
}else if($method === "POST") {

    $data = $_POST;
    
    $borda = $data["borda"];
    $massa = $data["massa"];
    $sabores = $data["sabores"];

    // valores de sabores limites
    if(count($sabores) > 3 ) {

        $_SESSION ["msg"] = "Selecione no maximo 3 sabores";
        $_SESSION ["status"] = "warning"; 

    }
    else{
        // borda e massa da pizzav
        $stmt = $conn->prepare("INSERT INTO pizzas(borda_id, massa_id) VALUES (:borda, :massa) ");

        // fintrando inputs
        $stmt->bindParam(":borda", $borda, PDO::PARAM_INT);
        $stmt->bindParam(":massa", $massa, PDO::PARAM_INT);

        $stmt->execute();

        // regastando ultimo id da pizza
        $pizzaId = $conn-> lastInsertId();

        $stmt = $conn->prepare("INSERT INTO pizza_sabor (pizza_id, sabor_id) VALUES (:pizza, :sabor)");
        
        //repeticao ate salvar todos os sabores 
        foreach($sabores as $sabor) {

            //filtrnado os inputs
            $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
            $stmt->bindParam(":sabor", $saborId, PDO::PARAM_INT);

            $stmt->execute();

        }

        // criando o pedido da pizza 
        $stmt = $conn-> prepare("INSERT INTO pedidos (pizza_id, status_id) VALUES (:pizza, :status)");

        // status -> sempre inicia com, que é a producao
        $statusId = 1;

        // filtrar inputs
        $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
        $stmt->bindParam(":status", $statusId, PDO::PARAM_INT);

        $stmt->execute();

        //exibit mensagem de pedido realizar com sucesso
        $_SESSION["msg"] = "Pedido realizado com sucesso";
        $_SESSION["status"] = "success"; 

    
    }
    // retonna para o menu principal
    header("Location: ..");


}

?>