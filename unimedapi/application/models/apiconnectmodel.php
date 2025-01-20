<?php
	class Apiconnectmodel extends CI_Model	{

		# Get SPGS Student Login Details
		# ------------------------------
		public function apiconfirmlogin(){
			$fetchparam = trim($this->input->get('passedparam'));
			$paramarray	= explode("|",$fetchparam);
			$passedkey  = $paramarray[0];
			$matricno  	= $paramarray[1];
			$password 	= MD5($paramarray[2]);
			if ($passedkey!='Un1m3dK3ySPGS'){
				return "-2|Access Denied";
				exit;
			}
			$query = $this->db->get_where('spgs_acc', array('username'=>$matricno));
			if ($query->num_rows() == 1){
				# Get the database Password
				# --------------------------
				$dbpassword = trim($query->row(0)->password);
				if($dbpassword==$password){
					# Get the Abridged Info of the Student
					# ------------------------------------
					$queryx = $this->db->get_where('spgs_basicinfo', array('regno'=>$matricno));
					if ($queryx->num_rows() == 1){
						return "1|Access Granted|".trim($query->row(0)->surname). " ".trim($query->row(0)->onames);
					}else{
						return "1|Access Granted|SPGS Student";
					}					
				}else{
					return "-1|Invalid Password";
				}
			}else{
				return "0|Invalid Matric/Registration Numnber";
			}
		}
	}
	
?>
