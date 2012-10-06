<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Created by JetBrains PhpStorm.
	 * User: OpenSkyMedia
	 * Date: 12/14/11
	 * Time: 2:24 PM
	 */
	class Client extends CI_Controller
	{
		public $uid;

		function __construct()
		{
			parent::__construct();

			$this->load->library('ion_auth');
			$this->load->library('Treeview');
			$this->load->model('Client_model');
			$this->load->model('Gallery_model');
			$this->load->model('Category_model');
			$this->load->model('Pages_model');
			$this->load->model('Faq_model');
			$this->load->helper('ckeditor');
			$this->siteid = $this->domain_model->getUID();

			if (!$this->ion_auth->logged_in()) {
				$this->login     = 'false';
				$this->user_id   = '';
				$this->user_name = '';
			} else {
				$user                    = $this->ion_auth->user()->row();
				$this->user_id           = $user->id;
				$this->user_name         = $user->username;
				$this->login             = 'true';
				$this->thumb_size_width  = '500';
				$this->thumb_size_height = '300';
				$this->max_image_size    = '1000';
				$this->gallery_path      = realpath(APPPATH . '../assets/images/gallery');
				$this->gallery_path_url  = base_url() . 'assets/images/gallery/';
			}
		}

		function index($userid = NULL, $pageid = NULL)
		{
			if (!$this->ion_auth->logged_in()) {
				redirect('/auth/login/');
			} else {

				//Ckeditor's configuration
				$data['ckeditor'] = array(

					//ID of the textarea that will be replaced
					'id'      => 'pagededitor',
					'path'    => 'assets/js/ckeditor',

					//Optionnal values
					'config'  => array(
						// 'toolbar'     => "Basic", //Using the Full toolbar
						'toolbar'		=> array(
							array('Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates'),
							array('Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About'),
							array('Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe')
							),
						'width'       => "550px", //Setting a custom width
						'height'      => '500px', //Setting a custom height

					),

					//Replacing styles from the "Styles tool"
					'styles'  => array(

						//Creating a new style named "style 1"
						'style 1' => array(
							'name'         => 'Blue Title',
							'element'      => 'h2',
							'styles'       => array(
								'color'               => 'Blue',
								'font-weight'         => 'bold'
							)
						)
					)
				);


				$data['login']         = $this->login;
				$data['user_id']       = $this->user_id;
				$data['username']      = $this->user_name;
				$data['navigation']     = $this->treeview->buildmenu();
				$data['photos']        = $this->Gallery_model->profile_get_images_from_db($this->user_id);
				$data['clientdata']    = $this->Client_model->getClientProfile($this->user_id);
				$data['pagelist']      = $this->Pages_model->getClientPageList($this->user_id);
				$data['faqs']			= $this->Projects_model->getFAQProfile($this->user_id);
				$data['pagedata']      = $this->Pages_model->getPagedata($this->user_id, $pageid);
				$data['page_title']    = $this->domain_model->getSiteTitle($this->siteid);
				$data['page_desc']     = $this->domain_model->getPageMetaDesc($this->siteid);
				$data['page_keywords'] = $this->domain_model->getPageMetaKeywords($this->siteid);
				$data['page']          = '/client/welcome_message'; // pass the actual view to use as a parameter
				$this->load->view('/client/container', $data);
			}
		}

		function catUpdate()
		{
			$strlen = strlen((string)$this->input->post('idcategories'));

			if ($strlen == 0) {
				$idcategories = '';
			} else {
				$idcategories = (string)$this->input->post('idcategories');
			}

			$catname  = (string)$this->input->post('catname', TRUE);
			$catdesc  = (string)$this->input->post('catdesc', TRUE);
			$uid      = $this->user_id;

			$this->Category_model->updateCategories($idcategories, $catname, $catdesc, $uid);
		}

		function deleteCategory()
		{
			$cat_id = (string)$this->input->post('idcategories');
			$this->Category_model->deleteCategory($cat_id);
		}

		function deleteFaq()
		{
			$faq_id = (string)$this->input->post('idfaq_table');
			$this->Faq_model->deleteFaq($faq_id);
		}

		function deletephoto($id)
		{
			$redirect = '/client/index';
			$this->load->model('Gallery_model');
			$this->Gallery_model->deleteImage($id, $redirect);
		}

		function deletePledge($id)
		{
			$redirect = '/client/index';
			$this->load->model('Projects_model');
			$this->Projects_model->deletePledge($id, $redirect);
		}

		function faqUpdate()
		{

			$strlen = strlen((string)$this->input->post('idfaq_table'));

			if ($strlen == 0) {
				$faq_id = '';
			} else {
				$faq_id = (string)$this->input->post('idfaq_table');
			}

			$question = (string)$this->input->post('question', TRUE);
			$answer   = (string)$this->input->post('answer', TRUE);
			$uid      = $this->user_id;
			$redirect = "/client/index";

			$this->Faq_model->updateFAQ($faq_id, $question, $answer, $uid, $redirect);
		}

		// Updates Gallery Table
		// Receives input from /client/index
		function gallery_up()
		{
			$config = array(
				'allowed_types' => 'jpg|jpeg|gif|png',
				'upload_path'   => $this->gallery_path,
				'max_size'      => $this->max_image_size
				);

			$this->load->library('upload', $config);
			$this->upload->do_upload();
			$image_data = $this->upload->data();

			$config = array(
				'source_image'   => $image_data['full_path'],
				'new_image'      => $this->gallery_path . '/thumbs',
				'maintain_ratio' => TRUE,
				'width'          => $this->thumb_size_width,
				'height'         => $this->thumb_size_height
			);

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$upload = $this->upload->data();

			$data = array(
				'photo_id'      => 0, // I GUESS IS AUTO_INCREMENT
				'photoname'     => $upload['file_name'],
				'thumb'         => $this->gallery_path_url . 'thumbs/' . $upload['file_name'],
				'fullsize'      => $this->gallery_path_url . $upload['file_name'],
				'userid'        => $this->user_id,
			);

			$this->Gallery_model->do_upload($data);

			$url = (string)$this->input->post('redirect', TRUE);
			redirect($url);
		}

		function getCatList()
		{

			$this->Category_model->getAjaxCategoryList($this->user_id);
		}

		function getFAQList()
		{

			$this->Faq_model->getAjaxFAQList($this->user_id);
		}

		function getPageDetails()
		{
			$page_id = $this->input->get_post('pageid', TRUE);
			$this->Pages_model->getAjaxPagedata($this->user_id, $page_id);
		}

		function pageDelete()
		{
			$uid          = $this->user_id;
			$siteid       = $this->siteid;
			$pageid  = (string)$this->input->post('pageid', TRUE);
			$this->Pages_model->deletePage($uid, $siteid, $pageid);
			echo 'here i am';
		}

		function pageUpdate()
		{
				$this->load->helper('htmlpurifier');
				$strlen = strlen((string)$this->input->post('pageid'));

				if ($strlen == 0) {
					$pageid = '';
				} else {
					$pageid = (string)$this->input->post('pageid');
				}
				$pagename     = (string)$this->input->post('pagename', TRUE);
				$pageheadline = (string)$this->input->post('pageheadline', TRUE);
				$pagecontent  = html_purify($this->input->post('pagecontent', FALSE));
				$parentpage   = (string)$this->input->post('parentpage', TRUE);
				$sectionid		= '1'; // TODO: I need to create support for sections/categories.
				$uid          = $this->user_id;
				$siteid       = $this->siteid;

				$this->Pages_model->updatePage($pageid, $pagename, $pageheadline, $pagecontent, $parentpage, $sectionid, $uid, $siteid);

//				$this->save_routes();
		}

		function profileUpdate()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="alert-box error">', '</div>');

			$this->form_validation->set_rules('bill_firstname', 'First Name', 'required|trim');
			$this->form_validation->set_rules('bill_lastname', 'Last Name', 'required|trim');
			$this->form_validation->set_rules('bill_company', 'Company Name', 'required|trim');
			$this->form_validation->set_rules('bill_email', 'Email Address', 'required|trim');
			$this->form_validation->set_rules('bill_street', 'Street Address', 'required|trim');
			$this->form_validation->set_rules('bill_city', 'City Address', 'required|trim');
			$this->form_validation->set_rules('bill_state', 'State Address', 'required|trim');
			$this->form_validation->set_rules('bill_zip', 'Zip Address', 'required|trim');

			if ($this->form_validation->run() == FALSE) {
				$proj_id               = $this->Client_model->get_project_id();
				$data['login']         = $this->login;
				$data['user_id']       = $this->user_id;
				$data['username']      = $this->user_name;
				$data['navigation']     = $this->treeview->buildmenu();
				$data['photos']        = $this->Gallery_model->profile_get_images_from_db($proj_id);
				$data['projdata']      = $this->Projects_model->getProjectProfile($this->user_id);
				$data['pledgedata']    = $this->Projects_model->getPledgeProfile($this->user_id);
				$data['clientdata']    = $this->Client_model->getClientProfile($this->user_id);
				$data['pagelist']      = $this->Pages_model->getClientPageList($this->user_id);
				$data['categories']    = $this->Projects_model->getCategories();
				$data['page_title']    = $this->domain_model->getSiteTitle($this->siteid);
				$data['page_desc']     = $this->domain_model->getPageMetaDesc($this->siteid);
				$data['page_keywords'] = $this->domain_model->getPageMetaKeywords($this->siteid);
				$data['page']          = '/client/welcome_message'; // pass the actual view to use as a parameter
				$this->load->view('/client/container', $data);
			} else {
				// validation has passed. Now send to model
				$uid       = $this->user_id;
				$firstname = (string)$this->input->post('bill_firstname', TRUE);
				$lastname  = (string)$this->input->post('bill_lastname', TRUE);
				$company   = (string)$this->input->post('bill_company', TRUE);
				$email     = (string)$this->input->post('bill_email', TRUE);
				$street    = (string)$this->input->post('bill_street', TRUE);
				$city      = (string)$this->input->post('bill_city', TRUE);
				$state     = (string)$this->input->post('bill_state', TRUE);
				$zip       = (string)$this->input->post('bill_zip', TRUE);
				$redirect  = "/client/index";

				$this->Client_model->updateProfile($uid, $firstname, $lastname, $company, $email, $street, $city, $state, $zip, $redirect);
			}

		}

		// This function gets run whenever the order of the pages is changed within the client area. It's fired from
		// the reorder function in app.js.
		function saveOrder()
		{

			$items = $this->input->post('item');
			$total_items = count($this->input->post('item'));

			for ($item = 0; $item < $total_items; $item++) {

				$data = array(
					'pageid' => $items[$item],
					'rank'   => $item
				);

				$this->db->where('pageid', $data['pageid']);

				$this->db->update('pages', $data);

			}

			$this->save_routes();
		}

		public function save_routes()
		{

			// this simply returns all the pages from my database
			$routes = $this->Pages_model->getPageList($this->siteid);

			// write out the PHP array to the file with help from the file helper
			if (!empty($routes)) {
				// for every page in the database, get the route using the recursive function - _get_route()
				foreach ($routes->result_array() as $route) {

					$data[] = '$route["' . $this->_get_route($route['pageid']) . '"] = "' . "pages/index/{$route['sectionid']}/{$route['pageid']}" . '";';
				}

				$output = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n";

				$output .= implode("\n", $data);

				$this->load->helper('file');
				write_file(APPPATH . "cache/routes.php", $output);
			}
		}

		// Credit to http://acairns.co.uk for this simple function he shared with me
		// this will return our route based on the 'url' field of the database
		// it will also check for parent pages for hierarchical urls
		private function _get_route($id)
		{

			// get the page from the db using it's id
			$page = $this->Pages_model->get_page($id);

			// if this page has a parent, prefix it with the URL of the parent -- RECURSIVE
			if ($page["parentid"] != 0)
				$prefix = $this->_get_route($page["parentid"]) . "/" . $page['page_name'];
			else
				$prefix = $page['page_name'];

			return $prefix;
		}
	}