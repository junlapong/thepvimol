<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>header</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?=base_url()?>system/scripts/jquery.js"></script>
<script language="javascript" src="<?=base_url()?>system/scripts/date.format.js"></script>
<link type="text/css" rel="stylesheet" href="<?=base_url()?>system/styles/header.css" />
<base target="main" />

<script type="text/javascript" >

	$(document).ready(function() {
		// frame check 
		setTimeout("showTime()", 0);
		setTimeout("frame_check()", 500);
	    // end frame check
	});
	
	function frame_check()
	{
	    if($("#page_title", parent.frames[2].document).html() == null)
	    {
			parent.frames[2].location.reload();
	    }
	}

    var topFrameColsSize = "235,*";

    function showMenu()
    {
        var topFrame = window.top.document.getElementById("topFrame");
        document.body.focus();

        if (topFrame.cols != "0,*")
        {
            topFrameColsSize = topFrame.cols;
            topFrame.cols = "0,*";
            $("#menu_icon").attr('src', '<?=base_url()?>system/images/icon/application_side_expand.png');
        }
        else
        {
            topFrame.cols = topFrameColsSize;
            $("#menu_icon").attr('src', '<?=base_url()?>system/images/icon/application_side_contract.png');
        }
    }
	
	var d = new Date();
    var server_time = <?= time() * 1000 ?>;
    var diff_time   = server_time - d.getTime();
    	
	function showTime() 
	{
        var now = new Date();
        now.setTime(now.getTime() + diff_time);

        var date_time = now.format("yyyy/mm/dd HH:MM:ss");
        $("#system_time").html(date_time);

        setTimeout("showTime()", 1000);
    }

    function logout()
    {
        window.open("<?= site_url('login/logout') ?>", "_top");
    }

    function home()
    {
        window.open("<?= site_url('dashboard') ?>", "main");
    }

</script>
</head>

<body>
<?php
	$status = $this->session->userdata('status');
	$username = $this->session->userdata('username');
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0" id="table_main">
    <tr>    
        <td nowrap="nowrap">
        	<div style="width:250px; padding-left: 5px">
        		<img src="<?=base_url()?>system/images/thep_logo.gif" style="cursor:pointer;"/>
        		<img src="<?=base_url()?>system/images/Prod_logo.gif" onclick="home()" style="cursor:pointer;"/>
        	</div>
        </td>
        <td align="right">
        	<div style="width:500px">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr class="bar">
                    <td id="bar_curv"></td>
					<td class="bar_text">
						<img src="<?=base_url()?>system/images/clock.png" />
					</td>
					<td class="bar_text" style="text-align:left;" width="110">
					<font id='system_time'></font>
					</td>
					<td class="bar_gab"></td>
                    <td class="bar_text">
                    	<img id="menu_icon" src="<?=base_url()?>system/images/icon/application_side_contract.png"
                    	     onclick="showMenu();" style="cursor:pointer;" />
                    </td>
                    <td class="bar_text" onclick="showMenu()" style="cursor:pointer">
                    	<?= lang('header_menu') ?>
                    </td>
                    <td class="bar_gab"></td>
                    <td class="bar_text"><img src="<?=base_url()?>system/images/icon/user.png" /></td>
                    <td class="bar_text"><?= $username?></td>
                    <td class="bar_gab"></td>
                    <td class="bar_text">
                    	<img src="<?=base_url()?>system/images/icon/lock_go.png"
                    	     onclick="logout();" style="cursor:pointer;" />
                    </td>
                    <td class="bar_text" onclick="logout()" style="cursor:pointer">
                    	<?= lang('login_button_logout') ?>
                    </td>
                </tr>
            </table>
         	</div>
        </td>
        <td width="9" class="bar"></td>
    </tr>
</table>
</body>

</html>