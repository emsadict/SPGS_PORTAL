<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	error_reporting(0);
	session_start();
	
	#-------------------------------------------------------# 
	# Description 											#
	# Author: 			Kayode Olufemi Johnson				#
	# Date-Written : 	4th December, 2023					#
	# Title:			API for connecting SPGS Students 	#
	#                   Login Details						#
	#-------------------------------------------------------#
	class Apiconnect extends CI_Controller {		

		# This is a constructed
		# ---------------------
		public function __construct(){
			parent::__construct();
			$this->load->model('apiconnectmodel');		
		}
		
		public function index(){
			echo "<div style='margin-left:40%;margin-top:120;color:red;'><h1>This is an illegal function call</h1></div>";
			exit;
		}		
		# Get SPGS Student Login Details
		# ------------------------------
		public function apiconfirmlogin(){
			$result = $this->apiconnectmodel->apiconfirmlogin();
			echo $result;		
		}

	}
?>
	