<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends CI_Model {

	function __construct() {
	}

	# Spherical Law of Cosines
	public function distance_slc($lat1, $lon1, $lat2, $lon2) {
		$earth_radius = 3960.00; # in miles
		$delta_lat = $lat2 - $lat1;
		$delta_lon = $lon2 - $lon1;
		$alpha    = $delta_lat/2;
		$beta     = $delta_lon/2;
		$a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin(deg2rad($beta)) * sin(deg2rad($beta)) ;
		$c        = asin(min(1, sqrt($a)));
		$distance = 2*$earth_radius * $c;
		$distance = round($distance, 4);

		return $distance;
	}

	function getAjaxClosestLocations($latlng, $originlat, $originlng, $tag) {

		$results = array();

		$pieces = explode(',', $latlng);

		$array = array(
			'tags' => $tag,
		);

		$this->db->select('*')->from('locations')->like($array);

		$location = $this->db->get();
		foreach ($location->result_array() as $address) {

			$distance = $this->distance_slc($originlat, $originlng, $address['lat'], $address['lng']);
			$test = $originlat . $originlng . $address['lat'] . $address['lng'];

			if ($distance < 50.0000) {
				$results[] = $address;
			}
		}

		echo json_encode(array('data' => $results));

//		echo json_encode($location->result_array());
	}

	function getAjaxLocationList()
	{
		$this->db->select( '*' )
			->from( 'locations' );

		$query = $this->db->get();

		$row = $query->row_array();
		$num = $query->num_rows();

		if ( $num < 1 ) {
			return NULL;
		}
		else {
			echo json_encode( $query->result_array() );

		}

	}

	function getAjaxLocation($idlocation)
	{
		$this->db->select( '*' )
			->from( 'locations' )
			->where( 'idlocation', $idlocation);

		$query = $this->db->get();

		$row = $query->row_array();
		$num = $query->num_rows();

		if ( $num < 1 ) {
			return NULL;
		}
		else {
			echo json_encode( $row );

		}

	}

	function getLocationById($idlocation){
		$this->db->select('*')
				->from('locations')
				->where('idlocation', $idlocation)
				->join('photos', 'photos.photo_id = locations.photo_id');

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1)
			{
				return NULL;
			} else {
				return $query;
			}

	}

	function getLocationsWithPhotos(){
		$this->db->select('*')
				->from('locations')
				->join('photos', 'photos.photo_id = locations.photo_id');

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1)
			{
				return NULL;
			} else {
				return $query;
			}

	}

	function updateLocation($idlocation, $locationname, $locationstreet, $locationcity, $locationstate, $locationzip, $saleprice, $rentprice, $bedrooms, $bathrooms, $squarefeet, $locationdescription, $photo_id, $lat, $lng, $tags, $featured, $reduced, $rented, $sold, $uid)
	{
		$today = date("Y-m-d H:i:s");

		if ($idlocation  == '') {
			$data = array(
				'idlocation'		=> mt_rand(5, 15),
				'location_name'		=> $locationname,
				'location_street'	=> $locationstreet,
				'location_city'     => $locationcity,
				'location_state'    => $locationstate,
				'location_zip'      => $locationzip,
				'sale_price'		=> $saleprice,
				'rent_price'		=> $rentprice,
				'bedrooms'			=> $bedrooms,
				'bathrooms'			=> $bathrooms,
				'square_feet'		=> $squarefeet,
				'lat'               => $lat,
				'lng'               => $lng,
				'tags'              => $tags,
				'created'			=> $today,
				'description'       => $locationdescription,
				'photo_id'			=> $photo_id,
				'featured'			=> $featured,
				'reduced'			=> $reduced,
				'rented'			=> $rented,
				'sold'				=> $sold,
				'userid'			=> $uid
			);
		} else {
			$data = array(
				'idlocation'		=> $idlocation,
				'location_name'		=> $locationname,
				'location_street'	=> $locationstreet,
				'location_city'     => $locationcity,
				'location_state'    => $locationstate,
				'location_zip'      => $locationzip,
				'sale_price'		=> $saleprice,
				'rent_price'		=> $rentprice,
				'bedrooms'			=> $bedrooms,
				'bathrooms'			=> $bathrooms,
				'square_feet'		=> $squarefeet,
				'lat'               => $lat,
				'lng'               => $lng,
				'tags'              => $tags,
				'created'			=> $today,
				'description'       => $locationdescription,
				'photo_id'			=> $photo_id,
				'featured'			=> $featured,
				'reduced'			=> $reduced,
				'rented'			=> $rented,
				'sold'				=> $sold,
				'userid'			=> $uid
			);
		}

		$this->db->select('*')
			->from('locations')
			->where('userid', $uid)
			->where('idlocation', $idlocation);

		$query = $this->db->get();

		$row = $query->row_array();
		$num = $query->num_rows();

		if ($num < 1)
		{
			$this->db->insert('locations', $data);

		} else {
			$this->db->where('idlocation', $idlocation);
			$this->db->update('locations', $data);
		}
	}

	function deleteLocation($id)
	{
		$this->db->where( 'idlocation', $id );
		$this->db->delete( 'locations' );
	}


}