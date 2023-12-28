<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

$url_base = "http://localhost";
$url_site = $url_base."/tcc/";

// Configurações do banco de dados
$servername = "localhost"; // endereço do servidor do banco de dados
$username = "root"; // usuário do banco de dados
$password = ""; // senha do banco de dados
$dbname = "educ"; // nome do banco de dados

$conn = mysqli_connect($servername, $username, $password) or die(mysqli_error ());
mysqli_select_db ($conn, $dbname) or die(mysqli_error ());
mysqli_query($conn, "SET NAMES utf8mb4");  

function getValorInteiroOuVazio($chave, $padrao='')
{
  return isset($_REQUEST[$chave])?filter_var($_REQUEST[$chave], FILTER_SANITIZE_NUMBER_INT):$padrao;
}

function getIconeCondicoes($valor)
{
	return $valor==1?'bi-hand-thumbs-up-fill text-success':'bi-hand-thumbs-down text-danger';
}

function getIconeScore($valor)
{
	if ($valor<5)
		return 'bi-shield-fill-x text-danger';
	
	if ($valor<8)
		return 'bi-shield-fill-exclamation text-warning';

	return 'bi-shield-fill-check text-success';	
}

function getScore($tab)
{
	// o score é dado com base nos perfils 50% para aluno, 30% para professor e 20% para diretor
	return ($tab->nrestruturaaluno*6 + $tab->nrestruturaprofessor*3 + + $tab->nrestruturadiretor*1);
}

function obterNomeMes($numeroMes) {
    $meses = array(
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro'
    );

    return $meses[$numeroMes];
}


function debug($var) {
	echo "<hr/><pre>";
	if (is_array($var)||is_object($var)) {
		print_r($var);
	} else {
		echo "<hr>".$var."<hr>";
	}
	echo "</pre><hr/>";
}


?>