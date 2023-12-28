<?php
$titulo_html = "EDUC - Situação da escola";
$titulo_pagina = "Situação da escola";
include_once "../topo.php";

include_once "../validaracesso.php";

$id = isset($_REQUEST["id"])?filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT):'';

if ($id!='')
{

    $url_listagem = $url_site . "escolas/listagem.php";
    $url_titulo = "Voltar para a lista de escolas";

    $query = "SELECT * FROM escolas WHERE id = ".$id;
    $arq = mysqli_query($conn, $query);
    $tab = mysqli_fetch_object ($arq);
    $id = $tab->id;
    $nomeescola = $tab->nome;
    $nometitulo = $nomeescola;

    $maiorano = date('Y');
    $menorano = date('Y');
    $maiormes = 12;
    $menormes = 1;

    $query = "SELECT MAX(nrano) AS maiorano, MIN(nrano) AS menorano, MAX(nrmes) AS maiormes, MIN(nrmes) AS menormes FROM fiscalizacoes WHERE idescola = ".$id;
    $arq = mysqli_query($conn, $query);
    if ($tab = mysqli_fetch_object ($arq))
        if ($tab->maiorano!="")
        {
            $maiorano = $tab->maiorano;
            $menorano = $tab->menorano;
            $maiormes = $tab->maiormes;
            $menormes = $tab->menormes;
        }

    $labels = [];
    $data = [];
    for($ano = $menorano; $ano <= $maiorano; $ano++)
    {
        for($mes = $menormes; $mes <= $maiormes; $mes++)
        {
            $labels[] = substr(obterNomeMes($mes),0,3)."/".$ano;
            $query = "SELECT * FROM fiscalizacoes WHERE idescola = $id AND nrmes = $mes AND nrano = $ano";
            $arq = mysqli_query($conn, $query) or die (mysqli_error ($conn)."<br/>".$query);
            if ($tab = mysqli_fetch_object ($arq))  
            {
                $data[] = getScore($tab);
            }
            else
            {
                $data[] = 'null';
            }
        }
    }
}
else
{
    $url_listagem = $url_site . "fiscalizacoes/listagem.php";
    $url_titulo = "Voltar para a lista de fiscalizações";

    $nometitulo = "Comparação dos scores";

    $query = "SELECT MAX(nrano) AS maiorano, MIN(nrano) AS menorano, MAX(nrmes) AS maiormes, MIN(nrmes) AS menormes FROM fiscalizacoes";
    $arq = mysqli_query($conn, $query);
    $tab = mysqli_fetch_object ($arq);
    $maiorano = $tab->maiorano;
    $menorano = $tab->menorano;
    $maiormes = $tab->maiormes;
    $menormes = $tab->menormes;

    $labels = [];
    for($ano = $menorano; $ano <= $maiorano; $ano++)
        for($mes = $menormes; $mes <= $maiormes; $mes++)
            $labels[] = substr(obterNomeMes($mes),0,3)."/".$ano;

    $data = [];
    $query = "SELECT * FROM escolas ORDER BY nome";
    $arqescolas = mysqli_query($conn, $query);
    while ($tabescolas = mysqli_fetch_object ($arqescolas))
    {
        $idescola = $tabescolas->id;
        $nomeescola = $tabescolas->nome;
        $dadosescola = [];
        for($ano = $menorano; $ano <= $maiorano; $ano++)
        {
            for($mes = $menormes; $mes <= $maiormes; $mes++)
            {
                $query = "SELECT * FROM fiscalizacoes WHERE idescola = $idescola AND nrmes = $mes AND nrano = $ano";
                $arq = mysqli_query($conn, $query);
                if ($tab = mysqli_fetch_object ($arq))  
                    $dadosescola[] = getScore($tab);
                else
                    $dadosescola[] = 'null';
            }
        }
        $data[] = ["id"=>$idescola, "nome"=>$nomeescola, "data"=>$dadosescola];
    }
    
}

?>

<h3><?php echo $nometitulo ?></h3>

<div>
  <canvas id="myChart" style="position: relative; height:50vh; width:80vw"></canvas>
</div>

 <script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: [<?php echo "'".implode("','",$labels)."'" ?>],
      datasets: [
        <?php if ($id!='') { ?>
            {
                label: 'Score',
                data: [<?php echo "'".implode("','",$data)."'" ?>],
                borderWidth: 1
            }
        <?php } else {
            foreach ($data as $dt) { ?>
                {
                    label: '<?php echo $dt['nome'] ?>',
                    data: [<?php echo "'".implode("','",$dt['data'])."'" ?>],
                    borderWidth: 1
                },
            <?php } ?>
        <?php } ?>
    ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<br/>
<form>
<p class="text-center">
    <button type="button" id="voltar" onclick=" window.location.href = '<?php echo $url_listagem ?>';" class="btn btn-secondary"><?php echo $url_titulo ?></button>
</p>
</form>

<?php include_once "../rodape.php" ?>
