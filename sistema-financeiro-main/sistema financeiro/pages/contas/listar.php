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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <?php
                $perfil = $_SESSION["perfil"];
                if ($perfil === "proprietario") echo "Todas as Contas";
                elseif ($perfil === "empresa")  echo "Contas da Empresa";
                else                            echo "Minhas Contas";
            ?>
        </h2>
        <?php if ($perfil !== "cliente"): ?>
            <a href="cadastrar.php" class="btn btn-success">+ Nova Conta</a>
        <?php endif; ?>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-success text-center">
                <div class="card-body">
                    <h6 class="card-title">Total a Receber</h6>
                    <h4>R$ <?php echo number_format($totalReceber, 2, ',', '.'); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-danger text-center">
                <div class="card-body">
                    <h6 class="card-title">Total a Pagar</h6>
                    <h4>R$ <?php echo number_format($totalPagar, 2, ',', '.'); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card <?php echo $saldo >= 0 ? 'text-bg-primary' : 'text-bg-warning'; ?> text-center">
                <div class="card-body">
                    <h6 class="card-title">Saldo</h6>
                    <h4>R$ <?php echo number_format($saldo, 2, ',', '.'); ?></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabela -->
    <?php if (empty($contasVisiveis)): ?>
        <div class="alert alert-info">Nenhuma conta cadastrada.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Descrição</th>
                        <?php if ($perfil === "proprietario"): ?>
                            <th>Usuário</th>
                        <?php endif; ?>
                        <th>Tipo</th>
                        <th class="text-end">Valor</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contasVisiveis as $conta): ?>
                        <tr>
                            <td><?php echo $conta["id"]; ?></td>
                            <td><?php echo htmlspecialchars($conta["descricao"]); ?></td>
                            <?php if ($perfil === "proprietario"): ?>
                                <td><?php echo htmlspecialchars($conta["usuario"]); ?></td>
                            <?php endif; ?>
                            <td>
                                <span class="badge <?php echo $conta["tipo"] === "Receber" ? 'bg-success' : 'bg-danger'; ?>">
                                    <?php echo $conta["tipo"]; ?>
                                </span>
                            </td>
                            <td class="text-end">R$ <?php echo number_format($conta["valor"], 2, ',', '.'); ?></td>
                            <td class="text-center">
                                <?php if (podeMexerNaConta($conta)): ?>
                                    <a href="editar.php?id=<?php echo $conta["id"]; ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="excluir.php?id=<?php echo $conta["id"]; ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Tem certeza que deseja excluir esta conta?')">Excluir</a>
                                <?php else: ?>
                                    <span class="text-muted small">—</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>

<?php include "../includes/footer.php"; ?>