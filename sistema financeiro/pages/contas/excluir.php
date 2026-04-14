<?php
include "../config/config.php";
include "../data/dados.php";
include "../includes/auth.php";

$id    = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
$conta = getContaPorId($id);

if (!$conta || !podeMexerNaConta($conta)) {
    header("Location: listar.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    excluirConta($id);
    header("Location: listar.php?msg=excluido");
    exit;
}
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/menu.php"; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card border-danger shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">⚠ Confirmar Exclusão</h5>
                </div>
                <div class="card-body">
                    <p class="mb-1">Você está prestes a excluir a seguinte conta:</p>

                    <table class="table table-bordered mt-3">
                        <tr>
                            <th>Descrição</th>
                            <td><?php echo htmlspecialchars($conta["descricao"]); ?></td>
                        </tr>
                        <tr>
                            <th>Valor</th>
                            <td>R$ <?php echo number_format($conta["valor"], 2, ',', '.'); ?></td>
                        </tr>
                        <tr>
                            <th>Tipo</th>
                            <td>
                                <span class="badge <?php echo $conta["tipo"] === "Receber" ? 'bg-success' : 'bg-danger'; ?>">
                                    <?php echo $conta["tipo"]; ?>
                                </span>
                            </td>
                        </tr>
                    </table>

                    <p class="text-danger fw-semibold">Esta ação não pode ser desfeita.</p>

                    <div class="d-flex gap-2 mt-3">
                        <form method="post" class="d-inline">
                            <button type="submit" class="btn btn-danger">Sim, excluir</button>
                        </form>
                        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>