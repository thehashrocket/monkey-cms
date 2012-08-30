<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: OpenSkyMedia
 * Date: 1/25/12
 * Time: 10:17 PM
 */
class Providers extends CI_Controller
{
    public function index() {
        $data['page_title'] = 'Capital Team: Providers';
        $data['sidebar']    = '';
        $data['page']       = 'providers/welcome';
        $this->load->view('container', $data);
    }
}
