<?php
$titulo_html = "EDUC - Login";
$titulo_pagina = "Login";
include_once "topo.php";

$url_padrao = $url_site . "home.php";

$origem = isset($_REQUEST['origem'])?$_REQUEST['origem']:$url_padrao;
$email = isset($_REQUEST['email'])?$_REQUEST['email']:'';

if (isset($_REQUEST['vez']) && $_REQUEST['vez']==2)
{
  $query = "SELECT id, email, senha FROM usuarios WHERE email = '".$_REQUEST['email']."'";
  $arq = mysqli_query($conn, $query);
  $tab = mysqli_fetch_object ($arq);
  if ($tab->email==$_REQUEST['email'] && $tab->senha==$_REQUEST['senha'])
  {
    $_SESSION['idusuario'] = $tab->id;
    $_SESSION['email'] = $tab->email;
    header("Location: $origem");
    exit;
  }
  else
  {
    $msg = 'E-mail ou senha inválidos! Tente novamente.';
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
    <input type="hidden" value="<?php echo $origem ?>" name="origem" />
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
      </div><br/>
      <div class="form-group">
        <label for="senha">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha">
      </div><br/>
      <button type="submit" name="acao" value="Salvar" class="btn btn-success">Entrar</button>
    </form>


<?php include_once "rodape.php" ?>