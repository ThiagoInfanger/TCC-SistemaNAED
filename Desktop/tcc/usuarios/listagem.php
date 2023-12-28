<?php
$titulo_html = "EDUC - Lista de usuários";
$titulo_pagina = "Lista de usuários";
include_once "../topo.php";

include_once "../validaracesso.php";

$url_listagem = $url_site . "usuarios/listagem.php";
$url_detalhes = $url_site . "usuarios/detalhe.php";

$query = "SELECT * FROM usuarios ORDER BY nome";
$arq = mysqli_query($conn, $query);
?>

<div class="col-12 text-end">
  <button type="button" class="btn btn-success" onclick="window.location.href = '<?php echo $url_detalhes ?>';">
    <i class="bi bi-plus"></i> Incluir
  </button>
</div>
<br/>
<div class="table-responsive-md">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th class="text-center">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($tab = mysqli_fetch_object ($arq)) { ?>
      <tr>
        <td><?php echo $tab->id ?></td>
        <td><?php echo $tab->nome ?></td>
        <td><?php echo $tab->email ?></td>
        <td class="text-end">
          
        <button type="button" class="btn btn-warning" onclick="window.location.href = '<?php echo $url_detalhes ?>?id=<?php echo $tab->id ?>';">
          <i class="bi bi-pencil-fill"></i>
        </button>
      </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <br><br><br><br><br><br><br><br>
</div>

<?php include_once "../rodape.php" ?>

