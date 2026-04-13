<?php
include "../config/config.php";
include "../data/dados.php";
include "../includes/auth.php";

if ($_SESSION["perfil"] === "cliente") {
    header("Location: listar.php");
    exit;
}

$erro    = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $descricao = trim($_POST["descricao"] ?? "");
    $valor     = $_POST["valor"] ?? "";
    $tipo      = $_POST["tipo"] ?? "";

    if ($descricao === "" || $valor === "" || !in_array($tipo, ["Receber", "Pagar"])) {
        $erro = "Preencha todos os campos corretamente.";
    } elseif (!is_numeric($valor) || (float)$valor <= 0) {
        $erro = "O valor deve ser um número positivo.";
    } else {
        adicionarConta($descricao, (float)$valor, $tipo);
        $sucesso = "Conta cadastrada com sucesso!";
    }
}
?>

<?php include "../includes/header.php"; ?>
<?php include "../includes/menu.php"; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Nova Conta</h2>
                <a href="listar.php" class="btn btn-secondary">← Voltar</a>
            </div>

            <?php if ($erro): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
            <?php endif; ?>

            <?php if ($sucesso): ?>
                <div class="alert alert-success">
                    <?php echo $sucesso; ?>
                    <a href="listar.php" class="alert-link ms-2">Ver lista</a>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Descrição</label>
                            <input type="text" name="descricao" class="form-control"
                                   value="<?php echo htmlspecialchars($_POST['descricao'] ?? ''); ?>"
                                   placeholder="Ex: Aluguel, Mensalidade..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Valor (R$)</label>
                            <input type="number" name="valor" class="form-control" step="0.01" min="0.01"
                                   value="<?php echo htmlspecialchars($_POST['valor'] ?? ''); ?>"
                                   placeholder="0,00" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Tipo</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" value="Receber" id="receber"
                                        <?php echo (($_POST['tipo'] ?? '') === 'Receber') ? 'checked' : ''; ?>>
                                    <label class="form-check-label text-success fw-semibold" for="receber">
                                        ✔ Receber
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" value="Pagar" id="pagar"
                                        <?php echo (($_POST['tipo'] ?? '') === 'Pagar') ? 'checked' : ''; ?>>
                                    <label class="form-check-label text-danger fw-semibold" for="pagar">
                                        ✖ Pagar
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Salvar Conta</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>