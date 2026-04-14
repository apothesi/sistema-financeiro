<?php
include "../../config/config.php";
include "../../data/dados.php";
include "../../includes/auth.php";

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

$contaEncontrada = null;
$indiceConta = -1;

foreach ($_SESSION["contas"] as $indice => $conta) {
    if ($conta["id"] == $id) {
        $contaEncontrada = $conta;
        $indiceConta = $indice;
        break;
    }
}

if ($contaEncontrada == null) {
    header("Location: listar.php");
    exit;
}

$perfil = $_SESSION["perfil"];
$usuario = $_SESSION["usuario"];

$podeExcluir = false;
if ($perfil == "proprietario") {
    $podeExcluir = true;
} elseif ($contaEncontrada["usuario"] == $usuario) {
    $podeExcluir = true;
}

if (!$podeExcluir) {
    header("Location: listar.php");
    exit;
}

if ($_POST) {
    $novasContas = [];
    foreach ($_SESSION["contas"] as $indice => $conta) {
        if ($indice != $indiceConta) {
            $novasContas[] = $conta;
        }
    }
    $_SESSION["contas"] = $novasContas;
    
    header("Location: listar.php");
    exit;
}
?>

<?php include "../../includes/header.php"; ?>
<?php include "../../includes/menu.php"; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card border-danger shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Confirmar Exclusao</h5>
                </div>
                <div class="card-body">
                    <p class="mb-1">Voce esta prestes a excluir a seguinte conta:</p>

                    <table class="table table-bordered mt-3">
                        <tr>
                            <th>Descricao</th>
                            <td><?php echo $contaEncontrada["descricao"]; ?></td>
                        </tr>
                        <tr>
                            <th>Valor</th>
                            <td>R$ <?php echo number_format($contaEncontrada["valor"], 2, ",", "."); ?></td>
                        </tr>
                        <tr>
                            <th>Tipo</th>
                            <td>
                                <?php if ($contaEncontrada["tipo"] == "Receber") { ?>
                                    <span class="badge bg-success">Receber</span>
                                <?php } else { ?>
                                    <span class="badge bg-danger">Pagar</span>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>

                    <p class="text-danger fw-semibold">Esta acao nao pode ser desfeita.</p>

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

<?php include "../../includes/footer.php"; ?>
