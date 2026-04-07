<?php $perfil = $_SESSION["perfil"]; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="../pages/dashboard.php">Sistema Financeiro</a>
        <ul class="navbar-nav ms-auto">

            <?php if ($perfil == "cliente") { ?>
                <!-- falta o link de Minhas Contas -->
            <?php } ?>

            <?php if ($perfil == "empresa") { ?>
                <li class="nav-item">
                    <a href="cadastrar.php">Cadastrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=""></a>
                </li>
            <?php } ?>

            <?php if ($perfil == "proprietario") { ?>
                <li class="nav-item">
                    <a href="cadastrar.php">Cadastrar</a>
                </li>
            <?php } ?>

            <li class="nav-item">
                <a href="../logout.php">Sair</a>
            </li>

        </ul>
    </div>
</nav>
