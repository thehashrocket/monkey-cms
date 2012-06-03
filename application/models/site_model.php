<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: OpenSkyMedia
 * Date: 12/12/11
 * Time: 11:44 AM
 * To change this template use File | Settings | File Templates.
 */
class Site_model extends CI_Model
{
    public function createContact($uid,$firstname, $lastname, $email, $street, $city, $state, $zip, $telephone, $message)
    {
        $data = array(
            'uid'       => $uid,
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'email'     => $email,
            'street'    => $street,
            'city'      => $city,
            'state'     => $state,
            'zip'       => $zip,
            'telephone' => $telephone,
            'message'   => $message,
        );

        $this->db->insert('contacts', $data);

}

    public function emailContact($uid, $firstname, $lastname, $subject, $email, $street, $city, $state, $zip, $telephone, $message)
    {
        $data = array(
            'uid'       => $uid,
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'email'     => $email,
            'street'    => $street,
            'city'      => $city,
            'state'     => $state,
            'zip'       => $zip,
            'telephone' => $telephone,
            'message'   => $message,
        );

        $fullname = $firstname . ' ' . $lastname;

        $this->email->from($email, $fullname);

        $this->email->to('dbrodman@avitran.com');


        $this->email->subject($subject);

        $this->email->message($message);

        $this->email->send();
    }

    public function getCustomerId($bill_email)
    {
        $this->db->select('idcustomers')
            ->from('customers')
            ->where('email', $bill_email);
        $query = $this->db->get();

        $row = $query->row();
        $num = $query->num_rows();

        if ($num < 1)
        {
            $content = 'No Content Added Yet';
            return $content;
        } else {
            $content = $row->idcustomers;

            return $content;
        }

    }

    public function recordCustomer($bill_firstname, $bill_lastname, $bill_street, $bill_city, $bill_state, $bill_zip, $bill_telephone, $bill_email, $customer_ip)
    {

        $uid        = uniqid(rand());

        $data = array(
            'firstname'     => $bill_firstname,
            'lastname'      => $bill_lastname,
            'street'        => $bill_street,
            'city'          => $bill_city,
            'state'         => $bill_state,
            'zip'           => $bill_zip,
            'telephone'     => $bill_telephone,
            'email'         => $bill_email,
            'ip'            => $customer_ip
        );

        $data2 = array(
            'idcustomers'   => $uid,
            'firstname'     => $bill_firstname,
            'lastname'      => $bill_lastname,
            'street'        => $bill_street,
            'city'          => $bill_city,
            'state'         => $bill_state,
            'zip'           => $bill_zip,
            'telephone'     => $bill_telephone,
            'email'         => $bill_email,
            'ip'            => $customer_ip
        );

        $this->db->select('email')
                ->from('customers')
                ->where('email', $bill_email);
        $query = $this->db->get();

        $row = $query->row();
        $num = $query->num_rows();

        if ($num<1)
        {
            $data['customerid'] = $uid;
            $this->db->insert('customers', $data2);
        } else {
            $this->db->where('email', $bill_email);
            $this->db->update('customers', $data);
        }


    }

    public function recordPickup($pickup_street, $pickup_city, $pickup_state, $pickup_zip)
    {
        $data = array(
            'idpickup_address'  => uniqid(rand()),
            'pickup_street'     => $pickup_street,
            'pickup_city'       => $pickup_city,
            'pickup_state'      => $pickup_state,
            'pickup_zip'        => $pickup_zip
        );

        $this->db->insert('pickup_address', $data);

        $this->db->select('idpickup_address');
        $this->db->from('pickup_address');
        $this->db->where($data);

        $query = $this->db->get();

        $row = $query->row();
        $num = $query->num_rows();

        if ($num < 1)
        {
            $content = 'No Content Added Yet';
            return $content;
        } else {
            $content = $row->idpickup_address;

            return $content;
        }
    }

    public function recordDestination($destination_street, $destination_city, $destination_state, $destination_zip)
    {
        $data = array(
            'iddestination_address' => uniqid(rand()),
            'dest_street'           => $destination_street,
            'dest_city'             => $destination_city,
            'dest_state'            => $destination_state,
            'dest_zip'              => $destination_zip
        );

        $this->db->insert('destination_address', $data);

        $this->db->select('iddestination_address');
        $this->db->from('destination_address');
        $this->db->where($data);

        $query = $this->db->get();

        $row = $query->row();
        $num = $query->num_rows();

        if ($num < 1)
        {
            $content = 'No Content Added Yet';
            return $content;
        } else {
            $content = $row->iddestination_address;

            return $content;
        }
    }

    public function recordTrip($customerid, $pickupid, $destinationid)
    {
        $data = array(
            'idtrips'       => uniqid(rand()),
            'customerid'    => $customerid,
            'pickupid'      => $pickupid,
            'destinationid' => $destinationid
        );

        $this->db->insert('trips', $data);
    }
}
