<?php

class ChallengeFalabella extends CI_Controller{
	private $max; 
	private $mods = [];
	private $mods_valid = [];
	private $mods_replace;
	private $start;
	private $increment; 
	public $result = [];

    function __construct($start_, $increment_, $max_, $mods_, $mods_replace_ )
    {
    	$this->start = $start_;
		$this->increment = $increment_;
    	$this->max = $max_;
    	$this->mods = $mods_;
     	$this->mods_replace = $mods_replace_ ;   
    }


    private function valid($i) : string
    {
    	$index_ = -1;
    	$this->mods_replace[-1] = $i;
    	$this->is_mod($i);
    	$this->is_mod_all();

    	foreach ($this->mods_valid as $key => $value) {
    		if($value == 0){
    			$index_ = $key;
    		}
    	}

    	return $this->mods_replace[$index_];
	}


	private function is_mod($i) : void
	{
		$this->mods_valid = [];
		foreach ($this->mods as $value) {
			$this->mods_valid[] = fmod($i, $value);
		}
	}


	private function is_mod_all() : void
	{
		$count = count($this->mods_valid);
		$this->mods_valid[$count] = 0;
		foreach ($this->mods_valid as $value) {
			$this->mods_valid[$count] += $value;
		}
	}


	public function execute_()
	{
		for($i=$this->start ; $i <= $this->max; $i+=$this->increment){
			$this->result[] = $this->valid($i);
		}
		return $this->result;
	}
}


?>