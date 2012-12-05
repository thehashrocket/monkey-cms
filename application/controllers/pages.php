<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Created by IntelliJ IDEA.
	 * User: OpenSkyMedia
	 * Date: 11/22/12
	 * Time: 5:50 PM
	 */
	class Pages extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->helper('ckeditor');
			$this->load->library('ion_auth');
			$this->load->library('Treeview');
			$this->load->model('Pages_model');
			$this->load->model('Location_model');
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

		public function index($sectionid = 1, $pageid = 1, $houseid = 1)
		{

			$filename = underscore(strtolower($this->Pages_model->getPageName($pageid)));
			$data['filename'] = $filename;
			if (@file_exists(APPPATH."views/pages/{$filename}.php"))
			{
                $data['page']		= 'pages/' . $filename;

			} 

			elseif ($sectionid == 1 && $pageid == 1) {
				$data['page'] = 'pages/home';
			} 

			else {

				$data['page']		= 'pages/content';

			}

			$data['login']         = $this->login;
			$data['user_id']       = $this->user_id;
			$data['username']      = $this->user_name;
			$data['navigation']     = $this->treeview->buildmenu();
			$data['locations']		= $this->Location_model->getLocationsWithPhotos();
			$data['location']		= $this->Location_model->getLocationById($houseid);
			$data['pagelist']      = $this->Pages_model->getPageList($this->siteid);
			$data['page_title']    = $this->domain_model->getSiteTitle($this->siteid);
			$data['page_desc']     = $this->domain_model->getPageMetaDesc($this->siteid);
			$data['page_keywords'] = $this->domain_model->getPageMetaKeywords($this->siteid);
			$data['page_content']  = $this->Pages_model->getPageContent($this->siteid, $sectionid, $pageid);
			$data['sidebar']       = 'sidebars/permian_sidebar';

			$this->load->view('container', $data);
		}

		public function getPageList() {
			$this->Pages_model->getAjaxSidebarPageList($this->siteid);
	}


	}
