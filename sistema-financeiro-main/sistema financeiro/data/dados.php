<?php
$usuarios = [
    ["usuario" => "cliente",  "senha" => "123", "perfil" => "cliente"],
    ["usuario" => "empresa",  "senha" => "123", "perfil" => "empresa"],
    ["usuario" => "admin",    "senha" => "123", "perfil" => "proprietario"]
];

if (!isset($_SESSION["contas"])) {
    $_SESSION["contas"] = [
        ["id" => 1, "descricao" => "Mensalidade",   "valor" => 200.00, "tipo" => "Receber", "usuario" => "cliente"],
        ["id" => 2, "descricao" => "Conta de Luz",  "valor" => 120.00, "tipo" => "Pagar",   "usuario" => "empresa"],
        ["id" => 3, "descricao" => "Aluguel",        "valor" => 1500.00,"tipo" => "Pagar",   "usuario" => "empresa"],
        ["id" => 4, "descricao" => "Serviço Prestado","valor"=> 500.00, "tipo" => "Receber", "usuario" => "cliente"],
    ];
    $_SESSION["proximo_id"] = 5;
}

$contas = &$_SESSION["contas"];

//

function getContasPorPerfil() {
    global $contas;
    $perfil  = $_SESSION["perfil"];
    $usuario = $_SESSION["usuario"];

    if ($perfil === "proprietario") {
        return $contas; 
    }

    return array_values(array_filter($contas, fn($c) => $c["usuario"] === $usuario));
}

function getContaPorId(int $id): ?array {
    global $contas;
    foreach ($contas as $c) {
        if ((int)$c["id"] === $id) return $c;
    }
    return null;
}

function podeMexerNaConta(array $conta): bool {
    $perfil  = $_SESSION["perfil"];
    $usuario = $_SESSION["usuario"];
    return $perfil === "proprietario" || $conta["usuario"] === $usuario;
}

function adicionarConta(string $descricao, float $valor, string $tipo): void {
    global $contas;
    $contas[] = [
        "id"        => $_SESSION["proximo_id"]++,
        "descricao" => $descricao,
        "valor"     => $valor,
        "tipo"      => $tipo,
        "usuario"   => $_SESSION["usuario"],
    ];
}

function atualizarConta(int $id, string $descricao, float $valor, string $tipo): bool {
    global $contas;
    foreach ($contas as &$c) {
        if ((int)$c["id"] === $id) {
            $c["descricao"] = $descricao;
            $c["valor"]     = $valor;
            $c["tipo"]      = $tipo;
            return true;
        }
    }
    return false;
}

function excluirConta(int $id): bool {
    global $contas;
    foreach ($contas as $k => $c) {
        if ((int)$c["id"] === $id) {
            unset($contas[$k]);
            $contas = array_values($contas);
            return true;
        }
    }
    return false;
}
?>