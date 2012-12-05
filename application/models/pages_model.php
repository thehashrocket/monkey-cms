<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Created by IntelliJ IDEA.
	 * User: OpenSkyMedia
	 * Date: 1/31/12
	 * Time: 3:31 PM
	 */
	class Pages_model extends CI_Model
	{
		function deletePage($uid, $siteid, $pageid)
		{
			$userid = $uid;
			$siteid = $siteid;
			$pageid = $pageid;

			$this->db->delete('pages', array('pageid'=>$pageid));
		}

		function getClientPageList($id)
		{
			$this->db->select('*')
				->from('pages')
				->where('userid', $id)
				->order_by('rank');

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1) {
				return NULL;

			} else {
				return $query;
			}
		}

		function getPagedata($id, $pageid)
		{
			$this->db->select('*')
				->from('pages')
				->where('userid', $id)
				->where('pageid', $pageid);

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1) {
				return NULL;
			} else {
				return $row;
				echo json_encode($row);
//				$return['last'] = $this->db->last_query();
			}
		}

		function getAjaxPagedata($id, $pageid)
		{
			$this->db->select('*')
				->from('pages')
				->where('userid', $id)
				->where('pageid', $pageid);

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1) {
				return NULL;
			} else {
				echo json_encode($row);
			}
		}

		function getAjaxSidebarPageList($siteid)
		{
			$this->db->select('pageid, page_name, userid, siteid, rank')
				->from('pages')
				->where('siteid', $siteid)
				->order_by('rank');
			;

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1) {
				return NULL;

			} else {
				echo json_encode($query->result_array());
			}
		}

		function get_page($pageid)
		{
			$this->db->select('*')
				->from('pages')
				->where('pageid', $pageid);

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1) {
				return NULL;

			} else {
				return $row;
			}
		}

		function get_all($siteid)
		{
			$this->db->select('*')
				->from('pages')
				->where('siteid', $siteid)
				->order_by('rank');

			$query = $this->db->get();



			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1) {
				return NULL;

			} else {
				return $query;
			}
		}

		function getPageContent($uid, $sectionid, $pageid)
		{
			$data = array(
				'siteid'        => $uid,
				'sectionid'     => $sectionid,
				'pageid'        => $pageid
			);

			$query = $this->db->get_where('pages', $data);


			$row   = $query->row();

			$num   = $query->num_rows();

			if ($num < 1) {
				$content = 'No Title Entered';
				return $content;
			} else {

				return $row;

			}

		}

		function getPageName($pageid)
		{
			$this->db->select('page_name');
			$this->db->from('pages');
			$this->db->where('pageid', $pageid);

			$query = $this->db->get();

			$row = $query->row_array();

			return $row['page_name'];

		}

		function getPageList($siteid)
		{
			$this->db->select('pageid, page_name, page_headline, page_intro, page_content, parentid, sectionid, userid, siteid, rank')
				->from('pages')
				->where('siteid', $siteid)
				->order_by('rank');

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1) {
				return NULL;

			} else {
				return $query;
			}
		}

		function updatePage($pageid, $pagename, $menuname, $pageheadline, $pagecontent, $parentpage, $sectionid, $uid, $siteid)
		{
			$user = $this->user_id;

			$this->db->select('pageid');
			$this->db->from('pages');
			$this->db->where('pageid', $pageid);
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				$data = array(
					'page_name'        => $pagename,
                    'menu_name'         => $menuname,
					'page_headline'    => $pageheadline,
					'page_content'     => $pagecontent,
					'parentid'         => $parentpage,
					'sectionid'			=> $sectionid,
					'userid'           => $uid,
					'siteid'           => $siteid,
					'pageid'           => $pageid
				);
				$this->db->select('pageid');
				$this->db->from('pages');
				$this->db->where('pageid', $pageid);
				$this->db->update('pages', $data);
			} else {
				$data = array(
					'page_name'        => $pagename,
                    'menu_name'         => $menuname,
					'page_headline'    => $pageheadline,
					'page_content'     => $pagecontent,
					'parentid'         => $parentpage,
					'sectionid'			=> $sectionid,
					'userid'           => $uid,
					'siteid'           => $siteid
				);
				$this->db->insert('pages', $data);

				$lastid = $this->db->insert_id();

				$this->db->select();
				$this->db->from('pages');
				$this->db->where('pageid', $lastid);
				$query = $this->db->get();
				echo json_encode($query->result_array());

			}
		}

		function updatePageOrderList($postitems, $redirect)
		{
			$items       = $postitems;
			$total_items = count($items);
		}
	}
