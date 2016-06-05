<?php
class speedtest {
	
	private $database;
	
	private $error = array();
	
	public $device_type = array(
				'laptop' => 'Laptop',
				'desktop' => 'Desktop',
				'mac' => 'Mac',
				'phone' => 'Phone',
				'ipad' => 'Ipad',
				'tablet' => 'Tablet',
			);
	
	public $system = array(
				'winxp' => 'Windows XP',
				'win7' => 'Windows 7',
				'win8' => 'Windows 8',
				'win10' => 'Windows 10',
				'linux' => 'linux',
				'osx' => 'osx',
				'ios' => 'ios',
				'android' => 'android',
			);
	
	public $internet_type = array(
				'wifi' => 'Wifi',
				'cable' => 'Cable',
				'3G' => '3G',
				'4G' => '4G',
			);
	
	public function __construct() {
		$this->database = new medoo([
				'database_type' => 'mysql',
				'database_name' => 'speedtest',
				'server' => 'localhost',
				'username' => 'barak',
				'password' => 'barak1991',
				'charset' => 'utf8'
			]);
	}
	
	public function add_position($info) {
		$data = array();
		
		if (!isset($info['name']) || trim($info['name']) == "")
			$this->error("Please enter position name");
		else $data['name'] = $info['name'];
		
		if ($this->has_error())
			return false;
		
		if (isset($info['provider']) && trim($info['provider']) != "")
			$data['provider'] = $info['provider'];
		
		$last_user_id = $this->database->insert("positions", $data);
		
		if (!$last_user_id) {
			$this->error("Error");
			return false;
		}
		return true;
	}
	
	public function edit_position($info) {
		$data = array();
		
		$temp = false;
		
		if (!isset($info['id']))
			$this->error("Error");
		else {
			$temp = $this->get_position($info['id']);
			if (!$temp)
				$this->error("Error");
		}
		
		if (!isset($info['name']) || trim($info['name']) == "")
			$this->error("Please enter position name");
		else $data['name'] = $info['name'];
		
		if ($this->has_error())
			return false;
		
		if (isset($info['provider']) && trim($info['provider']) != "")
			$data['provider'] = $info['provider'];
		
		$data2 = array();
		
		foreach ($data as $k => $v)
			if (isset($temp[$k]) && $v != $temp[$k])
				$data2[$k] = $v;
		
		if (empty($data2)){
			$this->error("Please change somthing..");
			return false;
		}
			
		$last_user_id = $this->database->update("positions", $data,["id" => $info['id']]);
		
		if (!$last_user_id) {
			$this->error("Error");
			return false;
		}
		return true;
	}
	
	public function delete_position($id) {
		$this->database->delete("positions", ["id" => $id]);
		$this->database->delete("speedtests", ["position_id" => $id]);
	}
	
	public function get_position($id = false) {
		if ($id)
			return $this->database->get("positions", "*", ["id" => $id]);
		
		return $this->database->select("positions", "*");
	}
	
	public function add_device($info) {
		
		$data = array();
		
		if (!isset($info['device_name']) || trim($info['device_name']) == "")
			$this->error("Please enter device name");
		else $data['device_name'] = $info['device_name'];
		
		if (isset($info['device_type']) && $this->validSelectOption($this->device_type,$info['device_type'],"device type"))
			$data['device_type'] = $info['device_type'];
		
		if (isset($info['system']) && $this->validSelectOption($this->system,$info['system'],"device system"))
			$data['system'] = $info['system'];
		
		if (isset($info['internet_type']) && $this->validSelectOption($this->internet_type,$info['internet_type'],"Internet type"))
			$data['internet_type'] = $info['internet_type'];
		
		if ($this->has_error())
			return false;
		
		$last_user_id = $this->database->insert("devices", $data);
		
		if (!$last_user_id) {
			$this->error("Error");
			return false;
		}
		return true;
	}
	
	public function edit_device($info) {
		$data = array();
		
		$temp = false;
		
		if (!isset($info['id']))
			$this->error("Error");
		else {
			$temp = $this->get_device($info['id']);
			if (!$temp)
				$this->error("Error");
		}
		
		if (!isset($info['device_name']) || trim($info['device_name']) == "")
			$this->error("Please enter device name");
		else $data['device_name'] = $info['device_name'];
		
		if (isset($info['device_type']) && $this->validSelectOption($this->device_type,$info['device_type'],"device type"))
			$data['device_type'] = $info['device_type'];
		
		if (isset($info['system']) && $this->validSelectOption($this->system,$info['system'],"device system"))
			$data['system'] = $info['system'];
		
		if (isset($info['internet_type']) && $this->validSelectOption($this->internet_type,$info['internet_type'],"Internet type"))
			$data['internet_type'] = $info['internet_type'];
		
		if ($this->has_error())
			return false;
		
		$data2 = array();
		
		foreach ($data as $k => $v)
			if (isset($temp[$k]) && $v != $temp[$k])
				$data2[$k] = $v;
		
		if (empty($data2)){
			$this->error("Please change somthing..");
			return false;
		}
			
		$last_user_id = $this->database->update("devices", $data,["id" => $info['id']]);
		
		if (!$last_user_id) {
			$this->error("Error");
			return false;
		}
		return true;
	}
	
	public function delete_device($id) {
		$this->database->delete("devices", ["id" => $id]);
		$this->database->delete("speedtests", ["device_id" => $id]);
	}
	
	public function get_device($id = false) {
		if ($id)
			return $this->database->get("devices", "*", ["id" => $id]);
		
		return $this->database->select("devices", "*");
	}
	
	public function add_speedtest($info) {
		$data = array();
		
		if (!isset($info['position_id']) || !$this->database->has("positions", ["id" => $info['position_id']]))
			$this->error("Error");
		else $data['position_id'] = $info['position_id'];
		
		if (!isset($info['device_id']) || !$this->database->has("devices", ["id" => $info['device_id']]))
			$this->error("Error");
		else $data['device_id'] = $info['device_id'];
		
		if ($this->has_error())
			return false;
		
		if (isset($info['internet_distance']) && trim($info['internet_distance']) != "")
			$data['internet_distance'] = $info['internet_distance'];
		
		if (isset($info['downloadSpeedAverage']) && trim($info['downloadSpeedAverage']) != "")
			$data['downloadSpeedAverage'] = $info['downloadSpeedAverage'];
		
		if (isset($info['downloadSpeedMedian']) && trim($info['downloadSpeedMedian']) != "")
			$data['downloadSpeedMedian'] = $info['downloadSpeedMedian'];
		
		if (isset($info['downloadSpeedMax']) && trim($info['downloadSpeedMax']) != "")
			$data['downloadSpeedMax'] = $info['downloadSpeedMax'];
		
		if (isset($info['uploadSpeedAverage']) && trim($info['uploadSpeedAverage']) != "")
			$data['uploadSpeedAverage'] = $info['uploadSpeedAverage'];
		
		if (isset($info['uploadSpeedMedian']) && trim($info['uploadSpeedMedian']) != "")
			$data['uploadSpeedMedian'] = $info['uploadSpeedMedian'];
		
		if (isset($info['uploadSpeedMax']) && trim($info['uploadSpeedMax']) != "")
			$data['uploadSpeedMax'] = $info['uploadSpeedMax'];
		
		if (isset($info['pingSpeedAverage']) && trim($info['pingSpeedAverage']) != "")
			$data['pingSpeedAverage'] = $info['pingSpeedAverage'];
		
		if (isset($info['pingSpeedMedian']) && trim($info['pingSpeedMedian']) != "")
			$data['pingSpeedMedian'] = $info['pingSpeedMedian'];
		
		if (isset($info['pingSpeedMin']) && trim($info['pingSpeedMin']) != "")
			$data['pingSpeedMin'] = $info['pingSpeedMin'];
		
		$last_user_id = $this->database->insert("speedtests", $data);
		
		if (!$last_user_id) {
			$this->error("Error");
			return false;
		}
		return true;
	}
	
	public function delete_speedtest($id) {
		$this->database->delete("speedtests", ["id" => $id]);
	}
	
	public function edit_speedtest($info) {
		$data = array();
		
		$temp = false;
		
		if (!isset($info['id'])) {
			$this->error("Error");
			return false;
		} else {
			$temp = $this->database->get("speedtests", "*", ["id" => $info['id']]);
			if (!$temp)
				$this->error("Error");
		}
		
		if (!isset($info['position_id']) || !$this->database->has("positions", ["id" => $info['position_id']]))
			$this->error("Error");
		else $data['position_id'] = $info['position_id'];
		
		if (!isset($info['device_id']) || !$this->database->has("devices", ["id" => $info['device_id']]))
			$this->error("Error");
		else $data['device_id'] = $info['device_id'];
		
		if ($this->has_error())
			return false;
		
		if (isset($info['internet_distance']) && trim($info['internet_distance']) != "")
			$data['internet_distance'] = $info['internet_distance'];
		
		if (isset($info['downloadSpeedAverage']) && trim($info['downloadSpeedAverage']) != "")
			$data['downloadSpeedAverage'] = $info['downloadSpeedAverage'];
		
		if (isset($info['downloadSpeedMedian']) && trim($info['downloadSpeedMedian']) != "")
			$data['downloadSpeedMedian'] = $info['downloadSpeedMedian'];
		
		if (isset($info['downloadSpeedMax']) && trim($info['downloadSpeedMax']) != "")
			$data['downloadSpeedMax'] = $info['downloadSpeedMax'];
		
		if (isset($info['uploadSpeedAverage']) && trim($info['uploadSpeedAverage']) != "")
			$data['uploadSpeedAverage'] = $info['uploadSpeedAverage'];
		
		if (isset($info['uploadSpeedMedian']) && trim($info['uploadSpeedMedian']) != "")
			$data['uploadSpeedMedian'] = $info['uploadSpeedMedian'];
		
		if (isset($info['uploadSpeedMax']) && trim($info['uploadSpeedMax']) != "")
			$data['uploadSpeedMax'] = $info['uploadSpeedMax'];
		
		if (isset($info['pingSpeedAverage']) && trim($info['pingSpeedAverage']) != "")
			$data['pingSpeedAverage'] = $info['pingSpeedAverage'];
		
		if (isset($info['pingSpeedMedian']) && trim($info['pingSpeedMedian']) != "")
			$data['pingSpeedMedian'] = $info['pingSpeedMedian'];
		
		if (isset($info['pingSpeedMin']) && trim($info['pingSpeedMin']) != "")
			$data['pingSpeedMin'] = $info['pingSpeedMin'];
		
		
		$data2 = array();
		
		foreach ($data as $k => $v)
			if (isset($temp[$k]) && $v != $temp[$k])
				$data2[$k] = $v;
		
		if (empty($data2)){
			$this->error("Please change somthing..");
			return false;
		}
			
		$last_user_id = $this->database->update("speedtests", $data,["id" => $info['id']]);
		
		if (!$last_user_id) {
			$this->error("Error");
			return false;
		}
		return true;
	}
	
	public function getSpeedTest($id = false) {
		if ($id) {
			$temp = $this->database->get("speedtests", "*", ["id" => $id]);
			
			if (isset($temp['position_id']))
				$temp['position'] = $this->database->get("positions", "*", ["id" => $temp['position_id']]);
			
			if (isset($temp['device_id']))
				$temp['device'] = $this->database->get("devices", "*", ["id" => $temp['device_id']]);
			
			return $temp;
		}
		$positions = $this->database->select("positions", "*");
		
		if (!$positions || empty($positions))
			return array();
		
		foreach ($positions as $k => $v) {
			$positions[$k]['speedTest'] = $this->database->select("speedtests", "*",['position_id' => $v['id']]);
			
			if ($positions[$k]['speedTest'] && !empty($positions[$k]['speedTest'])) {
				foreach ($positions[$k]['speedTest'] as $testKey => $test) {
					if (isset($positions[$k]['speedTest'][$testKey]['device_id'])) {
						$positions[$k]['speedTest'][$testKey]['device'] = $this->database->get("devices", "*", ["id" => $positions[$k]['speedTest'][$testKey]['device_id']]);
					}
				}
			}
			
		}
		return $positions;
	}
	
	private function validSelectOption($selectOptions,$selected,$selectName) {
		if (!isset($selectOptions[$selected])) {
			$this->error("The value of " . $selectName . " don't valid.");
			return false;
		}
		return true;
	}
	public function error($msg = false) {
		if ($msg) {
			$this->error[] = $msg;
			return true;
		} else if (!empty($this->error))
			return $this->error;
		return false;
	}
	public function has_error() {
		if (!empty($this->error))
			return true;
		return false;
	}
}