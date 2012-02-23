<?php

/* 
 *------------------------------------------------------------------------------
 * Project Name  : Master Work Flow
 *         Code  : SFM-MWF1
 *
 * Created Author: Junlapong
 *         Date  : 2009/08/27 20:35
 * 
 * Updated $Author: Junlapong $
 *         $Date: 2009/10/12 12:11:47 $
 *         $Revision: 1.1 $
 *------------------------------------------------------------------------------
 *    copyright: e-Synergy Co., Ltd.
 *==============================================================================
 */

if (!defined('PHPJavaBridge')) { define('PHPJavaBridge', realpath(dirname(__FILE__) . '/java')); }

/**
 * e-Synergy PHPJavaBridge Class
 *
 * library for load PHPJavaBridge interface function
 *
 * @package		app/libraries
 * @author		Junlapong
 */

class JavaBridge {

	function __construct()
	{
		
		$CI =& get_instance();
		$CJ = $CI->config->item('java');

		if(!empty($CJ['java_host'])) {
			define ("JAVA_HOSTS", $CJ['java_host']);
		}
		 
		require_once PHPJavaBridge . '/Java.php';
	}

}
// END JavaBridge class

/* End of file JavaBridge.php */
/* Location: app/libraries/JavaBridge.php */
