<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Created by IntelliJ IDEA.
	 * User: jason
	 * Date: 10/20/12
	 * Time: 11:13 AM
	 * To change this template use File | Settings | File Templates.
	 */
	class locations extends CI_Controller
	{
		function __construct() {
			parent::__construct();

			$this->load->model('Location_model');

		}
		function getLocation()
		{
			$idlocation = (string)$this->input->post('address');
			$this->Location_model->getAjaxLocation($idlocation);
		}

		function getLocationList()
		{
			$this->Location_model->getAjaxLocationList();
		}

		function getTaggedLocations(){

			$latlng = $this->input->post('latlng');

			$tag = $this->input->post('tag');

			$originlat = $this->input->post('lat');
			$originlng = $this->input->post('lng');

			$this->Location_model->getAjaxClosestLocations($latlng, $originlat, $originlng, $tag);

		}

	}
