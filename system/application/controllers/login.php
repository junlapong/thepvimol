<?php

class Login extends MY_Controller {

	function Login()
	{
		define ('LOGIN_PAGE', 'login_page');
		
		parent::MY_Controller();	
		$this->load->model('login_model', 'model',TRUE);
	}
	
	function index()
	{
		$this->load->view('login_view');
	}
	
    function authenticate()
    {
        $user  = $this->input->post('username');
        $pass  = $this->input->post('password');

        $query = $this->model->get_user($user);

        if ($query->num_rows() == 1)
        {
            list($row) = $query->result();

			$is_authen = false;
            //if ($row->AuthenMode == 1) // database authen
            //{
                $is_authen = $this->_authenticate_database($user, $pass);
            //}
            //elseif ($row->AuthenMode == 2)  // LDAP Authen
            //{
            //    $is_authen = $this->_authenticate_ldap($user, $pass);
            //}
			//else // invalid authentication mode
			//{
			//	
			//}

			if ($is_authen)
			{
				$this->_store_session($user);		
				// Goto index page
				redirect(site_url());
			}
			else // can't verify pass
			{
				$data['msg'] = lang('login_password_incorrect');
				$this->load->view('login_view', $data);
			}
        }
        else // error: user not exist
        {
            $data['msg'] = lang('login_username_incorrect');
			$this->load->view('login_view', $data);
        }
    }
    
	function logout()
    {    	
		$this->session->sess_destroy();
		
		delete_cookie('username');
		//delete_cookie('role');

		redirect(site_url('login'));
    }

	// authenticate via ldap acount
    function _authenticate_ldap($user, $pass)
    {
        // --- config ---
		$ldap_cfg		= $this->config->item('ldap');
        $domain_account = $user . $ldap_cfg['domain'];

        // --- connect ---
        $ldap = ldap_connect($ldap_cfg['host'], $ldap_cfg['port']);

        // --- binding ---
        $is_bind = @ldap_bind($ldap, $domain_account, $pass);

        return $is_bind;
    }

    // authenticate via database
    function _authenticate_database($user, $pass)
    {
		//echo sha1($pass);exit;
		
        $query     = $this->model->check_user($user, sha1($pass));
        list($row) = $query->result();
        $is_authen = $row->hasUser;

        return $is_authen;
    }

    function _store_session($user)
    {
		$remember_pass    	  = !is_empty($this->input->post('remember_pass'));				
		$user_groups	      = $this->model->get_user_groups($user);
		$user_menu        	  = $this->model->get_user_menu($user, $user_groups);
		
		foreach($user_menu as $key=>$value)
		{
			$screen_permission[$value->{'menu_name'}] = $value->{'permission'};
		} 
	
		$this->model->set_last_login($user);
		
        $newdata = array(
                   'username' 		=> $user,
        		   'groups' 	  	=> $user_groups,
                   'status'   		=> 'online',
        		   'usermenu'		=> $user_menu,
        		   'permission'     => $screen_permission
               );
		$this->session->sess_delete_after_browser_close	= TRUE;
        //set cookies
        if ($remember_pass)
        {
        	$this->session->sess_delete_after_browser_close	= FALSE;
			$login_user = array(
                   'name'   => 'username',
                   'value'  => $user,
                   'path'   => '/',
                   'expire' => $this->config->item('sess_expiration')
               );
            //$login_role = array(
            //       'name'   => 'role',
            //       'value'  => $user_role,
            //       'path'   => '/',
            //       'expire' => $this->config->item('sess_expiration')
            //   );               

            set_cookie($login_user);
            //set_cookie($login_role);
        }
        
        $this->session->set_userdata($newdata);
        
        // Clear temp report
		//$this->_clearTempReport();
					
        redirect(site_url());
    }    
    
    function _clearTempReport()
    {
    	$this->load->helper('file');
		$report		= $this->config->item('report');
		$dir 		= str_replace("\\", "/", realpath($report['tmp_dir']));
		$keep 		= strtotime("now") - $report['backkeepdays'];
		    	
    	$files 		= get_dir_file_info($dir);
		
    	foreach($files as $v)
    	{
    		if(stristr($v['server_path'], 'CVS') === FALSE)
    		{    		
	    		if(strtoupper(get_mime_by_extension($v['server_path'])) == "APPLICATION/PDF" && $v['mdate'] < $keep)
	    		{
	    			unlink($v['server_path']);
	    			$delete[] = $v['server_path'];
	    		}
    		}
    	}
    }
}

/* End of file login.php */
/* Location: ./system/application/controllers/login.php */