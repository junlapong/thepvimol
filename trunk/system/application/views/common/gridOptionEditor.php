<?php 
	// Hide if permission is not allow to update
    if(($permCode & 0x2) > 0 ){
        echo "plugins: [editor],";
	}
?>