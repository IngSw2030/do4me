<?php  class do4me_order_client_info{	public $order_client_info_id;	public $order_id;	public $order_id1;	public $client_id;	public $client_name;	public $client_email;	public $client_phone;	public $client_personal_info;	public $order_duration = 0;	public $recurring_id;	public $status;	public $user_id;	public $service_id;	public $conn;	public $table_name="ct_order_client_info";	public $tablename3="ct_users";	public $tablename_rec="ct_recurring_status";		/* 	* Function for add Order Client 	*	*/		public function add_order_client(){		$query="insert into `".$this->table_name."` (`id`,`order_id`,`client_name`,`client_email`,`client_phone`,`client_personal_info`,`order_duration`,`recurring_id`) values(NULL,'".$this->order_id."','".$this->client_name."','".$this->client_email."','".$this->client_phone."','".$this->client_personal_info."','".$this->order_duration."','".$this->recurring_id."')";		$result=mysqli_query($this->conn,$query);		return $result;				}	public function readone_for_email(){		$query="select `email`,`fullname` from `ct_admin_info`";		$result=mysqli_query($this->conn,$query);		$value=mysqli_fetch_array($result);		return $value;	}	public function readone_order_client(){		$query="select * from " .$this->table_name." WHERE order_id = '".$this->order_id."'" ;		$result=mysqli_query($this->conn,$query);		$value=mysqli_fetch_array($result);		return $value;	}	/*Function to Get Last order id from booking table used in front end for add cart item in booking table*/	public function last_recurring_id(){		$query="select max(`recurring_id`) from `".$this->table_name."`";		$result=mysqli_query($this->conn,$query);		$value=mysqli_fetch_row($result);		return $value= isset($value[0])? $value[0] : '' ;	}	public function get_clone_order_id(){		$query="select `order_id` from `".$this->table_name."` where `recurring_id`='".$this->recurring_id."'";		$result=mysqli_query($this->conn,$query);		$return_order_id = "";		while($row = mysqli_fetch_assoc($result)){			$b_order_id = $row["order_id"];			$qq="select `order_id` from `ct_bookings` where `order_id`='".$b_order_id."'";			$res=mysqli_query($this->conn,$qq);			if(mysqli_num_rows($res) > 0){				$r_o_id = mysqli_fetch_assoc($res);				$return_order_id = $r_o_id["order_id"];				break;			}		}		return $return_order_id;	}		public function get_all_recurring_ids(){		$query="select DISTINCT `recurring_id` from `".$this->table_name."` ";		$result=mysqli_query($this->conn,$query);		$rec_array = array();		while($acc_rec = mysqli_fetch_assoc($result)){			$recurring_id = $acc_rec["recurring_id"];			$qq="select count(`recurring_id`) as `rec_count` from `".$this->table_name."` where `recurring_id`='".$recurring_id."'";			$res=mysqli_query($this->conn,$qq);			$val=mysqli_fetch_assoc($res);			if($val["rec_count"] > 1){				$rec_array[] = $recurring_id;			}		}		return $rec_array;	}	public function read_all_by_rec_id(){		$query="select `order_id` from " .$this->table_name." WHERE `recurring_id` = '".$this->recurring_id."'" ;		$result=mysqli_query($this->conn,$query);		return $result;	}	public function read_last_order_id_by_rec_id(){		$query="select `order_id` from " .$this->table_name." WHERE `recurring_id` = '".$this->recurring_id."' order by `order_id` DESC limit 1";		$result=mysqli_query($this->conn,$query);		$value=mysqli_fetch_assoc($result);		return $value["order_id"];	}	public function count_recurring_id(){		$qq="select count(`recurring_id`) as `rec_count` from `".$this->table_name."` where `recurring_id`='".$this->recurring_id."'";		$res=mysqli_query($this->conn,$qq);		$val=mysqli_fetch_assoc($res);		return $val["rec_count"];	}	public function add_rec_status(){		$query="insert into `".$this->tablename_rec."` (`id`,`recurring_id`,`status`) values(NULL,'".$this->recurring_id."','P')";		$result=mysqli_query($this->conn,$query);		return $result;	}	public function get_one_rec_status(){		$query="select * from " .$this->tablename_rec." WHERE `recurring_id` = '".$this->recurring_id."'" ;		$result=mysqli_query($this->conn,$query);		return $result;	}	public function delete_one_rec_status(){		$query="delete from " .$this->tablename_rec." WHERE `recurring_id` = '".$this->recurring_id."'" ;		$result=mysqli_query($this->conn,$query);		return $result;	}	public function accept_one_rec_status(){		$query="update " .$this->tablename_rec." set `status`='A' WHERE `recurring_id` = '".$this->recurring_id."'" ;		$result=mysqli_query($this->conn,$query);		return $result;	}}?>