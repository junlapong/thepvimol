<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Menu</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<!-- START COMMON CSS -->
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>system/styles/dtree.css" />
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>system/styles/menu.css" />
	<!-- END COMMON CSS -->
	
	<!-- START USER CSS -->
		
	<style type="text/css">
	
		#control {
			padding-left: 50px;
		}
	
		#menu_tree {
			margin-top: 5px;
		}
	
	</style>
	<!-- END USER CSS -->

	<!-- START COMMON JAVASCRIPT -->
	<script type="text/javascript" src="<?=base_url()?>system/scripts/jquery.js"></script>
	<script type="text/javascript" src="<?=base_url()?>system/scripts/dtree.js"></script>
	<!-- END COMMON JAVASCRIPT -->
	
	<!-- START USER JAVASCRIPT -->
	
	<script type="text/javascript">
	
		$(document).ready(function() {
			// frame check 
			setTimeout("frame_check()" ,500);
	        // end frame check
		});
	
	    function frame_check()
	    {
	        if($("#page_title", parent.frames[2].document).html() == null)
	        {
				parent.frames[2].location.reload();
	        }
	     }
		
	</script>
	<!-- END USER JAVASCRIPT -->
	
</head>
<body>
	<div class="dtree">
		<div id="container">
			<div id="control">
			<?php
				
				//$menus = $this->session->userdata('usermenu');
				
				//if (is_array($menus) && sizeof($menus) >0 ) // get from session in controller
				//{
					echo "<a href='javascript: menu.openAll();' >show all</a>"; 
					echo " | "; 
					echo "<a href='javascript: menu.closeAll();'>hide all</a>";
	    		//}

			?>
			
			</div>
			<div id="menu_tree">
			<script type="text/javascript">
				
				menu = new dTree('menu');
				/*//Sample
				menu.add(0,-1,'Production Control');
				menu.add(1,0,'Node 1','http://www.google.com','tooltip','main');
				menu.add(2,1,'Yahoo japan','http://www.yahoo.co.jp','yahoo japan','main');
				menu.add(3,2,'Node 1.1.1','link.html');
				*/
				<?php
				$menus = $this->session->userdata('usermenu');
				foreach ($menus as $row)
				{			
					echo "menu.add(";
					echo "'"  . $row->menu_code   . "'";
					echo ", '" . $row->parent_code . "'";
					echo ", '" . lang($row->menu_name) . "'";
	
					if ($row->menu_url != '')
					{
						echo ", '" . $row->menu_url . "'";
						echo ", '" . $row->menu_tooltip . "'";
						echo ", '" . $row->menu_target ."'";
					}
					
					echo ");\n";
				}
								
				?>

				document.write(menu);
				
			</script>
			</div>
		</div>
	</div>
</body>

</html>