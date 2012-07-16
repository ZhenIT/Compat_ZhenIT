<?php
/*
$Id: payment_ZhenIT.php 144 2011-11-30 13:23:42Z  $

  Utilities for Payment Modules Copyright (c) 2007 ZhenIT

	 Valid for osCommerce, Zencart & soon for xt:commerce

  http://ZhenIT.com
  info@ZhenIT.com

  Released under the GNU General Public License

	No se limita la reutilizaci�n o mejora de este c�digo pero se ruega
	se mantengan los cr�ditos y las referencias a ZhenIT, tanto las
	expl�citas como en los nombres de ficheros o de funciones.

*/
class payment_ZhenIT {
  var $code, $zcode, $title, $description, $enabled,$sort_order,$debug;
// class constructor
  function payment_ZhenIT($code,$zcode) {
    global $order;
    $this->debug = false;
    if($this->debug){
      @ini_set('display_errors', '1');
      error_reporting(E_ALL);
    } else {
      error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    }
    if(PLATAFORMA=='xtc'){
      $this->load_config_description();
    }
    $this->code = $code;
    $this->zcode = $zcode;
    $this->title = @constant('MODULE_PAYMENT_'.$this->zcode.'_TEXT_TITLE');
    $this->enabled = ((@constant('MODULE_PAYMENT_'.$this->zcode.'_STATUS') == 'S�') ? true : ((@constant('MODULE_PAYMENT_'.$this->zcode.'_STATUS') == 'True')?true:false));
    $this->sort_order = @constant('MODULE_PAYMENT_'.$this->zcode.'_SORT_ORDER');
    if (is_object($order)) $this->update_status();
  }

  function trace($log,$force = false){
    if(!$this->debug && !$force)
      return;
    if(is_writable(DIR_FS_CATALOG . '/images/'.$this->code.'.log')){
      $fp = fopen (DIR_FS_CATALOG . '/images/'.$this->code.'.log', "a+");
      fwrite($fp,date("Y-m-d H:i:s")." - ".$log."\n");
      fclose($fp);
    }else{
      print $log."\n";
    }
  }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)constant('MODULE_PAYMENT_'.$this->zcode.'_ZONE') > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . constant('MODULE_PAYMENT_'.$this->zcode.'_ZONE') . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return false;
    }
    function output_error() {
      return false;
    }

    function check() {
      $this->trace("check()");
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_".$this->zcode."_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
			$sql="DROP TABLE IF EXISTS ".$this->code;
      $result=tep_db_query($sql);
    }

    function keys() {
      return array();
    }

    function load_config_description(){
      $query = tep_db_query("select configuration_key,configuration_title, configuration_description from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");

      while ($row = tep_db_fetch_array($query)){
        define($row['configuration_key']."_DESC",$row['configuration_description']);
        define($row['configuration_key']."_TITLE",$row['configuration_title']);
      }
    }
}?>