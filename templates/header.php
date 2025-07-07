<?php
// AdoPET/templates/header.php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdoPET - <?php echo $page_title ?? 'Bem-vindo'; ?></title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="shortcut icon" href="./uploads/paw-heart.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <?php
        // É crucial iniciar a sessão antes de qualquer saída HTML para usar $_SESSION
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        ?>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <nav class="navbar">
            <div class="nav-left">
                <a href="index.php">
                    <div class="icon-page">
                        <img src="../../AdoPET-main/AdoPET/static/img/pet.png" alt="" style="width: 50px; height:50px;">
                    </div>
                adoPET
                </a>
            </div>

        <div class="nav-center">
                <form class="form-inline my-10 my-lg-10">
                    <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                </form>
        </div>
            <div class="nav-right-section">
                <div class="animal-menu dropdown"> Animais <i class="fas fa-angle-down"></i>
                    <div class="dropdown-content">
                        <a href="adicionar_animal.php">Anunciar</a>
                        <a href="animais.php">Disponíveis</a>
                        <a href="#">Adotados</a>
                    </div>
                </div>
                <a href="contato.php">Contato</a>
                <a href="sobre.php">Sobre Nós</a>
            </div>

            <div class="btn-auth">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-menu dropdown">
                        <button class="user-name drpbtn">
                            Olá, <?php echo htmlspecialchars(explode(' ', $_SESSION['user_name'])[0]); ?>! <i class="fas fa-angle-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="dashboard.php">Meu Painel</a>
                            <a href="editar_perfil.php">Editar Perfil</a>
                            <a href="logout.php">Sair</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="login">
                        <button class="btn-login" onclick="window.location.href='login.php'">Login</button>
                    </div>
                    <div class="sign-up">
                        <button class="btn-sign-up" onclick="window.location.href='cadastro.php'">Cadastre-se</button>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <?php if (isset($_SESSION['flash_message'])): ?>
            <ul class="flashes">
                <li class="<?php echo $_SESSION['flash_message']['type']; ?>">
                    <?php echo $_SESSION['flash_message']['message']; ?>
                </li>
            </ul>
            <?php unset($_SESSION['flash_message']); ?>
        <?php endif; ?>