<?php
include "../config/config.php";
include "../data/dados.php";
include "../includes/auth.php"; 
?>

<?php include "../includes/header.php"; ?>

<?php include "../includes/menu.php"; ?>  

<div class="container">
    <h1>Bem-vindo, <?php echo $_SESSION["usuario"]; ?>!</h1>
    <p>Perfil: <?php echo $_SESSION["perfil"]; ?></p>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h5 class="card-title">Contas a Receber</h5>
                    <p class="card-text">R$ 1.200,00</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Contas a Pagar</h5>
                    <p class="card-text">R$ 800,00</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>
