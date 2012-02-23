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
 *         $Date: 2009/10/12 12:11:46 $
 *         $Revision: 1.1 $
 *------------------------------------------------------------------------------
 *    copyright: e-Synergy Co., Ltd.
 *==============================================================================
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * str_nbsp
 *
 * @access	public
 * @param	string
 * @return	string
 */
if (!function_exists('str_nbsp'))
{
	function str_nbsp($str)
	{
		if (is_empty($str)) {
			$str = "&nbsp;";
		}

		return $str;
	}
}

// ------------------------------------------------------------------------

/**
 * is_empty
 *
 * @access	public
 * @param	string
 * @return	string
 */
if (!function_exists('is_empty'))
{
	function is_empty($str)
	{
		return (strlen(trim($str)) == 0);
	}
}

// ------------------------------------------------------------------------


/* End of file MY_string_helper.php */
/* Location: application/helpers/MY_string_helper.php */