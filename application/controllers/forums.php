<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: OpenSkyMedia
 * Date: 1/25/12
 * Time: 10:34 PM
 */
class Forums extends CI_Controller
{
    public function index() {
        $data['page_title'] = 'Capital Team: Blog';
        $data['sidebar']    = '';
        $data['page']       = 'forums/welcome';
        $this->load->view('container', $data);
    }
}
