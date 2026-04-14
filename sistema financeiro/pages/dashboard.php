<?php
include "../config/config.php";
include "../data/dados.php";
include "../includes/auth.php";

$perfil = $_SESSION["perfil"];
$usuario = $_SESSION["usuario"];

$contasVisiveis = [];

foreach ($_SESSION["contas"] as $conta) {
    if ($perfil == "proprietario") {
        $contasVisiveis[] = $conta;
    } elseif ($conta["usuario"] == $usuario) {
        $contasVisiveis[] = $conta;
    }
}

$totalReceber = 0;
$totalPagar = 0;

foreach ($contasVisiveis as $conta) {
    if ($conta["tipo"] == "Receber") {
        $totalReceber = $totalReceber + $conta["valor"];
    } else {
        $totalPagar = $totalPagar + $conta["valor"];
    }
}

$saldo = $totalReceber - $totalPagar;
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/menu.php"; ?>

<div class="container">
    <h1 class="mb-1">Bem-vindo, <?php echo $usuario; ?>!</h1>
    <p class="text-muted mb-4">Perfil: <strong><?php echo $perfil; ?></strong></p>

    <div class="row g-3 mt-2">
        <div class="col-md-4">
            <div class="card text-bg-success shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase">Contas a Receber</h6>
                    <h3 class="fw-bold">R$ <?php echo number_format($totalReceber, 2, ",", "."); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-danger shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase">Contas a Pagar</h6>
                    <h3 class="fw-bold">R$ <?php echo number_format($totalPagar, 2, ",", "."); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card <?php if ($saldo >= 0) { echo "text-bg-primary"; } else { echo "text-bg-warning"; } ?> shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase">Saldo</h6>
                    <h3 class="fw-bold">R$ <?php echo number_format($saldo, 2, ",", "."); ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>
