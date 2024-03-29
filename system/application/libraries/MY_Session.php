<?php 

/*
 *------------------------------------------------------------------------------
 * Project Name  : Master Work Flow
 *         Code  : SFM-MWF1
 *
 * Created Author: Sira.o
 *         Date  : 2009/09/29
 *
 * Updated $Author: sira.o $
 *         $Date: 2009/10/16 05:03:00 $
 *         $Revision: 1.2 $
 *------------------------------------------------------------------------------
 *    copyright: e-Synergy Co., Ltd.
 *==============================================================================
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author sira.o
 *
 */
class MY_Session extends CI_Session
{	
//	/*
//	 * Override constructor
//	 */
	var $sess_delete_after_browser_close	= TRUE;
	function CI_Session($params = array())
	{
		log_message('debug', "Session Class Initialized");

		// Set the super object to a local variable for use throughout the class
		$this->CI =& get_instance();
		
		// Set all the session preferences, which can either be set 
		// manually via the $params array above or via the config file
		foreach (array('sess_encrypt_cookie', 'sess_use_database', 'sess_table_name', 'sess_expiration', 'sess_match_ip', 'sess_match_useragent', 'sess_cookie_name', 'cookie_path', 'cookie_domain', 'sess_time_to_update', 'sess_delete_after_browser_close', 'time_reference', 'cookie_prefix', 'encryption_key') as $key)
		{
			$this->$key = (isset($params[$key])) ? $params[$key] : $this->CI->config->item($key);
		}		
	
		// Load the string helper so we can use the strip_slashes() function
		$this->CI->load->helper('string');

		// Do we need encryption? If so, load the encryption class
		if ($this->sess_encrypt_cookie == TRUE)
		{
			$this->CI->load->library('encrypt');
		}

		// Are we using a database?  If so, load it
		if ($this->sess_use_database === TRUE AND $this->sess_table_name != '')
		{
			$this->CI->load->database();
		}

		// Set the "now" time.  Can either be GMT or server time, based on the
		// config prefs.  We use this to set the "last activity" time
		$this->now = $this->_get_time();

		// Set the session length. If the session expiration is
		// set to zero we'll set the expiration two years from now.
		if ($this->sess_expiration == 0)
		{
			$this->sess_expiration = (60*60*24*365*2);
            $this->sess_delete_after_browser_close = false;
		}
        elseif($this->sess_expiration == -1)
        {
            $this->sess_expiration = 60*60*24;
            $this->sess_delete_after_browser_close = true;
        }
		 				
		// Set the cookie name
		$this->sess_cookie_name = $this->cookie_prefix.$this->sess_cookie_name;
	
		// Run the Session routine. If a session doesn't exist we'll 
		// create a new one.  If it does, we'll update it.
		if ( ! $this->sess_read())
		{
			$this->sess_create();
		}
		else
		{	
			$this->sess_update();
		}
		
		// Delete 'old' flashdata (from last request)
	   	$this->_flashdata_sweep();
		
		// Mark all new flashdata as old (data will be deleted before next request)
	   	$this->_flashdata_mark();

		// Delete expired sessions if necessary
		$this->_sess_gc();

		log_message('debug', "Session routines successfully run");
	}

	/*
	 * @ Override _set_cookie , change setcookie() Line@ 136
	 */
	function _set_cookie($cookie_data = NULL)
	{		
		if (is_null($cookie_data))
		{
			$cookie_data = $this->userdata;
		}
		// Serialize the userdata for the cookie
		$cookie_data = $this->_serialize($cookie_data);
			
		if ($this->sess_encrypt_cookie == TRUE)
		{
			$cookie_data = $this->CI->encrypt->encode($cookie_data);
		}
		else
		{
			// if encryption is not used, we provide an md5 hash to prevent userside tampering
			$cookie_data = $cookie_data.md5($cookie_data.$this->encryption_key);
		}

		// Set the cookie		
		setcookie(
					$this->sess_cookie_name,
					$cookie_data,
					($this->sess_delete_after_browser_close == true) ? 0 : ($this->sess_expiration + time()),
					$this->cookie_path,
					$this->cookie_domain,
					0
				);
	}
	
	function _serialize($data)
	{	
		if (is_array($data))
		{
			$i	= 0;
			foreach ($data as $key => $val)
			{
				if (!is_object($val))
				{
					$data[$key] = str_replace('\\', '{{slash}}', $val);
				}
				$i++;
			}
		}
		else
		{
			if (!is_object($data))
			{
				$data = str_replace('\\', '{{slash}}', $data);
			}
		}
		return serialize($data);
	}
	
	function _unserialize($data)
	{		
		//require_once(APPPATH . 'Models/PM/class/ProductRegist.php');
		//require_once(APPPATH . 'Models/PM/class/ProductByVendor.php');
		//require_once(APPPATH . 'Models/PM/class/VendorDiscountBean.php');
		//require_once(APPPATH . 'Models/PM/class/VendorPriceBean.php');
		$data = @unserialize(strip_slashes($data));

		if (is_array($data))
		{
			$i	= 0;
			foreach ($data as $key => $val)
			{
				if (!is_object($val) && gettype($val) != 'object')
				{
					$data[$key] = str_replace('{{slash}}', '\\', $val);
				}
				$i++;
			}

			return $data;
		}
		else
		{
			if (is_object($data))
			{
				print_r($data);
				return $data;
			}
		}

		return str_replace('{{slash}}', '\\', $data);
	}

	function sess_update()
	{
	   // skip the session update if this is an AJAX call!
	    if( !( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') ))
	   {
	       parent::sess_update();
	   }
	} 

}

// END MY_Session class

/* End of file MY_Session */
/* Location: application/libraries/MY_Session.php */