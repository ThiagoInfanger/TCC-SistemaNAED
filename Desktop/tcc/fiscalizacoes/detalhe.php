<?php
$titulo_html = "EDUC - Fiscalizações nas escolas";
$titulo_pagina = "Fiscalizações nas escolas";
include_once "../topo.php";

include_once "../validaracesso.php";

$url_listagem = $url_site . "fiscalizacoes/listagem.php";

$id = getValorInteiroOuVazio('id');
$idescola = getValorInteiroOuVazio('idescola');
$nrmes = getValorInteiroOuVazio('nrmes');
$nrano = getValorInteiroOuVazio('nrano');
$nrestruturaaluno = getValorInteiroOuVazio('nrestruturaaluno',0);
$nrestruturaprofessor = getValorInteiroOuVazio('nrestruturaprofessor',0);
$nrestruturadiretor = getValorInteiroOuVazio('nrestruturadiretor',0);

if (isset($_REQUEST['vez']) && $_REQUEST['vez']==2)
{

  if ($_REQUEST['acao']=='Salvar' && ($idescola=='' || $nrano == '' || $nrmes == ''))
  {
    $msg = "Informe todos os campos antes de salvar!";
  }
  else
  {
    $msg_url = $url_site . "fiscalizacoes/listagem.php";
    if ($_REQUEST['acao']=='Salvar')
    {
        if ($id=="")
        {
          $query = "INSERT INTO fiscalizacoes (idescola, nrmes, nrano, nrestruturaaluno,
          nrestruturaprofessor, nrestruturadiretor) 
          VALUES ($idescola, $nrmes, $nrano, $nrestruturaaluno, 
          $nrestruturaprofessor, $nrestruturadiretor)";
          $msg = "Registro adicionado com sucesso!";
        }
        else
        {
          $query = "UPDATE fiscalizacoes SET idescola = $idescola,
                                             nrmes = $nrmes,
                                             nrano = $nrano,
                                             nrestruturaaluno = $nrestruturaaluno,
                                             nrestruturaprofessor = $nrestruturaprofessor,
                                             nrestruturadiretor = $nrestruturadiretor
                                            WHERE id = $id";
          $msg = "Registro alterado com sucesso!";
        }
    }
    if ($_REQUEST['acao']=='Excluir')
    {
      $query = "DELETE FROM fiscalizacoes WHERE id = ".$id;
      $msg = "Registro removido com sucesso!";
    }
    if (!mysqli_query($conn, $query))
    {
      $error = mysqli_error ($conn);

      if (stripos($error, 'duplicate entry') !== false) {
          $msg = "Já existe um lançamento para esta escola neste mês e ano";
          $msg_url = '';
      } else {
        die(mysqli_error ($conn)."<br/>".$query);
      }
    }
  } // validação 
}
else
{
  if (isset($_REQUEST['id']))
  {
    $query = "SELECT * FROM fiscalizacoes WHERE id = $id";
    $arq = mysqli_query($conn, $query);
    $tab = mysqli_fetch_object ($arq);
    $id = $tab->id;
    $idescola = $tab->idescola;
    $nrmes = $tab->nrmes;
    $nrano = $tab->nrano;
    $nrestruturaaluno = $tab->nrestruturaaluno;
    $nrestruturaprofessor = $tab->nrestruturaprofessor;
    $nrestruturadiretor = $tab->nrestruturadiretor;
  } 
}

?>
<script>
  var msg = '';
  var msg_url = '';

<?php if (isset($msg) && $msg!="") { ?>
  msg = '<?php echo $msg ?>';
  <?php if (isset($msg_url) && $msg_url!="") { ?>
    msg_url = '<?php echo $msg_url ?>';
  <?php } ?>
<?php } ?>
 
    function mensagem() {
      if (msg!='')
      {
        alert(msg);
        if (msg_url!='')
          window.location.href = msg_url;
      }
    }

    window.addEventListener("load", (event) => {
      mensagem();
    });

</script>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <input type="hidden" value="2" name="vez" />
    <input type="hidden" value="INCLUIR" name="modo" />
    <input type="hidden" name="id" value="<?php echo $id ?>" />
      <div class="form-group">
        <label for="idescola">Escola</label>
        <select class="form-control" name="idescola" id="idescola">
          <option value="">Selecione uma opção</option>
          <?php 
          $query = "SELECT * FROM escolas ORDER BY nome";
          $arq = mysqli_query($conn, $query);
          while ($tab = mysqli_fetch_object ($arq)) { ?>
              <option <?php echo $tab->id==$idescola?'selected':'' ?> value="<?php echo $tab->id ?>"><?php echo $tab->nome ?></option>
          <?php } ?>
        </select>
      </div><br/>
      <div class="form-group">
        <label for="nrmes">Mês</label>
        <select class="form-control" name="nrmes" id="nrmes">
          <option value="">Selecione uma opção</option>
          <option <?php echo $nrmes==1?'selected':'' ?> value="1">Janeiro</option>
          <option <?php echo $nrmes==2?'selected':'' ?> value="2">Fevereiro</option>
          <option <?php echo $nrmes==3?'selected':'' ?> value="3">Março</option>
          <option <?php echo $nrmes==4?'selected':'' ?> value="4">Abril</option>
          <option <?php echo $nrmes==5?'selected':'' ?> value="5">Maio</option>
          <option <?php echo $nrmes==6?'selected':'' ?> value="6">Junho</option>
          <option <?php echo $nrmes==7?'selected':'' ?> value="7">Julho</option>
          <option <?php echo $nrmes==8?'selected':'' ?> value="8">Agosto</option>
          <option <?php echo $nrmes==9?'selected':'' ?> value="9">Setembro</option>
          <option <?php echo $nrmes==10?'selected':'' ?> value="10">Outubro</option>
          <option <?php echo $nrmes==11?'selected':'' ?> value="11">Novembro</option>
          <option <?php echo $nrmes==11?'selected':'' ?> value="12">Dezembro</option>
        </select>
      </div><br/>
      <div class="form-group">
        <label for="nrano">Ano</label>
        <input type="number" class="form-control" id="nrano" name="nrano" value="<?php echo $nrano ?>">
      </div><br/>
      <div class="form-group">
        <span>Estrutura adequada para os alunos:</span>
        <div class="form-group">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="nrestruturaaluno" <?php echo $nrestruturaaluno==1?'checked':'' ?> value="1"> Sim
        </label>
        &nbsp;
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="nrestruturaaluno" <?php echo $nrestruturaaluno==0?'checked':'' ?> value="0"> Não
        </label>
        </div>
      </div>
      <br/>

      <div class="form-group">
        <span>Estrutura adequada para os professores:</span>
        <div class="form-group">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="nrestruturaprofessor" <?php echo $nrestruturaprofessor==1?'checked':'' ?> value="1"> Sim
        </label>
        &nbsp;
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="nrestruturaprofessor" <?php echo $nrestruturaprofessor==0?'checked':'' ?> value="0"> Não
        </label>
        </div>
      </div>
      <br/>

      <div class="form-group">
        <span>Estrutura adequada para os diretores:</span>
        <div class="form-group">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="nrestruturadiretor" <?php echo $nrestruturadiretor==1?'checked':'' ?> value="1"> Sim
        </label>
        &nbsp;
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="nrestruturadiretor" <?php echo $nrestruturadiretor==0?'checked':'' ?> value="0"> Não
        </label>
        </div>
      </div>
      <br/>

      <?php if ($id!=="") { ?>
        <button type="submit" name="acao" value="Excluir" class="btn btn-danger">Excluir</button>
      <?php } ?>
      <button type="submit" name="acao" value="Salvar" class="btn btn-success">Salvar</button>
      <button type="button" id="voltar" onclick=" window.location.href = '<?php echo $url_listagem ?>';" class="btn btn-secondary">Voltar</button>
    </form>

<?php include_once "../rodape.php" ?>
