<?php

/*
 *------------------------------------------------------------------------------
 * Project Name  : Production Control
 *         Code  : TV-PDC
 *
 * Created Author: Thanachai $
 *         Date  : 2010/04/12
 *
 * Updated $Author:  $
 *         $Date:  $
 *         $Revision: 1.0 $
 *------------------------------------------------------------------------------
 *    copyright: Thepvimol Packaging Co., Ltd.
 *==============================================================================
 */

?>
<html>
<head>
<title>Production Control - Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="<?=base_url()?>system/images/favicon.ico" />
<link type="text/css" rel="stylesheet" href="<?=base_url()?>system/styles/common.css" />
<link type="text/css" rel="stylesheet" href="<?=base_url()?>system/styles/login.css" />
<script language="javascript" src="<?=base_url()?>system/scripts/jquery.js"></script>
<script language="javascript">
<!--

	function validate_submit()
	{
		var username = jQuery.trim($("#txt_username").val());
		var password = jQuery.trim($("#txt_password").val());
	
		if (username == "")
		{
			$("#msg").html("please insert username");
		}
		else if (password == "")
		{
			$("#msg").html("Please insert password");
		}
		else
		{
			$("#login_form").submit();
		}
	}

	$(document).ready(function() {

		$("#txt_username").attr('autocomplete', 'off');

		$("#txt_username").focus();

		$("#login_btn").click(function() {
			validate_submit();
		});

		$(".box").keypress(function(e) {
			if(e.which == 13)
			{
				validate_submit();
			}
		});
	});

//-->
</script>
</head>
<body>
<div id='div_login'>
<form id="login_form" method="POST"	action="<?= site_url('/login/authenticate') ?>">
<table width="100%" height="100%">
	<tr>
		<td align="center" valign="middle">
		<table id="login">
			<tr>
				<td colspan="2" height="38"></td>
			</tr>
			<tr>
				<td width="92" class="label">Username :</td>
				<td><input type="text" id="txt_username" name="username"
					value=""
					class="box box_search normal_button"  /></td>
			</tr>
			<tr>
				<td class="label">Password  :</td>
				<td><input type="password" id="txt_password" name="password"
					value=""
					class="box box_search normal_button"  /></td>
			</tr>
			<tr>
				<td></td>
				<td>
				<table class="fontNormal" cellspacing="0" cellpadding="0">
					<tr>
						<td class="label">
							<input type="checkbox" name="remember_pass" id="remember_pass"></td>
						<td><label for="remember_pass">Remember Password </label></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr id="page_button">
				<td></td>
				<td>
					<input type="button" id="login_btn" class="button button_login enable"> 
				</td>
			</tr>
			<tr height="18">
				<td></td>
				<td id="msg" class="error"><?= @$msg ?></td>
			</tr>
			<tr>
				<td colspan="2" height="5"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</form>
</div>
</body>

</html>