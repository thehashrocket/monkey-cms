<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Created by IntelliJ IDEA.
	 * User: OpenSkyMedia
	 * Date: 1/25/12
	 * Time: 5:50 PM
	 */
	class Pages extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('ion_auth');
			$this->load->library('Treeview');
			$this->load->model('Pages_model');
			$this->siteid = $this->domain_model->getUID();
			$siteid = $this->domain_model->getUID();
			if (!$this->ion_auth->logged_in()) {
				$this->login     = 'false';
				$this->user_id   = '';
				$this->user_name = '';
			} else {
				$user            = $this->ion_auth->user()->row();
				$this->user_id   = $user->id;
				$this->user_name = $user->username;
				$this->login     = 'true';
			}
		}

		public function index($sectionid = 1, $pageid = 1)
		{
			$data['login']         = $this->login;
			$data['user_id']       = $this->user_id;
			$data['username']      = $this->user_name;
			$data['navigation']     = $this->treeview->buildmenu();
			$data['pagelist']      = $this->Pages_model->getPageList($this->siteid);
			$data['page_title']    = $this->domain_model->getSiteTitle($this->siteid);
			$data['page_desc']     = $this->domain_model->getPageMetaDesc($this->siteid);
			$data['page_keywords'] = $this->domain_model->getPageMetaKeywords($this->siteid);
			$data['page_content']  = $this->Pages_model->getPageContent($this->siteid, $sectionid, $pageid);
			$data['sidebar']       = 'sidebars/home-sidebar';
			$data['page']          = 'pages/home';
			$this->load->view('container', $data);
		}

		public function getPageList() {
			$this->Pages_model->getAjaxSidebarPageList($this->siteid);
	}


	}
