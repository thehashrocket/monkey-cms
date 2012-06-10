<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: OpenSkyMedia
 * Date: 1/31/12
 * Time: 3:31 PM
 * To change this template use File | Settings | File Templates.
 */
class Pages_model extends CI_Model
{
	function getClientPageList($id)
	{
		$this->db->select('*')
			->from('pages')
			->where('userid', $id);

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

	function getPagedata($id, $pageid) {
		$this->db->select('*')
			->from('pages')
			->where('userid', $id)
			->where('pageid', $pageid);

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

	function getPageList($siteid)
	{
		$this->db->select('*')
			->from('pages')
			->where('siteid', $siteid);

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

	function updatePage($pageid, $pagename, $pageheadline, $pagecontent, $uid, $siteid, $redirect) {
		$user = $this->user_id;

		$this->db->select('p.pageid');
		$this->db->from ('pages AS p');
		$this->db->where ('p.pageid', $pageid);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$data = array(
				'page_name'		=> $pagename,
				'page_headline'	=> $pageheadline,
				'page_content'	=> $pagecontent,
				'userid'		=> $uid,
				'siteid'		=> $siteid,
				'pageid'		=> $pageid
			);
			$this->db->select('p.pageid');
			$this->db->from ('pages AS p');
			$this->db->where ('pageid', $pageid);
			$this->db->update('pages', $data);
		}

		else {
			$data = array(
				'page_name'		=> $pagename,
				'page_headline'	=> $pageheadline,
				'page_content'	=> $pagecontent,
				'userid'		=> $uid,
				'siteid'		=> $siteid
			);
			$this->db->insert('pages', $data);

		}

		$goback = $redirect . '/' . $pageid;

		redirect($goback);
	}
}
