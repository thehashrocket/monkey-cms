<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

	/**
	 *
	 */
	class Category_model extends CI_Model
	{

		/**
		 * @param $user_id
		 *
		 * @return null
		 */
		function getAjaxCategoryList($user_id)
		{
			$this->db->select( '*' )
				->from( 'categories' )
				->where( 'userid', $user_id );

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

		/**
		 * @param $faq_id
		 * @param $question
		 * @param $answer
		 * @param $uid
		 * @param $redirect
		 */
		function updateCategories($idcategories, $catname, $catdesc, $uid)
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

			} else {
				$this->db->where('idcategories', $idcategories);
				$this->db->update('categories', $data);
			}
		}


		/**
		 * @param $id
		 *
		 * @return null
		 */
		function getCategoryName($id)
		{
			$this->db->select( '*' )
				->from( 'categories' )
				->where( 'idcategories', $id );

			$query = $this->db->get();

			$row = $query->row();
			$num = $query->num_rows();

			if ( $num < 1 ) {
				return NULL;

			}
			else {
				$content = $row->category_name;

				return $content;
			}

		}


		/**
		 * @param $id
		 */
		function deleteCategory($id)
		{
			$this->db->where( 'idcategories', $id );
			$this->db->delete( 'categories' );
		}
	}