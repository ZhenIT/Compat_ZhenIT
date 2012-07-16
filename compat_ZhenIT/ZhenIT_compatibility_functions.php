<?php
/*
$Id:$

  Utilities for Payment Modules Copyright (c) 2007 ZhenIT

	 Valid for osCommerce, Zencart & soon for xt:commerce

  http://ZhenIT.com
  info@ZhenIT.com

  Released under the GNU General Public License

	No se limita la reutilizaci�n o mejora de este c�digo pero se ruega
	se mantengan los cr�ditos y las referencias a ZhenIT, tanto las
	expl�citas como en los nombres de ficheros o de funciones.

*/
if(!class_exists ('httpClient'))
    require_once(DIR_FS_CATALOG.'includes/classes/http_client.php');
if(function_exists('zen_href_link')){
	include_once(DIR_FS_CATALOG.'includes/compat_ZhenIT/ZhenIT_zencart_compatibility_functions.php');
}
elseif(function_exists('xtc_href_link')){
	include_once(DIR_FS_CATALOG.'includes/compat_ZhenIT/ZhenIT_xtc_compatibility_functions.php');
} else {
  define('PLATAFORMA','tep');
}
include(DIR_FS_CATALOG.'includes/compat_ZhenIT/classes/payment_ZhenIT.php');

function ZhenIT_get_params($exclude_array = '') {
	global $_REQUEST;

	if (!is_array($exclude_array)) $exclude_array = array();

	$get_url = '';
	if (is_array($_REQUEST) && (sizeof($_REQUEST) > 0)) {
		reset($_REQUEST);
		while (list($key, $value) = each($_REQUEST)) {
			if ( (strlen($value) > 0) && ($key != tep_session_name()) && ($key != 'error') && (!in_array($key, $exclude_array)) && ($key != 'x') && ($key != 'y') ) {
				$get_url .= $key . '=' . rawurlencode(stripslashes($value)) . '&';
			}
		}
	}
	return $get_url;
}
////
// Redirect to another page or site
function ZhenIT_redirect($url) {
	if ( (strstr($url, "\n") != false) || (strstr($url, "\r") != false) ) {
		tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false));
	}

	if ( (ENABLE_SSL == true) && (getenv('HTTPS') == 'on') ) { // We are loading an SSL page
		if (substr($url, 0, strlen(HTTP_SERVER)) == HTTP_SERVER) { // NONSSL url
			$url = HTTPS_SERVER . substr($url, strlen(HTTP_SERVER)); // Change it to SSL
		}
	}

	header('Location: ' . $url);
	echo "<script type='text/javascript'>document.location.href='".$url."'</script>";
	tep_exit();
}
?>