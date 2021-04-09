<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/ChallengeFalabella.php';


class ChallengeFalabellaTest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('unit_test');
	}

	public function index()
	{	
		$path = APPPATH.'/tests/';
		foreach (scandir($path) as $file) {
			if(is_file($path.$file)){
				$data = json_decode(file_get_contents($path.$file));
				$test = new ChallengeFalabella($data->data->start, $data->data->increment, $data->data->max, $data->data->mods, $data->data->replace);
				$result = $test->execute_();
				echo $this->unit->run($result, $data->result, $file);
			}
		}
	}


}
