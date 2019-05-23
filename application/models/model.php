<?php

	class model extends CI_Model {

		public function save_account($data){
			$this->db->insert('users',$data);
			return $this->db->affected_rows();
		}
		
		public function search($search){
			$this->db->select('lastname');
			$this->db->from('users');
			$this->db->like('lastname', $search);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function check_valid($account,$pin){
			$this->db->select('pin');
			$this->db->from('users');
			$this->db->where('account', $account);
			$query = $this->db->get();
			
			if ($query->num_rows() == 1) {
				return true;
			} else {
				return false;
			}
		}

		public function information($account) {
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('account', $account);
			$query = $this->db->get();
			return $query->result();

		}




		public function query() {
			$this->db->select('*');
			$this->db->from('insurance');
			$this->db->join('part', 'insurance.part = part.id');
			$this->db->join('branch', 'insurance.branch = branch.id');
			$result    =  $this->db->get();

			return $result->result_array();
		}


		public function filter($month, $offset, $limit) {
			$this->db->select('*');
			$this->db->from('insurance');
			$this->db->join('part', 'insurance.part = part.id');
			$this->db->join('branch', 'insurance.branch = branch.id');
			$this->db->like('maturity', $month);
			$this->db->limit($limit, $offset);
			
			
			$result    =  $this->db->get();
	
			return $result->result_array();
		}

		public function filterrow($month) {

			$this->db->select('*');
			$this->db->from('insurance');
			$this->db->join('part', 'insurance.part = part.id');
			$this->db->join('branch', 'insurance.branch = branch.id');
			$this->db->like('maturity', $month);
			$result    =  $this->db->get();
			
			return $result->num_rows();
		}











		 public function view_all_users($limit,$offset){
			$this->db->select('*');
			$this->db->from('insurance');
			$this->db->join('part', 'insurance.part = part.id');
			$this->db->join('branch', 'insurance.branch = branch.id');
			$this->db->limit($limit,$offset);
			$result    =  $this->db->get();

			return $result->result_array();
		 }

		 public function rowcount() {
		 	$this->db->select('*');
			$this->db->from('insurance');
			$result    =  $this->db->get();
			
			return $result->num_rows();
		 }

		public function useraccount($id) {
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_branch () {
			$this->db->select('*');
			$this->db->from('branch');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_part () {
			$this->db->select('*');
			$this->db->from('part');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function save($data){
			$this->db->insert('insurance',$data);
			return $this->db->affected_rows();
		}
		
	}

?>