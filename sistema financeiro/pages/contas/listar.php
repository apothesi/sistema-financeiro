<?php
include "../../config/config.php";
include "../../data/dados.php";
include "../../includes/auth.php";

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

<?php include "../../includes/header.php"; ?>
<?php include "../../includes/menu.php"; ?>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <?php
                if ($perfil == "proprietario") {
                    echo "Todas as Contas";
                } elseif ($perfil == "empresa") {
                    echo "Contas da Empresa";
                } else {
                    echo "Minhas Contas";
                }
            ?>
        </h2>
        <?php if ($perfil != "cliente") { ?>
            <a href="cadastrar.php" class="btn btn-success">+ Nova Conta</a>
        <?php } ?>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-success text-center">
                <div class="card-body">
                    <h6 class="card-title">Total a Receber</h6>
                    <h4>R$ <?php echo number_format($totalReceber, 2, ",", "."); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-danger text-center">
                <div class="card-body">
                    <h6 class="card-title">Total a Pagar</h6>
                    <h4>R$ <?php echo number_format($totalPagar, 2, ",", "."); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card <?php if ($saldo >= 0) { echo "text-bg-primary"; } else { echo "text-bg-warning"; } ?> text-center">
                <div class="card-body">
                    <h6 class="card-title">Saldo</h6>
                    <h4>R$ <?php echo number_format($saldo, 2, ",", "."); ?></h4>
                </div>
            </div>
        </div>
    </div>

    <?php if (empty($contasVisiveis)) { ?>
        <div class="alert alert-info">Nenhuma conta cadastrada.</div>
    <?php } else { ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <head class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Descricao</th>
                        <?php if ($perfil == "proprietario") { ?>
                            <th>Usuario</th>
                        <?php } ?>
                        <th>Tipo</th>
                        <th class="text-end">Valor</th>
                        <th class="text-center">Acoes</th>
                    </tr>
                </head>
                <body>
                    <?php foreach ($contasVisiveis as $conta) { ?>
                        <tr>
                            <td><?php echo $conta["id"]; ?></td>
                            <td><?php echo $conta["descricao"]; ?></td>
                            <?php if ($perfil == "proprietario") { ?>
                                <td><?php echo $conta["usuario"]; ?></td>
                            <?php } ?>
                            <td>
                                <?php if ($conta["tipo"] == "Receber") { ?>
                                    <span class="badge bg-success">Receber</span>
                                <?php } else { ?>
                                    <span class="badge bg-danger">Pagar</span>
                                <?php } ?>
                            </td>
                            <td class="text-end">R$ <?php echo number_format($conta["valor"], 2, ",", "."); ?></td>
                            <td class="text-center">
                                <?php 
                                    $podeEditar = false;
                                    if ($perfil == "proprietario") {
                                        $podeEditar = true;
                                    } elseif ($conta["usuario"] == $usuario) {
                                        $podeEditar = true;
                                    }
                                    
                                    if ($podeEditar) { 
                                ?>
                                    <a href="editar.php?id=<?php echo $conta["id"]; ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="excluir.php?id=<?php echo $conta["id"]; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta conta?')">Excluir</a>
                                <?php } else { ?>
                                    <span class="text-muted small">-</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </body>
            </table>
        </div>
    <?php } ?>

</div>

<?php include "../../includes/footer.php"; ?>
