<?php
include "../config/config.php";
include "../data/dados.php";
include "../includes/auth.php";

$contasVisiveis = getContasPorPerfil();

$totalReceber = array_sum(array_column(
    array_filter($contasVisiveis, fn($c) => $c["tipo"] === "Receber"), "valor"
));
$totalPagar = array_sum(array_column(
    array_filter($contasVisiveis, fn($c) => $c["tipo"] === "Pagar"), "valor"
));
$saldo = $totalReceber - $totalPagar;
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/menu.php"; ?>

<div class="container">
    <h1 class="mb-1">Bem-vindo, <?php echo htmlspecialchars($_SESSION["usuario"]); ?>!</h1>
    <p class="text-muted mb-4">Perfil: <strong><?php echo htmlspecialchars($_SESSION["perfil"]); ?></strong></p>

    <div class="row g-3 mt-2">
        <div class="col-md-4">
            <div class="card text-bg-success shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase">Contas a Receber</h6>
                    <h3 class="fw-bold">R$ <?php echo number_format($totalReceber, 2, ',', '.'); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-danger shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase">Contas a Pagar</h6>
                    <h3 class="fw-bold">R$ <?php echo number_format($totalPagar, 2, ',', '.'); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card <?php echo $saldo >= 0 ? 'text-bg-primary' : 'text-bg-warning'; ?> shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase">Saldo</h6>
                    <h3 class="fw-bold">R$ <?php echo number_format($saldo, 2, ',', '.'); ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="contas/listar.php" class="btn btn-outline-dark">Ver todas as contas →</a>
    </div>
</div>

<?php include "../includes/footer.php"; ?>