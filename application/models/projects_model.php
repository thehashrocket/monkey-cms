<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Created by IntelliJ IDEA.
	 * User: OpenSkyMedia
	 * Date: 1/31/12
	 * Time: 3:31 PM
	 * To change this template use File | Settings | File Templates.
	 */
	class Projects_model extends CI_Model
	{
		

		function deleteCategory($id, $redirect)
		{
			$this->db->where('idcategories', $id);
			$this->db->delete('categories');
			redirect($redirect);
		}

		function deletePledge($id, $redirect)
		{
			$this->db->where('idpledges_table', $id);
			$this->db->delete('pledges_table');
			redirect($redirect);
		}

		function getProjectProfile($id)
		{
			$this->db->select('*')
				->from('projects_table')
				->where('user_id', $id);

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();



			if ($num < 1)
			{
				$row = array(
					'idprojects_table'  => NULL,
					'ProjectTitle'      => 'Blank Title',
					'ProjectSubTitle'   => 'Insert Project Sub Title',
					'ProjectIntro'      => 'Insert a Short Description Here',
					'ProjectMinPledge'  => 'Minimum Bid Your Willing To Accept',
					'ProjectDescription'=> 'Blank Description'
				);
				return $row;
			} else {
				return $row;
			}

		}

		function getCategories()
		{
			$this->db->select('*')
				->from('categories');
			$query = $this->db->get();

			return $query;
		}

		function getCategoriesProfile($user_id)
		{
			$this->db->select('*')
				->from('categories')
				->where('categories.userid', $user_id);

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();



			if ($num < 1)
			{
				$query = NULL;
				return $query;
			} else {
				return $query;
			}

		}

		function getFAQProfile($user_id)
		{
			$this->db->select('*')
				->from('faq_table')
				->where('faq_table.user_id', $user_id)
				->join('faq_questions_table', 'faq_questions_table.idfaq_questions_table = faq_table.questionid')
				->join('faq_answers_table', 'faq_answers_table.idfaq_answers_table = faq_table.answerid');

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1)
			{
				$query = NULL;
				return $query;
			} else {
				return $query;
			}

		}

		function getPledgeProfile($id)
		{
			$this->db->select('*')
				->from('pledges_table')
				->where('user_id', $id)
				->join('photos',  'photos.pledgeid = pledges_table.idpledges_table','left');

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1)
			{
				$query = NULL;
				return $query;
			} else {
				return $query;
			}
		}

		function getPledges($id)
		{
			$this->db->select('*')
				->from('pledges_table')
				->where('project_id', $id)
				->join('photos',  'photos.pledgeid = pledges_table.idpledges_table','left')
				->order_by('pledge_amount');

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

		function getCategoryName($id)
		{
			$this->db->select('*')
				->from('categories')
				->where('idcategories', $id);

			$query = $this->db->get();

			$row = $query->row();
			$num = $query->num_rows();

			if ($num < 1)
			{
				return NULL;

			} else {
				$content = $row->category_name;

				return $content;
			}

		}

		function getProjects($id)
		{
			$this->db->select('*')
				->from('projects_table')
				->where('category_id', $id)
				->join('users', 'users.id = projects_table.user_id')
				->join('photos', 'photos.projectid = projects_table.idprojects_table');
			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1)
			{
				$row = array(
					'idprojects_table'  => NULL,
					'ProjectTitle'      => 'There is No Project Here!',
					'ProjectSubTitle'   => 'Yours could be the first!',
					'ProjectIntro'      => 'Sign up for an account.',
					'ProjectMinPledge'  => '',
					'ProjectDescription'=> 'Get your project listed and funded today!'
				);
				return NULL;

			} else {
				return $query;
			}
		}

		function getProject($id)
		{
			$this->db->select('*')
				->from('projects_table')
				->where('idprojects_table', $id)
				->join('users', 'users.id = projects_table.user_id')
				->join('photos', 'photos.projectid = projects_table.idprojects_table');
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

		function setupBlankProject($id)
		{
			$this->db->set('date = DATE_ADD(NOW(), INTERVAL 7 DAY)');
			$data = array(
				'idprojects_table'  => uniqid(rand()),
				'user_id'           => $id,
			);
			$this->db->insert('projects_table',$data);
		}

		function updateCategories($idcategories, $catname, $catdesc, $uid, $redirect)
		{
			if ($idcategories  == '') {
				$data = array(
					'idcategories'		=> uniqid(rand()),
					'catname'			=> $catname,
					'catdescription'	=> $catdesc,
					'userid'			=> $uid
				);
			} else {
				$data = array(
					'idcategories'		=> $idcategories,
					'catname'			=> $catname,
					'catdescription'	=> $catdesc,
					'userid'			=> $uid
				);
			}

			$this->db->select('*')
				->from('categories')
				->where('userid', $uid)
				->where('idcategories', $idcategories);

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1)
			{
				$this->db->insert('categories', $data);
				redirect($redirect);

			} else {
				$this->db->where('idcategories', $projectid);
				$this->db->update('categories', $data);
				redirect($redirect);
			}
		}

		function updatePledge($pledgeid, $pledgeAmount, $pledgeDesc, $pledgeReward, $projectid, $uid, $redirect)
		{

			$this->db->select('*')
				->from('pledges_table')
				->where('idpledges_table', $pledgeid)
				->where('project_id', $projectid);
			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1)
			{
				$data = array(
					'pledge_amount'         => $pledgeAmount,
					'pledge_description'    => $pledgeDesc,
					'pledge_reward'         => $pledgeReward,
					'project_id'            => $projectid,
					'user_id'               => $uid,
				);

				$this->db->insert('pledges_table', $data);
				redirect($redirect);

			} else {

				$data = array(
					'idpledges_table'       => $pledgeid,
					'pledge_amount'         => $pledgeAmount,
					'pledge_description'    => $pledgeDesc,
					'pledge_reward'         => $pledgeReward,
					'project_id'            => $projectid,
					'user_id'               => $uid,
				);

				$this->db->where('idpledges_table', $pledgeid);
				$this->db->update('pledges_table', $data);
				redirect($redirect);
			}
		}

		function updateProject($projectid, $projtitle, $projsubtitle, $projminbid, $projintro, $projdesc, $startdate, $enddate, $userid, $category,  $redirect)
		{
			$data = array(
				'idprojects_table'      => uniqid(rand()),
				'ProjectTitle'          => $projtitle,
				'ProjectSubTitle'       => $projsubtitle,
				'ProjectStartDate'      => $startdate,
				'ProjectEndDate'        => $enddate,
				'ProjectIntro'          => $projintro,
				'ProjectDescription'    => $projdesc,
				'ProjectMinPledge'      => $projminbid,
				'user_id'               => $userid,
				'category_id'           => $category
			);

			$data2 = array(
				'ProjectTitle'          => $projtitle,
				'ProjectSubTitle'       => $projsubtitle,
				'ProjectStartDate'      => $startdate,
				'ProjectEndDate'        => $enddate,
				'ProjectIntro'          => $projintro,
				'ProjectDescription'    => $projdesc,
				'ProjectMinPledge'      => $projminbid,
				'user_id'               => $userid,
				'category_id'           => $category
			);

			$this->db->select('*')
				->from('projects_table')
				->where('user_id', $userid)
				->where('idprojects_table', $projectid);

			$query = $this->db->get();

			$row = $query->row_array();
			$num = $query->num_rows();

			if ($num < 1)
			{
				$this->db->insert('projects_table', $data);
				redirect($redirect);

			} else {
				$this->db->where('idprojects_table', $projectid);
				$this->db->update('projects_table', $data2);
				redirect($redirect);
			}
		}

		public function category($category)
		{
			$data['project_item'] = $this->m_projects->by_category($category);

			if (empty($data['project_item']))
			{
				show_404();
			}

			$data['title'] = $data['project_item']['title'];

			$this->load->view('header', $data);
			$this->load->view('projects/category', $data);
			$this->load->view('footer');
		}

	}
