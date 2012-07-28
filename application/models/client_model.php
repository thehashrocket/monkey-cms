<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: OpenSkyMedia
 * Date: 1/31/12
 * Time: 9:37 AM
 */
class Client_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->model('Projects_model');
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

    function getClientProfile($id)
    {
        $this->db->select('*')
                ->from('users')
                ->where('id', $id);

        $query = $this->db->get();

        $row = $query->row();
        $num = $query->num_rows();

        if ($num < 1)
        {
            return $row;
        } else {
            return $row;
        }

    }

    function updateProfile($uid, $firstname, $lastname, $company, $email, $street, $city, $state, $zip, $redirect)
    {
        $data = array(
            'first_name' => $firstname,
            'last_name'  => $lastname,
            'company'   => $company,
            'email'     => $email,
            'street'    => $street,
            'city'      => $city,
            'state'     => $state,
            'zip'       => $zip,
        );

        $this->db->where('id', $uid)
                ->update('users', $data);

        redirect($redirect);
    }


}
