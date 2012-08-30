<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Created by IntelliJ IDEA.
	 * User: OpenSkyMedia
	 * Date: 1/25/12
	 * Time: 10:15 PM
	 */
	class Project extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('ion_auth');
			$this->load->model('Projects_model');
			$this->load->library('Treeview');
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

		public function index($id)
		{
			$data['login']      = $this->login;
			$data['user_id']    = $this->user_id;
			$data['username']   = $this->user_name;
			$data['navigation']     = $this->treeview->buildmenu();
			$data['categories'] = $this->Projects_model->getCategories();
			$data['project']    = $this->Projects_model->getProject($id);
			$data['pledgedata'] = $this->Projects_model->getPledges($id);
			$data['page_title'] = 'Capital Team: Projects';
			$data['sidebar']    = 'sidebars/home-sidebar';
			$data['page']       = 'project/welcome';
			$this->load->view('container', $data);
		}
	}
