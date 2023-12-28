<?php
$titulo_html = "EDUC - Cadastro de usuários";
$titulo_pagina = "Cadastro de usuários";
include_once "../topo.php";

include_once "../validaracesso.php";

$url_listagem = $url_site . "usuarios/listagem.php";

$id = isset($_REQUEST["id"])?filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT):'';
$nome = isset($_REQUEST['nome'])?$_REQUEST['nome']:'';
$email = isset($_REQUEST['email'])?$_REQUEST['email']:'';
$senha = isset($_REQUEST['senha'])?$_REQUEST['senha']:'';

if (isset($_REQUEST['vez']) && $_REQUEST['vez']==2)
{
  $msg_url = $url_site . "usuarios/listagem.php";
  if ($_REQUEST['acao']=='Salvar')
  {
      if ($id=="")
      {
        $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('".$nome."','".$email."','".$senha."')";
        $msg = "Registro adicionado com sucesso!";
      }
      else
      {
        if ($senha=='')
        {
          $query = "UPDATE usuarios SET nome = '".$nome."', email = '".$email."' WHERE id = ".$id;
          $msg = "Registro alterado com sucesso! Senha NÃO foi alterada.";
        }
        else
        {
          $query = "UPDATE usuarios SET nome = '".$nome."', email = '".$email."', senha = '".$senha."' WHERE id = ".$id;
          $msg = "Registro alterado com sucesso! Senha foi ALTERADA também.";
        }
      }
  }
  if ($_REQUEST['acao']=='Excluir')
  {
    $query = "DELETE FROM usuarios WHERE id = ".$id;
    $msg = "Registro removido com sucesso!";
  }
  $arq = mysqli_query($conn, $query) or die(mysqli_error ()."<br/>".$query);
}
else
{
  if (isset($_REQUEST['id']))
  {
    $query = "SELECT * FROM usuarios WHERE id = ".$id;
    $arq = mysqli_query($conn, $query);
    $tab = mysqli_fetch_object ($arq);
    $id = $tab->id;
    $nome = $tab->nome;
    $email = $tab->email;
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
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
      </div><br/>
      <div class="form-group">
        <label for="senha">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha">
      </div><br/>
      <?php if ($id!=="") { ?>
        <button type="submit" name="acao" value="Excluir" class="btn btn-danger">Excluir</button>
      <?php } ?>
      <button type="submit" name="acao" value="Salvar" class="btn btn-success">Salvar</button>
      <button type="button" id="voltar" onclick=" window.location.href = '<?php echo $url_listagem ?>';" class="btn btn-secondary">Voltar</button>
    </form>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php include_once "../rodape.php" ?>
