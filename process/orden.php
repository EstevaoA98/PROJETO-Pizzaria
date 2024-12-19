<?php

    include_once("conn.php");
    //mensagem se caso tiver algum erro
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    
    $method = $_SERVER["REQUEST_METHOD"];

    if($method === "GET"){
        
        $pedidosQuery = $conn->query("SELECT * FROM pedidos;");

        $pedidos = $pedidosQuery->fetchAll();

        $pizzas = [];

        //Montagem da pizza
        foreach($pedidos as $pedido){

            $pizza = [];

            // arrey para pizza
            $pizza["id"] = $pedido["pizza_id"];
            
            //resgatando a pizza
            $pizzaQuery = $conn->prepare("SELECT * FROM pizzas WHERE id = :pizza_id");

            $pizzaQuery->bindParam(":pizza_id",$pizza["id"]);

            $pizzaQuery->execute();

            $pizzaData = $pizzaQuery->fetch(PDO::FETCH_ASSOC);

            // resgatando a borda
            $bordaQuery = $conn->prepare("SELECT * FROM bordas WHERE id = :borda_id");

            $bordaQuery->bindParam(":borda_id",$pizzaData["borda_id"]);

            $bordaQuery->execute();

            $bordaData = $bordaQuery->fetch(PDO::FETCH_ASSOC);

            $pizza["borda"] = $bordaData["tipo"];

            // resgatando a borda
            $massaQuery = $conn->prepare("SELECT * FROM massas WHERE id = :massa_id");

            $massaQuery->bindParam(":massa_id",$pizzaData["massa_id"]);

            $massaQuery->execute();

            $massaData = $massaQuery->fetch(PDO::FETCH_ASSOC);

            $pizza["massa"] = $massaData["tipo"];

            // resgantando sabores
            $saboresQuery = $conn->prepare("SELECT * FROM pizza_sabor WHERE pizza_id = :pizza_id");

            $saboresQuery->bindParam(":pizza_id",$pizzaData["id"]);

            $saboresQuery->execute();

            $sabores = $saboresQuery->fetchAll(PDO::FETCH_ASSOC);

            // resgantando nomes dos sabores
            $saboresDaPizza = [];

            $saborQuery = $conn->prepare("SELECT * FROM sabores WHERE id= :sabor_id");

            foreach($sabores as $sabor){

                $saborQuery->bindParam(":sabor_id",$sabor["sabor_id"]);

                $saborQuery->execute();

                $saborPizza = $saborQuery->fetch(PDO::FETCH_ASSOC);

                array_push($saboresDaPizza, $saborPizza["nome"]);

            }

            $pizza["sabores"] = $saboresDaPizza;
            
            // sttus do pedido
            $pizza["status"] = $pedido["status_id"];

            array_push($pizzas, $pizza);

        }

        $statusQuery = $conn->query("SELECT * FROM status;");

        $status = $statusQuery->fetch();

    }else if($method === "POST"){

        //verificando POST
        $type = $_POST["type"];

        // excluir pedido
        if ($type === "delete"){

            $pizzaId = $_POST["id"];

            $deleteQuery = $conn->prepare("DELETE FROM pedidos WHERE pizza_id = :pizza_id");

            $deleteQuery->bindParam(":pizza_id",$pizzaId, PDO::PARAM_INT);

            $deleteQuery->execute();

            $_SESSION["msg"] = "Pedido removido com sucesso!";
            $_SESSION["status"] = "success";

        }
        else if($type === "update") {
            // Verificando se os dados necessários estão presentes
            if (isset($_POST["id"]) && isset($_POST["status"]) && !empty($_POST["id"]) && !empty($_POST["status"])) {
                $pizzaId = $_POST["id"];
                $statusId = $_POST["status"];
            
                try {
                    // Preparando a query de atualização
                    $updateQuery = $conn->prepare("UPDATE pedidos SET status_id = :status_id WHERE pizza_id = :pizza_id");
            
                    // Vinculando os parâmetros
                    $updateQuery->bindParam("pizza_id", $pizzaId, PDO::PARAM_INT);
                    $updateQuery->bindParam("status_id", $statusId, PDO::PARAM_INT);
            
                    // Executando a consulta
                    $updateQuery->execute();
            
                    // Definindo a mensagem de sucesso
                    $_SESSION["msg"] = "Pedido atualizado com sucesso";
                    $_SESSION["status"] = "success"; 
                    
                    // Redirecionando para a página de gerenciamento de pedidos
                    header("Location: /pizzariasabor/dashboard.php"); 
                    exit;
                } catch (PDOException $e) {
                    // Tratando exceções de banco de dados
                    $_SESSION["msg"] = "Erro ao atualizar o pedido: " . $e->getMessage();
                    $_SESSION["status"] = "error";
                    header("Location: /pizzariasabor/dashboard.php");
                    exit;
                }
            } else {
                // Caso algum campo esteja faltando
                $_SESSION["msg"] = "Dados inválidos. Verifique os campos e tente novamente.";
                $_SESSION["status"] = "error";
                header("Location: /pizzariasabor/dashboard.php");
                exit;
            }
        }
        

    // retorna usuario para dashboard
            header("Location: ../dashboard.php");
    }
?>