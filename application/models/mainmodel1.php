<?php
class mainmodel1 extends CI_model
{
	
	//work
		public function regi($a)
		{

		// $this->db->insert("log",$b);
		// $loginid=$this->db->insert_id();
		// $a['loginid']=$loginid;
		$this->db->insert("reg",$a);

		}
		public function encpswd($pass)
			{
				return password_hash($pass, PASSWORD_BCRYPT);
			}
			public function viewt()
	{
		$this->db->select('*');
		$qry=$this->db->get("reg");
		return $qry;

	}
	public function approve($id)
	{
		$this->db->set('status','1');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("reg");
		return $qry;
	}
	public function reject($id)
	{
		$this->db->set('status','0');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("register");
		return $qry;
	}



//login

	public function logi($uname,$pass)
	{
		$this->db->select('password');
		$this->db->from('reg');
		$this->db->where("uname","$uname");
		$qry=$this->db->get()->row("password");
		return $this->verifypas($pass,$qry);
	}
	public function verifypas($pass,$qry)
	{
		return password_verify($pass,$qry);
	}
	public function getuserid($uname)
	{
		$this->db->select('id');
		$this->db->from("reg");
		$this->db->where("uname","$uname");
		return $this->db->get()->row('id');
	}
	public function getuser($id)
	{
		$this->db->select('*');
		$this->db->from("reg");
		$this->db->where("id",$id);
		return $this->db->get()->row();
	}


}
?>