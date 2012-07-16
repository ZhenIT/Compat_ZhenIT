<?
/*
   CECA Payment Module Copyright (c) 2007 ZhenIT

	 Valid for osCommerce, Zencart & soon for xt:commerce

  http://ZhenIT.com
  info@ZhenIT.com

  Released under the GNU General Public License

	No se limita la reutilización o mejora de este código pero se ruega
	se mantengan los créditos y las referencias a ZhenIT, tanto las
	explícitas como en los nombres de ficheros o de funciones.

*/
define('PLATAFORMA','zen');
function tep_db_query($query)
{
        global $db;
        return($db->Execute($query));
}

function tep_db_fetch_array(&$query){
  if(!$query->EOF){
    $array = $query->fields;
    $query->MoveNext();
    return $array;
  }
  return false;
}

function tep_db_num_rows($query)
{
        return($query->RecordCount());
}

function tep_db_input($string) {
  if (function_exists('mysql_escape_string')) {
    return mysql_escape_string($string);
  }
  return addslashes($string);
}

function tep_db_perform($table, $data, $action = 'insert', $parameters = '') {
  reset($data);
  if ($action == 'insert') {
    $query = 'insert into ' . $table . ' (';
    while (list($columns, ) = each($data)) {
      $query .= $columns . ', ';
    }
    $query = substr($query, 0, -2) . ') values (';
    reset($data);
    while (list(, $value) = each($data)) {
      switch ((string)$value) {
        case 'now()':
          $query .= 'now(), ';
          break;
        case 'null':
          $query .= 'null, ';
          break;
        default:
          $query .= '\'' . tep_db_input($value) . '\', ';
          break;
      }
    }
    $query = substr($query, 0, -2) . ')';
  } elseif ($action == 'update') {
    $query = 'update ' . $table . ' set ';
    while (list($columns, $value) = each($data)) {
      switch ((string)$value) {
        case 'now()':
          $query .= $columns . ' = now(), ';
          break;
        case 'null':
          $query .= $columns .= ' = null, ';
          break;
        default:
          $query .= $columns . ' = \'' . tep_db_input($value) . '\', ';
          break;
      }
    }
    $query = substr($query, 0, -2) . ' where ' . $parameters;
  }

  return tep_db_query($query);
}

function tep_db_insert_id() {
  return mysql_insert_id();
}

function tep_draw_hidden_field($name, $value = '', $parameters = '') {
  return zen_draw_hidden_field($name,$value,$parameters);
}

function tep_redirect($url) {
  zen_redirect($url);
}

function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
  if(preg_match("/(&)?error_message=([^&]*)/",$parameters,$m)){
    global $messageStack;
    if(is_object($messageStack))
        $messageStack->add_session('checkout_payment', $m[2], 'error');
    $parameters = '';
  }
  return zen_href_link($page , $parameters, $connection , $add_session_id , $search_engine_safe);
}

function tep_cfg_pull_down_zone_classes($zone_class_id, $key = '') {
   return zen_cfg_pull_down_zone_classes($zone_class_id, $key);
}
function tep_cfg_pull_down_order_statuses($zone_class_id, $key = '') {
   return zen_cfg_pull_down_order_statuses($zone_class_id, $key);
}
function tep_get_order_status_name($zone_class_id, $key = '') {
   return zen_get_order_status_name($zone_class_id, $key);
}
function tep_get_zone_class_title($zone_class_id, $key = '') {
   return zen_get_zone_class_title($zone_class_id, $key);
}

function tep_cfg_select_option($select_array, $key_value, $key = '') {
   return zen_cfg_select_option($select_array, $key_value, $key) ;
}
function tep_session_id($sessid = '') {
	return  zen_session_id($sessid );
}
function tep_session_register($param) {
    return  zen_session_register($param);
}
function tep_session_unregister($param) {
    return  zen_session_unregister($param);
}
function tep_cfg_pull_down_tax_classes($tax_class_id, $key = '') {
    return  zen_cfg_pull_down_tax_classes($tax_class_id, $key);
}
function tep_get_tax_class_title($tax_class_id) {
    return  zen_get_tax_class_title($tax_class_id);
}

function tep_get_tax_rate($tax_class_id){
    return  zen_get_tax_rate($tax_class_id);
}
function tep_get_tax_description($tax_class_id, $country, $zone){
    return  zen_get_tax_description($tax_class_id, $country, $zone);
}
function tep_calculate_tax($amount, $rate){
    return  zen_calculate_tax($amount, $rate);
}
function tep_get_prid($id){
  return zen_get_prid($id);
}
function tep_not_null($variable){
  return zen_not_null($variable);
}
function tep_session_is_registered($variable) {
    if (PHP_VERSION < 4.3) {
      return session_is_registered($variable);
    } else {
      return isset($_SESSION) && array_key_exists($variable, $_SESSION);
    }
}
function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
  return zen_image($src, $alt, $width, $height, $parameters);
}
function tep_image_button($image, $alt = '', $parameters = '') {
  global $language;
  return zen_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
}
function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
  return zen_image(DIR_WS_IMAGES . $image, '', $width, $height);
}
function tep_catalog_href_link($page = '', $parameters = '', $connection = 'NONSSL') {
  return zen_catalog_href_link($page , $parameters , $connection );
}
function tep_call_function($function, $parameter, $object = '') {
  return zen_call_function($function, $parameter, $object = '');
}
function tep_get_all_get_params($exclude_array = ''){
  return zen_get_all_get_params($exclude_array);
}
function tep_db_prepare_input($sql){
  return zen_db_prepare_input($sql);
}
function tep_date_short($raw_date){
  return zen_date_short($raw_date);
}
function tep_datetime_short($raw_datetime) {
  return zen_datetime_short($raw_date);
}
function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
  return zen_draw_pull_down_menu($name, $values, $default, $parameters, $required);
}
function tep_draw_input_field($name, $value = '', $parameters = '', $required = false, $type = 'text', $reinsert_value = true){
  return zen_draw_input_field($name, $value = '', $parameters = '', $required = false, $type = 'text', $reinsert_value = true);
}
function tep_draw_form($name, $action, $parameters = '', $method = 'post', $params = ''){
  return zen_draw_form($name, $action, $parameters , $method, $params );
}
function tep_image_submit($image, $alt = '', $parameters = '') {
  return zen_image_submit($image, $alt, $parameters);
}
function tep_hide_session_id() {
  return zen_hide_session_id();
}
function tep_address_format($address_format_id, $address, $html, $boln, $eoln) {
  return zen_address_format($address_format_id, $address, $html, $boln, $eoln) ;
}
function tep_display_tax_value($value, $padding = TAX_DECIMAL_PLACES) {
  return zen_display_tax_value($value, $padding);
}
function tep_add_tax($price, $tax, $override = false) {
  return zen_add_tax($price, $tax, $override );
}
function tep_db_output($string) {
  return zen_db_output($string);
}
function tep_draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
  return zen_draw_textarea_field($name, $wrap, $width, $height, $text, $parameters, $reinsert_value);
}
function tep_draw_checkbox_field($name, $value = '', $checked = false, $compare = '') {
  return zen_draw_checkbox_field($name, $value , $checked , $compare);
}
function tep_draw_radio_field($name, $value = '', $checked = false, $compare = '') {
  return zen_draw_radio_field($name, $value , $checked , $compare );
}
function tep_get_category_name($category_id, $language_id) {
  return zen_get_category_name($category_id, $language_id);
}
function tep_get_country_name($country_id){
  return zen_get_country_name($country_id);
}
function tep_get_languages(){
  return zen_get_languages();
}
?>