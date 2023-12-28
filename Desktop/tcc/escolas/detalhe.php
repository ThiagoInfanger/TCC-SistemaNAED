<?php
$titulo_html = "EDUC - Cadastro de escolas";
$titulo_pagina = "Cadastro de escolas";
include_once "../topo.php";

include_once "../validaracesso.php";

$url_listagem = $url_site . "escolas/listagem.php";

$id = isset($_REQUEST["id"])?filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT):'';
$nome = isset($_REQUEST['nome'])?$_REQUEST['nome']:'';
$qtdalunos = isset($_REQUEST["qtdalunos"])?filter_var($_REQUEST['qtdalunos'], FILTER_SANITIZE_NUMBER_INT):'0';
$endereco = isset($_REQUEST['endereco'])?$_REQUEST['endereco']:'';

if (isset($_REQUEST['vez']) && $_REQUEST['vez']==2)
{
  $msg_url = $url_site . "escolas/listagem.php";
  if ($_REQUEST['acao']=='Salvar')
  {
      if ($id=="")
      {
        $query = "INSERT INTO escolas (nome, qtdalunos, endereco) VALUES ('".$nome."',".$qtdalunos.", '".$endereco."')";
        $msg = "Registro adicionado com sucesso!";
      }
      else
      {
        $query = "UPDATE escolas SET nome = '".$nome."', qtdalunos = ".$qtdalunos.", endereco = '".$endereco."' WHERE id = ".$id;
        $msg = "Registro alterado com sucesso!";
      }
  }
  if ($_REQUEST['acao']=='Excluir')
  {
    $query = "DELETE FROM escolas WHERE id = ".$id;
    $msg = "Registro removido com sucesso!";
  }
  //$arq = mysqli_query($conn, $query) or die(mysqli_error ($conn)."<br/>".$query);


  if (!mysqli_query($conn, $query))
  {
    $error = mysqli_error ($conn);

    if (stripos($error, 'foreign key constraint fails') !== false) {
        $msg = "Houve um PROBLEMA na exclusão. Esta escola possuí já fiscalizações!";
        $msg_url = '';
    } else {
      die(mysqli_error ($conn)."<br/>".$query);
    }
  }

}
else
{
  if (isset($_REQUEST['id']))
  {
    $query = "SELECT * FROM escolas WHERE id = ".$id;
    $arq = mysqli_query($conn, $query);
    $tab = mysqli_fetch_object ($arq);
    $id = $tab->id;
    $nome = $tab->nome;
    $qtdalunos = $tab->qtdalunos;
    $endereco = $tab->endereco;
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
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome ?>">
      </div><br/>
      <div class="form-group">
        <label for="nome">Qtd. alunos</label>
        <input type="number" class="form-control" id="qtdalunos" name="qtdalunos" value="<?php echo $qtdalunos ?>">
      </div><br/>
      <div class="form-group">
        <label for="endereco">Endereço completo</label>
        <input type="endereco" class="form-control" id="endereco" name="endereco" value="<?php echo $endereco ?>">
      </div><br/>
      <?php if ($id!=="") { ?>
        <button type="submit" name="acao" value="Excluir" class="btn btn-danger">Excluir</button>
      <?php } ?>
      <button type="submit" name="acao" value="Salvar" class="btn btn-success">Salvar</button>
      <button type="button" id="voltar" onclick=" window.location.href = '<?php echo $url_listagem ?>';" class="btn btn-secondary">Voltar</button>
    </form>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php include_once "../rodape.php" ?>
