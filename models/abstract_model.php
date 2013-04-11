<?php
	
    abstract class AbstractModel {
	
	protected $id= 0;
	
	protected function is_new(){
		return $this->id == 0;
	}
	public abstract function save();
	public abstract function destroy();
	protected abstract function after_save();
}

?>