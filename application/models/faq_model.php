<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq_model extends CI_Model {
	
	function getAjaxFAQList($user_id)
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
				return NULL;
			} else {
				echo json_encode($query->result_array());

			}

		}

	function updateFAQ($faq_id, $question, $answer, $uid)
		{

			$this->db->select('*')
				->from('faq_table')
				->where('idfaq_table', $faq_id);
			$query = $this->db->get();

			$row = $query->row();
			$num = $query->num_rows();

			if ($num < 1)
			{
				$questid    = uniqid(rand());
				$answerid   = uniqid(rand());
				$faq_id     = uniqid(rand());
				$qdata = array(
					'idfaq_questions_table'     => $questid,
					'question'                  => $question,
					'idfaq_table'				=> $faq_id
				);
				$adata = array(
					'idfaq_answers_table'       => $answerid,
					'answers'                   => $answer,
					'idfaq_table'				=> $faq_id
				);
				$fdata = array(
					'idfaq_table'               => $faq_id,
					'questionid'                => $questid,
					'answerid'                  => $answerid,
					'user_id'                   => $uid
				);
				$this->db->insert('faq_questions_table', $qdata);

				$this->db->insert('faq_answers_table', $adata);

				$this->db->insert('faq_table', $fdata);

			} else {

				$qdata = array(
					'question'                  => $question,
				);
				$adata = array(
					'answers'                   => $answer,
				);

				$questid  = $row->questionid;
				$answerid = $row->answerid;

				$this->db->where('idfaq_answers_table', $answerid);
				$this->db->update('faq_answers_table', $adata);

				$this->db->where('idfaq_questions_table', $questid);
				$this->db->update('faq_questions_table', $qdata);

			}
		}


	function deleteFaq($faq_id)
		{
			$this->db->delete('faq_table', array('idfaq_table' => $faq_id));
			$this->db->delete('faq_questions_table', array('idfaq_table' => $faq_id));
			$this->db->delete('faq_answers_table', array('idfaq_table' => $faq_id));

		}
}