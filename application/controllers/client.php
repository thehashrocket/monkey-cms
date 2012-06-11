<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: OpenSkyMedia
 * Date: 12/14/11
 * Time: 2:24 PM
 * To change this template use File | Settings | File Templates.
 */
class Client extends CI_Controller
{
    public $uid;

    function __construct()
    {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->model('Client_model');
        $this->load->model('Gallery_model');
		$this->load->model('Pages_model');
		$this->load->model('Projects_model');
		$this->load->helper('ckeditor');
		$this->siteid = $this->domain_model->getUID();

        if (!$this->ion_auth->logged_in()) {
            $this->login      = 'false';
            $this->user_id      = '';
            $this->user_name    = '';
        } else {
            $user               = $this->ion_auth->user()->row();
            $this->user_id      = $user->id;
            $this->user_name    = $user->username;
            $this->login      = 'true';
            $this->thumb_size_width = '500';
            $this->thumb_size_height = '300';
            $this->max_image_size = '1000';
            $this->gallery_path = realpath(APPPATH . '../assets/images/gallery');
            $this->gallery_path_url = base_url().'assets/images/gallery/';
        }
    }

	function index($userid = null, $pageid = null)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('/auth/login/');
        }
        else {

			//Ckeditor's configuration
			$data['ckeditor'] = array(

				//ID of the textarea that will be replaced
				'id' 	=> 	'pagededitor',
				'path'	=>	'assets/js/ckeditor',

				//Optionnal values
				'config' => array(
					'toolbar' 	=> 	"Basic", 	//Using the Full toolbar
					'width' 	=> 	"550px",	//Setting a custom width
					'height' 	=> 	'500px',	//Setting a custom height

				),

				//Replacing styles from the "Styles tool"
				'styles' => array(

					//Creating a new style named "style 1"
					'style 1' => array (
						'name' 		=> 	'Blue Title',
						'element' 	=> 	'h2',
						'styles' => array(
							'color' 			=> 	'Blue',
							'font-weight' 		=> 	'bold'
						)
					)
				)
			);



            $data['login']      = $this->login;
            $data['user_id']    = $this->user_id;
            $data['username']   = $this->user_name;
			$data['photos']		= $this->Gallery_model->profile_get_images_from_db($this->user_id);
            $data['clientdata'] = $this->Client_model->getClientProfile($this->user_id);
			$data['pagelist']	= $this->Pages_model->getClientPageList($this->user_id);
			$data['pagedata']	= $this->Pages_model->getPagedata($this->user_id, $pageid);
			$data['page_title'] = $this->domain_model->getSiteTitle($this->siteid);
			$data['page_desc'] = $this->domain_model->getPageMetaDesc($this->siteid);
			$data['page_keywords'] = $this->domain_model->getPageMetaKeywords($this->siteid);
            $data['sidebar']    = 'sidebars/small-home-sidebar';
            $data['page']       = '/client/welcome_message'; // pass the actual view to use as a parameter
            $this->load->view('container',$data);
        }
    }

	function deleteCategory($id)
	{
		$redirect = '/client/index';
		$this->load->model('Projects_model');
		$this->Projects_model->deleteCategory($id, $redirect);
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
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert-box error">', '</div>');

        $this->form_validation->set_rules('question', 'FAQ Question', 'required|trim');
        $this->form_validation->set_rules('answer', 'FAQ Answer', 'required|trim');

        if($this->form_validation->run() == FALSE)
        {
            $proj_id = $this->Client_model->get_project_id();
            $data['login']      = $this->login;
            $data['user_id']    = $this->user_id;
            $data['username']   = $this->user_name;
            $data['photos'] = $this->Gallery_model->profile_get_images_from_db($proj_id);
            $data['projdata']   = $this->Projects_model->getProjectProfile($this->user_id);
            $data['pledgedata'] = $this->Projects_model->getPledgeProfile($this->user_id);
            $data['clientdata'] = $this->Client_model->getClientProfile($this->user_id);
			$data['pagelist']	= $this->Pages_model->getClientPageList($this->user_id);
            $data['faqs']       = $this->Projects_model->getFAQProfile($this->user_id);
            $data['categories'] = $this->Projects_model->getCategories();
			$data['page_title'] = $this->domain_model->getSiteTitle($this->siteid);
			$data['page_desc'] = $this->domain_model->getPageMetaDesc($this->siteid);
			$data['page_keywords'] = $this->domain_model->getPageMetaKeywords($this->siteid);
            $data['sidebar']    = 'sidebars/small-home-sidebar';
            $data['page']       = '/client/welcome_message'; // pass the actual view to use as a parameter
            $this->load->view('container',$data);

        } else
        {
            $strlen = strlen((string)$this->input->post('idfaq_table'));

            if($strlen == 0)
            {
                $faq_id = '';
            } else
            {
                $faq_id = (string)$this->input->post('idfaq_table');
            }

            $question   = (string)$this->input->post('question', TRUE);
            $answer     = (string)$this->input->post('answer', TRUE);
            $uid        = $this->user_id;
            $proj_id    = (string)$this->input->post('projectid', TRUE);
            $redirect   = "/client/index";

            $this->Projects_model->updateFAQ($faq_id, $proj_id, $question, $answer, $uid, $redirect);
        }
    }

	function catUpdate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert-box error">', '</div>');

		$this->form_validation->set_rules('catname', 'Category Name', 'required|trim');
		$this->form_validation->set_rules('catdesc', 'Category Description', 'required|trim');

		if($this->form_validation->run() == FALSE)
		{
			$data['login']      = $this->login;
			$data['user_id']    = $this->user_id;
			$data['username']   = $this->user_name;
			$data['photos']		= $this->Gallery_model->profile_get_images_from_db($this->user_id);
			$data['categorydata']	= $this->Projects_model->getCategoriesProfile($this->user_id);
			$data['clientdata'] = $this->Client_model->getClientProfile($this->user_id);
			$data['pagelist']	= $this->Pages_model->getClientPageList($this->user_id);
			$data['page_title'] = $this->domain_model->getSiteTitle($this->siteid);
			$data['page_desc'] = $this->domain_model->getPageMetaDesc($this->siteid);
			$data['page_keywords'] = $this->domain_model->getPageMetaKeywords($this->siteid);
			$data['sidebar']    = 'sidebars/small-home-sidebar';
			$data['page']       = '/client/welcome_message'; // pass the actual view to use as a parameter
			$this->load->view('container',$data);

		} else
		{
			$strlen = strlen((string)$this->input->post('idcategories'));

			if($strlen == 0)
			{
				$idcategories = '';
			} else
			{
				$idcategories = (string)$this->input->post('idcategories');
			}

			$catname   = (string)$this->input->post('catname', TRUE);
			$catdesc     = (string)$this->input->post('catdesc', TRUE);
			$uid        = $this->user_id;
			$redirect   = "/client/index";

			$this->Projects_model->updateCategories($idcategories, $catname, $catdesc, $uid, $redirect);
		}
	}

    // Updates Gallery Table
    // Receives input from /client/index
    function gallery_up()
    {
//        $strlen = strlen((string)$this->input->post('pledgeid'));
//
//        if($strlen == 0)
//        {
//            $project_id = $this->Gallery_model->get_project_id();
//            $pledge_id = '';
//        } else
//        {
//            $pledge_id = (string)$this->input->post('pledgeid');
//            $project_id = '';
//        }

        $config = array(
            'allowed_types' => 'jpg|jpeg|gif|png',
            'upload_path' => $this->gallery_path,
            'max_size' => $this->max_image_size
        );

        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $image_data = $this->upload->data();

        $config = array(
            'source_image' => $image_data['full_path'],
            'new_image' => $this->gallery_path . '/thumbs',
            'maintain_ratio' => true,
            'width' => $this->thumb_size_width,
            'height' => $this->thumb_size_height
        );

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

        $upload = $this->upload->data();

        $data = array(
            'photo_id'      => 0 , // I GUESS IS AUTO_INCREMENT
            'photoname'     => $upload['file_name'],
            'thumb'         => $this->gallery_path_url . 'thumbs/' . $upload['file_name'],
            'fullsize'      => $this->gallery_path_url . $upload['file_name'],
//            'projectid'     => $project_id,
//            'pledgeid'      => $pledge_id,
            'userid'        => $this->user_id,
        );

        $this->Gallery_model->do_upload($data);

        $url = (string)$this->input->post('redirect', TRUE);
        redirect($url);
    }

	function pageUpdate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert-box error">', '</div>');

		$this->form_validation->set_rules('pagename', 'Page Name', 'required|trim');
		$this->form_validation->set_rules('pageheadline', 'Page Headline', 'required|trim');
		$this->form_validation->set_rules('pagecontent', 'Page Content', 'required|trim');

		if($this->form_validation->run() == FALSE)
		{
			$proj_id = $this->Client_model->get_project_id();
			$data['login']      = $this->login;
			$data['user_id']    = $this->user_id;
			$data['username']   = $this->user_name;
			$data['photos'] = $this->Gallery_model->profile_get_images_from_db($proj_id);
			$data['projdata']   = $this->Projects_model->getProjectProfile($this->user_id);
			$data['pledgedata'] = $this->Projects_model->getPledgeProfile($this->user_id);
			$data['clientdata'] = $this->Client_model->getClientProfile($this->user_id);
			$data['pagelist']	= $this->Pages_model->getClientPageList($this->user_id);
			$data['faqs']       = $this->Projects_model->getFAQProfile($this->user_id);
			$data['categories'] = $this->Projects_model->getCategories();
			$data['page_title'] = $this->domain_model->getSiteTitle($this->siteid);
			$data['page_desc'] = $this->domain_model->getPageMetaDesc($this->siteid);
			$data['page_keywords'] = $this->domain_model->getPageMetaKeywords($this->siteid);			$data['page_title'] = 'Capital Team: Client Tool';
			$data['sidebar']    = 'sidebars/small-home-sidebar';
			$data['page']       = '/client/welcome_message'; // pass the actual view to use as a parameter
			$this->load->view('container',$data);

		} else
		{
			$strlen = strlen((string)$this->input->post('pageid'));

			if($strlen == 0)
			{
				$pageid = '';
			} else
			{
				$pageid = (string)$this->input->post('pageid');
			}
			$pagename		= (string)$this->input->post('pagename', TRUE);
			$pageheadline	= (string)$this->input->post('pageheadline', TRUE);
			$pagecontent	= (string)$this->input->post('pagecontent', TRUE);
			$parentpage	= (string)$this->input->post('parentpage', TRUE);
			$uid        = $this->user_id;
			$siteid		= $this->siteid;
			$redirect   = "/client/index";

			$this->Pages_model->updatePage($pageid, $pagename, $pageheadline, $pagecontent, $parentpage, $uid, $siteid, $redirect);
		}
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

        if($this->form_validation->run() == FALSE)
        {
            $proj_id = $this->Client_model->get_project_id();
            $data['login']      = $this->login;
            $data['user_id']    = $this->user_id;
            $data['username']   = $this->user_name;
            $data['photos'] = $this->Gallery_model->profile_get_images_from_db($proj_id);
            $data['projdata']   = $this->Projects_model->getProjectProfile($this->user_id);
            $data['pledgedata'] = $this->Projects_model->getPledgeProfile($this->user_id);
            $data['clientdata'] = $this->Client_model->getClientProfile($this->user_id);
			$data['pagelist']	= $this->Pages_model->getClientPageList($this->user_id);
            $data['categories'] = $this->Projects_model->getCategories();
			$data['page_title'] = $this->domain_model->getSiteTitle($this->siteid);
			$data['page_desc'] = $this->domain_model->getPageMetaDesc($this->siteid);
			$data['page_keywords'] = $this->domain_model->getPageMetaKeywords($this->siteid);
            $data['sidebar']    = 'sidebars/home-sidebar';
            $data['page'] = '/client/welcome_message'; // pass the actual view to use as a parameter
            $this->load->view('container',$data);
        }
        else
        {
            // validation has passed. Now send to model
            $uid        = $this->user_id;
            $firstname = (string)$this->input->post('bill_firstname', TRUE);
            $lastname = (string)$this->input->post('bill_lastname', TRUE);
            $company = (string)$this->input->post('bill_company', TRUE);
            $email = (string)$this->input->post('bill_email', TRUE);
            $street = (string)$this->input->post('bill_street', TRUE);
            $city = (string)$this->input->post('bill_city', TRUE);
            $state = (string)$this->input->post('bill_state', TRUE);
            $zip = (string)$this->input->post('bill_zip', TRUE);
            $redirect = "/client/index";

            $this->Client_model->updateProfile($uid, $firstname, $lastname, $company, $email, $street, $city, $state, $zip, $redirect);
        }

    }

	function saveOrder()
	{
		$items = $this->input->post('item');
		echo '<br/>Items2:' . var_dump($items);
		$total_items = count($this->input->post('item'));

		for($item = 0; $item < $total_items; $item++ )
		{

			$data = array(
				'pageid' => $items[$item],
				'rank' => $item
			);

			$this->db->where('pageid', $data['pageid']);

			$this->db->update('pages', $data);

//			echo '<br />'.$this->db->last_query();

		}



	}


}
