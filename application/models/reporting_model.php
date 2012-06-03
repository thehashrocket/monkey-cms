<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: OpenSkyMedia
 * Date: 12/14/11
 * Time: 3:05 PM
 * To change this template use File | Settings | File Templates.
 */
class Reporting_model extends CI_Model
{
    public function getContacts() {
        $query = $this->db->get('contacts');
        return $query;
    }

    public function contact_file($redirect) {

        $this->load->Library('CSVReader');
        $this->load->dbutil();
        $query = $this->db->get('contacts');
        $this->load->helper('file');
        $this->load->helper('download');

        $data = $this->dbutil->csv_from_result($query);

        $name = rand().'_contactdb_'.date('Y-m-d').'.csv';

        if ( ! write_file('./data/'.$name, $data, 'w+'))
        {
            echo 'Unable to write the file';
        }
        else
        {
            $data = file_get_contents("./data/".$name); // Read the file's contents

            force_download($name, $data);

            redirect($redirect);


        }
    }


}
