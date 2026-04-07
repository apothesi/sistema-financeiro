<?php
$perfil = $_SESSION["perfil"];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">Sistema Financeiro</a>
    
    <ul class="navbar-nav ms-auto">

      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
      </li>

      <?php if ($perfil == "cliente") { ?>
        <li class="nav-item">
          <a class="nav-link" href="contas/listar.php">Minhas Contas</a>
        </li>
      <?php } ?>
      
      <?php if ($perfil == "empresa") { ?>
        <li class="nav-item">
          <a class="nav-link" href="contas/listar.php">Contas da Empresa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contas/cadastrar.php">Cadastrar Conta</a>
        </li>
      <?php } ?>

      <?php if ($perfil == "proprietario") { ?>
        <li class="nav-item">
          <a class="nav-link" href="contas/listar.php">Todas as Contas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="usuarios/listar.php">Usuários</a>
        </li>
      <?php } ?>

      <li class="nav-item">
        <a class="nav-link" href="../logout.php">Sair</a>
      </li>
      
    </ul>
  </div>
</nav>
