<?php
/*
   CECA Payment Module Copyright (c) 2007 ZhenIT

	 Valid for osCommerce, Zencart & soon for xt:commerce

  http://ZhenIT.com
  info@ZhenIT.com

  Released under the GNU General Public License

	No se limita la reutilizaci�n o mejora de este c�digo pero se ruega
	se mantengan los cr�ditos y las referencias a ZhenIT, tanto las
	expl�citas como en los nombres de ficheros o de funciones.

*/
define('PLATAFORMA','xtc');
if(xtc_db_num_rows(xtc_db_query('show tables like \''.TABLE_CONFIGURATION.'\''))!=0 && xtc_db_num_rows(xtc_db_query('describe '.TABLE_CONFIGURATION.' configuration_title'))==0){
    xtc_db_query('ALTER TABLE '.TABLE_CONFIGURATION.' ADD configuration_title VARCHAR( 64 )');
    xtc_db_query('ALTER TABLE '.TABLE_CONFIGURATION.' ADD configuration_description VARCHAR( 255 )');
}

function tep_db_query($query){
  return xtc_db_query($query);
}

function tep_db_fetch_array($query){
  return xtc_db_fetch_array($query);
}

function tep_db_num_rows($query)
{
  return xtc_db_num_rows($query);
}

function tep_db_input($string) {
  return xtc_db_input($string);
}

function tep_db_perform($table, $data, $action = 'insert', $parameters = '') {
  return xtc_db_perform($table, $data, $action, $parameters);
}

function tep_db_insert_id() {
  return mysql_insert_id();
}

function tep_draw_hidden_field($name, $value = '', $parameters = '') {
  return xtc_draw_hidden_field($name,$value,$parameters);
}

function tep_redirect($url) {
  xtc_redirect($url);
}

function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
  return xtc_href_link($page , $parameters, $connection , $add_session_id , $search_engine_safe);
}

function tep_cfg_pull_down_zone_classes($zone_class_id, $key = '') {
   return xtc_cfg_pull_down_zone_classes($zone_class_id, $key);
}
function tep_cfg_pull_down_order_statuses($zone_class_id, $key = '') {
   return xtc_cfg_pull_down_order_statuses($zone_class_id, $key);
}
function tep_get_order_status_name($zone_class_id, $key = '') {
   return xtc_get_order_status_name($zone_class_id, $key);
}
function tep_get_zone_class_title($zone_class_id, $key = '') {
   return xtc_get_zone_class_title($zone_class_id, $key);
}
function tep_cfg_select_option($select_array, $key_value, $key = '') {
   return xtc_cfg_select_option($select_array, $key_value, $key) ;
}
function tep_session_id($sessid = '') {
	return  xtc_session_id($sessid );
}
function tep_session_register($param) {
    return  xtc_session_register($param);
}
function tep_session_unregister($param) {
    return  xtc_session_unregister($param);
}
function tep_cfg_pull_down_tax_classes($tax_class_id, $key = '') {
    return  xtc_cfg_pull_down_tax_classes($tax_class_id, $key);
}
function tep_get_tax_class_title($tax_class_id) {
    return  xtc_get_tax_class_title($tax_class_id);
}
function tep_get_tax_rate($tax_class_id){
    return  xtc_get_tax_rate($tax_class_id);
}
function tep_get_tax_description($tax_class_id, $country, $zone){
    return  xtc_get_tax_description($tax_class_id, $country, $zone);
}
function tep_calculate_tax($amount, $rate){
    return  xtc_calculate_tax($amount, $rate);
}
function tep_get_prid($id){
  return xtc_get_prid($id);
}
?>