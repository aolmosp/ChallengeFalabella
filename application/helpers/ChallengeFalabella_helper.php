<?php 

class ChallengeFalabella_helper{
	private $max; 
	private $mods = [];
	private $mods_valid = [];
	private $mods_replace; 
	public $result = [];

    function __construct($data)
    {
    	$this->max = $data['max_'];
    	$this->mods = $data['mods_'];
     	$this->mods_replace = $data['mods_replace_'] ;   
    }

    public function index(){
    	
    }
    private function valid($i){
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


	private function is_mod($i){
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


	public function execute_(){
		for($i=1 ; $i <= $this->max; $i++){
			$this->result[] = $this->valid($i);
		}
	}
}





?>