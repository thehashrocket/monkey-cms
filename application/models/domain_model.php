<?php
	/**
	 * Created by IntelliJ IDEA.
	 * User: OpenSkyMedia
	 * Date: 11/16/11
	 * Time: 10:34 PM
	 */

	class Domain_Model extends CI_Model
	{

		function getDomain()
		{
			$url = $_SERVER['HTTP_HOST'];

			$query = $this->db->get_where('sites', array('url' => $url));
			$row   = $query->row();
			$num   = $query->num_rows();

			$domain = $row->url;
			return $domain;
		}

		function getContent($pagetype, $uid)
		{
			$data = array(
				'page_type'       => $pagetype,
				'domainuid'       => $uid
			);

			$query = $this->db->get_where('content', $data);
			$row   = $query->row();
			$num   = $query->num_rows();

			if ($num < 1) {
				$content = 'No Content Added Yet';
				return $content;
			} else {
				$content = $row->page_content;

				return $content;
			}

		}

		function getSiteTitle($uid)
		{
			$data = array(
				'uid'       => $uid
			);

			$query = $this->db->get_where('sites', $data);
			$row   = $query->row();
			$num   = $query->num_rows();

			if ($num < 1) {
				$content = 'No Title Entered';
				return $content;
			} else {
				$content = $row->site_title;

				return $content;
			}

		}

		function getPageMetaDesc($uid)
		{
			$data = array(
				'uid'       => $uid
			);

			$query = $this->db->get_where('sites', $data);
			$row   = $query->row();
			$num   = $query->num_rows();

			if ($num < 1) {
				$content = 'No Title Entered';
				return $content;
			} else {
				$content = $row->meta_desc;

				return $content;
			}

		}

		function getPageMetaKeywords($uid)
		{
			$data = array(
				'uid'       => $uid
			);

			$query = $this->db->get_where('sites', $data);
			$row   = $query->row();
			$num   = $query->num_rows();

			if ($num < 1) {
				$content = 'No Title Entered';
				return $content;
			} else {
				$content = $row->meta_keywords;

				return $content;
			}

		}

		function getUID()
		{
			// Get the domain
			$url = $_SERVER['HTTP_HOST']; // this will get sub.mysite.com  or mysite.com
			// get the UID for this specific domain
			// i would also suggest some cleanup here to to help prevent from some type of injection :)
			$query = $this->db->get_where('sites', array('url' => $url));
			$row   = $query->row();
			$num   = $query->num_rows(); // isn't used in this example but i wanted to include it.
			//  if($num != 1 ){do something here}
			$uid = $row->uid;
			return $uid;
		}

		function newContent($page_type, $domain_uid, $content, $redirect)
		{
			$data = array(
				'page_type'           => $page_type,
				'domainuid'           => $domain_uid,
				'page_content'        => $content,
			);

			$this->db->select('idcontent')
				->where('page_type', $page_type)
				->where('domainuid', $domain_uid);
			$query = $this->db->get('content');

			if ($query->num_rows() > 0) {
				$this->db->where('domainuid', $domain_uid);
				$this->db->where('page_type', $page_type);
				$this->db->update('content', $data);

				$goback = $redirect;

				redirect($goback);
			} else {
				$this->db->insert('content', $data);

				$goback = $redirect;

				redirect($goback);
			}


		}

		function newDomain($uid, $domainname, $userid, $redirect)
		{
			$data = array(
				'uid'       => $uid,
				'url'       => $domainname,
			);

			$www = 'www.' . $domainname;

			$data2 = array(
				'uid'       => $uid,
				'url'       => $www,
			);
			$this->db->insert('sites', $data);
			$this->db->insert('sites', $data2);

			$goback = $redirect;

			redirect($goback);
		}
	}
