<?php
$titulo_html = "EDUC - Lista de fiscalizações";
$titulo_pagina = "Lista de fiscalizações";
include_once "../topo.php";

include_once "../validaracesso.php";

$url_listagem = $url_site . "fiscalizacoes/listagem.php";
$url_detalhes = $url_site . "fiscalizacoes/detalhe.php";
$url_grafico = $url_site . "escolas/grafico.php";

$query = "SELECT fiscalizacoes.*, escolas.nome AS nomeescola 
FROM fiscalizacoes
LEFT JOIN escolas ON fiscalizacoes.idescola = escolas.id
ORDER BY fiscalizacoes.nrano DESC, fiscalizacoes.nrmes DESC";
$arq = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>

<div class="col-12 text-end">
  <button type="button" class="btn btn-dark" onclick="window.location.href = '<?php echo $url_grafico ?>';">
          <i class="bi bi-file-bar-graph-fill"></i> Comparar escolas
  </button>

  <button type="button" class="btn btn-success" onclick="window.location.href = '<?php echo $url_detalhes ?>';">
    <i class="bi bi-plus"></i> Incluir
  </button>
</div>
<br/>
<div class="table-responsive-md">
  <table class="table table-bordered">
    <thead>
      <tr>
         <th rowspan="2" class="align-middle">Score</th>
         <th rowspan="2" class="align-middle">Escola</th>
         <th rowspan="2" class="align-middle">Ano</th>
         <th rowspan="2" class="align-middle">Mês</th>
         <th colspan="3" class="text-center align-middle">Estrutura adequada</th>
         <th rowspan="2" class="text-center align-middle">Ação</th>
      </tr>
      <tr>
        <th class="text-center align-middle">Alunos</th>
        <th class="text-center align-middle">Professores</th>
        <th class="text-center align-middle">Diretores</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($tab = mysqli_fetch_object ($arq)) { ?>
      <tr>
        <td class="text-start align-middle">
            <div class="text-nowrap">
              <h3>
                <i class="bi <?php echo getIconeScore(getScore($tab)) ?>">
              <?php echo getScore($tab); ?>
            </i></h3>
            </div>
        </td>
        <td><?php echo $tab->nomeescola ?></td>
        <td><?php echo $tab->nrano ?></td>
        <td><?php echo obterNomeMes($tab->nrmes) ?></td>
        <td class="text-center align-middle">
          <h3><i class="bi <?php echo getIconeCondicoes($tab->nrestruturaaluno) ?>"></i></h3>
        </td>
        <td class="text-center align-middle">
          <h3><i class="bi <?php echo getIconeCondicoes($tab->nrestruturaprofessor) ?>"></i></h3>
        </td>
        <td class="text-center align-middle">
          <h3><i class="bi <?php echo getIconeCondicoes($tab->nrestruturadiretor) ?>"></i></h3>
        </td>
        <td class="text-end">
          <button type="button" class="btn btn-warning" onclick="window.location.href = '<?php echo $url_detalhes ?>?id=<?php echo $tab->id ?>';">
            <i class="bi bi-pencil-fill"></i>
          </button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>

</div>

<?php include_once "../rodape.php" ?>

