<?php
include "config/config.php";
include "data/dados.php";

$erro = "";

if ($_POST) {
    foreach ($usuarios as $user) {
        if (
            $_POST["usuario"] == $user["usuario"] &&
            $_POST["senha"] == $user["senha"]
        ) {
            $_SESSION["usuario"] = $user["usuario"];
            $_SESSION["perfil"] = $user["perfil"];
            header("Location: pages/dashboard.php");
            exit;
        }
    }
    $erro = "Usuário ou senha inválidos!";
}
?>

<?php include "includes/header.php"; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="text-center mb-4">Login</h2>
            
            <?php if ($erro) { ?>
                <div class="alert alert-danger"><?php echo $erro; ?></div>
            <?php } ?>
            
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Usuário</label>
                    <input type="text" name="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
