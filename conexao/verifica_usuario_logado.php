<?php
#
// Iniciando a session
#
@session_start();

if(isset($_SESSION['login_admin']) && isset($_SESSION['senha_admin'])) {
	// se existe as sessões coloca os valores em uma varivel
	$login_admin = $_SESSION['login_admin'];
	$senha_admin = $_SESSION['senha_admin'];
} else {
	header("Location: falha_login.php");
	exit;
}
?>
