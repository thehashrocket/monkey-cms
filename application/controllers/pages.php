<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: OpenSkyMedia
 * Date: 1/25/12
 * Time: 5:50 PM
 * To change this template use File | Settings | File Templates.
 */
class Pages extends CI_Controller
{
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

    public function index(){
        $data['login']      = $this->login;
        $data['user_id']    = $this->user_id;
        $data['username']   = $this->user_name;
        $data['page_title'] = 'Capital Team: Home';
        $data['sidebar']    = 'sidebars/home-sidebar';
        $data['page']       = 'pages/home';
        $this->load->view('container', $data);
    }

    public function about()
    {
        $data['login']      = $this->login;
        $data['user_id']    = $this->user_id;
        $data['username']   = $this->user_name;
        $data['page_title'] = 'Capital Team: about';
        $data['sidebar']    = 'sidebars/home-sidebar';
        $data['page']       = 'pages/about';
        $this->load->view('container', $data);
    }

    public function careers()
    {
        $data['login']      = $this->login;
        $data['user_id']    = $this->user_id;
        $data['username']   = $this->user_name;
        $data['page_title'] = 'Capital Team: Careers';
        $data['sidebar']    = 'sidebars/home-sidebar';
        $data['page']       = 'pages/careers';
        $this->load->view('container', $data);
    }

    public function terms()
    {
        $data['login']      = $this->login;
        $data['user_id']    = $this->user_id;
        $data['username']   = $this->user_name;
        $data['page_title'] = 'Capital Team: Terms';
        $data['sidebar']    = 'sidebars/home-sidebar';
        $data['page']       = 'pages/terms';
        $this->load->view('container', $data);
    }

    public function help()
    {
        $data['login']      = $this->login;
        $data['user_id']    = $this->user_id;
        $data['username']   = $this->user_name;
        $data['page_title'] = 'Capital Team: Help';
        $data['sidebar']    = 'sidebars/home-sidebar';
        $data['page']       = 'pages/help';
        $this->load->view('container', $data);
    }
}
