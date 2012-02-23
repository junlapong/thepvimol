<?php

/*
 *------------------------------------------------------------------------------
 * Description  : Customize language module
 *------------------------------------------------------------------------------
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Language extends CI_Language
{	
	function set_lang($locale)
	{
		$support_lang = array( 'en' => 'english', 'th' => 'thai');

		$locale = substr($locale, 0, 2);
		$lang   = array_key_exists($locale, $support_lang) ? $support_lang[$locale] : 'english';

		//$this->load('common', $lang);
		$this->load('screen', $lang);
	}
	
	/**
	 * overide CI_Language::line
	 * @see system/libraries/CI_Language#line($line)
	 */
/*	function line($word = '')
	{
		if (is_empty($word) OR ! isset($this->language[$word]))
		{
			$translate = $word;
		}
		else
		{
			$translate = $this->language[$word];
		}

		return $translate;
	}
	*/
}

// END MY_Language class

/* End of file MY_Language.php */
/* Location: application/libraries/MY_Language.php */