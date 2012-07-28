<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: OpenSkyMedia
 * Date: 12/12/11
 * Time: 11:18 AM
 */
class Site extends CI_Controller
{
    function newpurchase()
    {
        $this->load->model('Site_model');
        $this->load->library('form_validation');
        $this->load->library('authorize_net');
        $this->form_validation->set_error_delimiters('<div class="alert-box error">', '</div>');

        /* Billing Information */
        $this->form_validation->set_rules('bill_firstname', 'First Name', 'required|trim');
        $this->form_validation->set_rules('bill_lastname', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('bill_email', 'Email Address', 'required|trim');
        $this->form_validation->set_rules('bill_street', 'Street Address', 'required|trim');
        $this->form_validation->set_rules('bill_city', 'City Address', 'required|trim');
        $this->form_validation->set_rules('bill_state', 'State Address', 'required|trim');
        $this->form_validation->set_rules('bill_zip', 'Zip Address', 'required|trim');
        $this->form_validation->set_rules('bill_telephone', 'Billing Telephone', 'required|trim');
        $this->form_validation->set_rules('bill_card_numb', 'Credit Card Number', 'required|trim');
        $this->form_validation->set_rules('bill_exp_date', 'Expiration Date', 'required|trim');
        $this->form_validation->set_rules('bill_card_code', 'Card Verification #', 'required|trim');

        $auth_net = array(
            'x_card_num'			=> (string)$this->input->post('bill_card_numb', TRUE),
            'x_exp_date'			=> (string)$this->input->post('bill_exp_date', TRUE),
            'x_card_code'			=> (string)$this->input->post('bill_card_code', TRUE),
            'x_description'			=> 'AVI Cab Service',
            'x_amount'				=> '$1',
            'x_first_name'			=> (string)$this->input->post('bill_firstname', TRUE),
            'x_last_name'			=> (string)$this->input->post('bill_lastname', TRUE),
            'x_address'				=> (string)$this->input->post('bill_street', TRUE),
            'x_city'				=> (string)$this->input->post('bill_city', TRUE),
            'x_state'				=> (string)$this->input->post('bill_state', TRUE),
            'x_zip'					=> (string)$this->input->post('bill_zip', TRUE),
            'x_country'				=> 'US',
            'x_phone'				=> (string)$this->input->post('bill_telephone', TRUE),
            'x_email'				=> (string)$this->input->post('bill_email', TRUE),
            'xx_test_request'       => 'FALSE',
            'x_type'                => 'AUTH_ONLY',
            'x_customer_ip'			=> $this->input->ip_address(),
        );


        $this->authorize_net->setData($auth_net);

        // Try to AUTH_CAPTURE
        if( $this->authorize_net->authorizeAndCapture() )
        {
            /* Send Customer Info to Database */

            $bill_firstname = (string)$this->input->post('bill_firstname', TRUE);
            $bill_lastname = (string)$this->input->post('bill_lastname', TRUE);
            $bill_street = (string)$this->input->post('bill_street', TRUE);
            $bill_city = (string)$this->input->post('bill_city', TRUE);
            $bill_state = (string)$this->input->post('bill_state', TRUE);
            $bill_zip = (string)$this->input->post('bill_zip', TRUE);
            $bill_telephone = (string)$this->input->post('bill_telephone', TRUE);
            $bill_email = (string)$this->input->post('bill_email', TRUE);
            $customer_ip = $this->input->ip_address();

            $this->Site_model->recordCustomer($bill_firstname, $bill_lastname, $bill_street, $bill_city, $bill_state, $bill_zip, $bill_telephone, $bill_email, $customer_ip);

            /* Pickup Information */
            $this->form_validation->set_rules('pickup_street', 'Street Address', 'required|trim');
            $this->form_validation->set_rules('pickup_city', 'City Address', 'required|trim');
            $this->form_validation->set_rules('pickup_state', 'State Address', 'required|trim');
            $this->form_validation->set_rules('pickup_zip', 'Zip Address', 'required|trim');

            $pickup_street = (string)$this->input->post('pickup_street', TRUE);
            $pickup_city = (string)$this->input->post('pickup_city', TRUE);
            $pickup_state = (string)$this->input->post('pickup_state', TRUE);
            $pickup_zip = (string)$this->input->post('pickup_zip', TRUE);

            $pickup = $pickup_street . ', ' . $pickup_city . ', ' . $pickup_state . ', ' . $pickup_zip;

            $customerid = $this->Site_model->getCustomerId($bill_email);

            $pickupid = $this->Site_model->recordPickup($pickup_street, $pickup_city, $pickup_state, $pickup_zip);

            /* Destination Information */
            $this->form_validation->set_rules('destination_street', 'Street Address', 'required|trim');
            $this->form_validation->set_rules('destination_city', 'City Address', 'required|trim');
            $this->form_validation->set_rules('destination_state', 'State Address', 'required|trim');
            $this->form_validation->set_rules('destination_zip', 'Zip Address', 'required|trim');

            $destination_street = (string)$this->input->post('destination_street', TRUE);
            $destination_city = (string)$this->input->post('destination_city', TRUE);
            $destination_state = (string)$this->input->post('destination_state', TRUE);
            $destination_zip = (string)$this->input->post('destination_zip', TRUE);

            $destination = $destination_street . ', ' . $destination_city . ', ' . $destination_state . ', ' . $destination_zip;

            $destinationid = $this->Site_model->recordDestination($destination_street, $destination_city, $destination_state, $destination_zip);

            $this->form_validation->set_rules('message', 'Your Message', 'trim');

            $customerid = $this->Site_model->getCustomerId($bill_email);

            /* Record Trip */

            $this->Site_model->recordTrip($customerid, $pickupid, $destinationid);

            /* Email Purchase */

            $cust_message = (string)$this->input->post('message', TRUE);

            $message    = 'Customer Message: ' . $cust_message . '<br/>';
            $message    .= 'Confirmation Code: ' . $this->authorize_net->getApprovalCode() . '<br/>';
            $message    .= 'Transaction Code: ' . $this->authorize_net->getTransactionId() . '<br/>';
            $message    .= 'Pickup Location: ' . $pickup . '<br/>';
            $message    .= 'Destination Location: ' . $destination . '<br/>';

            $subject = 'New Customer Pickup';

            $this->Site_model->emailContact($customerid, $bill_firstname, $bill_lastname, $subject, $bill_email, $bill_street, $bill_city, $bill_state, $bill_zip, $bill_telephone, $message);

            $data['page_title'] = 'AVI Transportation - Thank You';
            $data['message']    = $message;
            $data['page']       = 'thankyou_view'; // pass the actual view to use as a parameter
            $this->load->view('container',$data);
        }
        else
        {
            $message =  $this->authorize_net->getError();
            $data['page_title'] = 'AVI Transportation - Thank You';
            $data['message']    = $message;
            $data['page']       = 'thankyou_view'; // pass the actual view to use as a parameter
            $this->load->view('container',$data);


            /*echo '<h2>Fail!</h2>';
            // Get error
            echo '<p>' . $this->authorize_net->getError() . '</p>';
            // Show debug data
            $this->authorize_net->debug();*/
        }

    }

    function newContact()
    {
        $this->load->model('Site_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert-box error">', '</div>');

        $this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email Address', 'required|trim');
        $this->form_validation->set_rules('street', 'Street Address', 'required|trim');
        $this->form_validation->set_rules('city', 'City Address', 'required|trim');
        $this->form_validation->set_rules('state', 'State Address', 'required|trim');
        $this->form_validation->set_rules('zip', 'Zip Address', 'required|trim');
        $this->form_validation->set_rules('telephone', 'Telephone', 'required|trim');
        $this->form_validation->set_rules('message', 'Your Message', 'required|trim');

        if($this->form_validation->run() == FALSE)
        {
            $data['page_title'] = 'AVI Transportation - Community Livery Service';
            $data['page'] = 'contact_view'; // pass the actual view to use as a parameter
            $this->load->view('container',$data);
        }
        else
        {
            // validation has passed. Now send to model
            $uid        = uniqid(rand());
            $firstname = (string)$this->input->post('firstname', TRUE);
            $lastname = (string)$this->input->post('lastname', TRUE);
            $email = (string)$this->input->post('email', TRUE);
            $street = (string)$this->input->post('street', TRUE);
            $city = (string)$this->input->post('city', TRUE);
            $state = (string)$this->input->post('state', TRUE);
            $zip = (string)$this->input->post('zip', TRUE);
            $telephone = (string)$this->input->post('telephone', TRUE);
            $message = (string)$this->input->post('message', TRUE);
            $redirect = "/welcome/thankyou";

            $subject = 'New Contact';

            $this->Site_model->createContact($uid, $firstname, $lastname, $email, $street, $city, $state, $zip, $telephone, $message);

            $this->Site_model->emailContact($uid, $firstname, $lastname, $subject, $email, $street, $city, $state, $zip, $telephone, $message);

            $data['page_title'] = 'AVI Transportation - Thank You';
            $data['message']    = $message;
            $data['page']       = 'thankyou_view'; // pass the actual view to use as a parameter
            $this->load->view('container',$data);
        }
    }

}
