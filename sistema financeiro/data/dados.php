<?php
$usuarios = [
    ["usuario" => "cliente", "senha" => "123", "perfil" => "cliente"],
    ["usuario" => "empresa", "senha" => "123", "perfil" => "empresa"],
    ["usuario" => "admin", "senha" => "123", "perfil" => "proprietario"]
];

if (!isset($_SESSION["contas"])) {
    $_SESSION["contas"] = [
        ["id" => 1, "descricao" => "Mensalidade", "valor" => 200.00, "tipo" => "Receber", "usuario" => "cliente"],
        ["id" => 2, "descricao" => "Conta de Luz", "valor" => 120.00, "tipo" => "Pagar", "usuario" => "empresa"],
        ["id" => 3, "descricao" => "Aluguel", "valor" => 1500.00, "tipo" => "Pagar", "usuario" => "empresa"],
        ["id" => 4, "descricao" => "Servico Prestado", "valor" => 500.00, "tipo" => "Receber", "usuario" => "cliente"]
    ];
    $_SESSION["proximo_id"] = 5;
}
?>
