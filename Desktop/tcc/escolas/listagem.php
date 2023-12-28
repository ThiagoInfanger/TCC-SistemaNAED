<?php
$titulo_html = "EDUC - Lista de escolas";
$titulo_pagina = "Lista de escolas";
include_once "../topo.php";

include_once "../validaracesso.php";

$url_listagem = $url_site . "escolas/listagem.php";
$url_detalhes = $url_site . "escolas/detalhe.php";
$url_grafico = $url_site . "escolas/grafico.php";

$query = "SELECT * FROM escolas ORDER BY nome";
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
        <th>Qtd. alunos</th>
        <th>Endereço</th>
        <th class="text-center">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($tab = mysqli_fetch_object ($arq)) { ?>
      <tr>
        <td><?php echo $tab->id ?></td>
        <td><?php echo $tab->nome ?></td>
        <td><?php echo $tab->qtdalunos ?></td>
        <td><?php echo $tab->endereco ?></td>
        <td class="text-end text-nowrap">
        
        <button type="button" class="btn btn-dark" onclick="window.location.href = '<?php echo $url_grafico ?>?id=<?php echo $tab->id ?>';">
          <i class="bi bi-file-bar-graph-fill"></i>
        </button>

        <button type="button" class="btn btn-warning" onclick="window.location.href = '<?php echo $url_detalhes ?>?id=<?php echo $tab->id ?>';">
          <i class="bi bi-pencil-fill"></i>
        </button>
      
      </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <br><br><br>

</div>

<?php include_once "../rodape.php" ?>

