<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: OpenSkyMedia
 * Date: 1/25/12
 * Time: 10:30 PM
 */
class Blog extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in()) {
            $this->login      = 'false';
            $this->user_id      = '';
            $this->user_name    = '';
        } else {
            $user               = $this->ion_auth->user()->row();
            $this->user_id      = $user->id;
            $this->user_name    = $user->username;
            $this->login      = 'true';
        }
    }

    //the home page of the blog
    public function index()
    {
        $data['login']      = $this->login;
        $data['user_id']    = $this->user_id;
        $data['username']   = $this->user_name;
        $this->load->model('Blog_model', 'blog');
        $data['query'] = $this->blog->get_all_entries();

        $data['page_title'] = 'Capital Team: Home';
        $data['sidebar']    = 'sidebars/home-sidebar';
        $data['page']       = 'blog/index';
        $this->load->view('container', $data);

    }

    //For an individual entry, the url title is used to grab
    //the entry
    public function entry($url_title = "")
    {
        $data['login']      = $this->login;
        $data['user_id']    = $this->user_id;
        $data['username']   = $this->user_name;
        $this->load->helper('url');

        if($url_title){
            $this->load->model('Blog_model', 'blog');
            $data['post'] = $this->blog->get_entry($url_title);

            if(!$data['post']){
                redirect('/blog', 'location');
            } else {
                $data['page_title'] = 'Capital Team: ' . $url_title;
                $data['sidebar']    = 'sidebars/home-sidebar';
                $data['page']       = 'blog/entry';
                $this->load->view('container', $data);
            }
        } else {
            redirect('/blog', 'location');
        }
    }
}

/* End of file blog.php */
/* Location: ./system/tumbleupon/controllers/blog.php */