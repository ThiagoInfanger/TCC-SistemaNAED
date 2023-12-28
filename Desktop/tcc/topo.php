<?php include_once "config.php" ?>
<!DOCTYPE html>
<html lang="pt-br">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $titulo_html ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Estilo personalizado para o topo */
        .topo {
        background-color: #3e78b0;
        color: #fff;
        }

        /* Estilo personalizado para o rodapé */
        .rodape, .rodape span {
          background-color: #3e78b0;
          color: #fff;
        }

        .nav-item a {
          color: white;
        }

        .nav-item a:hover {
          color: #a8e3f1;
        }


        .span-30 {
          padding-left: 30px;
          padding-right: 30px;
        }

        .span-top-20
        {
          padding-top: 20px;
          padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
    <!-- Barra de navegação do topo -->
    <nav class="navbar navbar-expand-md topo">
      <a class="navbar-brand" href="<?php echo $url_site ?>home.php"><img src="<?php echo $url_site ?>images/logo.jpg" alt="" class="span-30"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ml-auto span-30">
          <li class="nav-item"><a class="nav-link" href="<?php echo $url_site ?>home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $url_site ?>usuarios/listagem.php">Usuários</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $url_site ?>escolas/listagem.php">Escolas</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $url_site ?>fiscalizacoes/listagem.php">Fiscalizações</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $url_site ?>sobre.php">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo $url_site ?>contato.php">Contato</a></li>
          <?php if (!isset($_SESSION['idusuario']) || $_SESSION['idusuario']=='') { ?>
            <li class="nav-item text-nowrap"><a class="nav-link" href="<?php echo $url_site ?>login.php"><i class="bi bi-file-earmark-person text-dark"></i> Identificar-se</a></li>
          <?php } else { ?>
            <li class="nav-item text-nowrap"><a class="nav-link" href="<?php echo $url_site ?>logout.php"><i class="bi bi-door-open-fill text-warning"></i> Sair (<?php echo $_SESSION['email'] ?>)</a></li>
          <?php } ?>
        </ul>
      </div>
    </nav>
  </header>
    
  <main>
    <div class="span-30 span-top-20">
    <h1><?php echo $titulo_pagina ?></h1>