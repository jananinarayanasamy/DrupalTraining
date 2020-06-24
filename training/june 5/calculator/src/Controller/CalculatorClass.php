<?php 

namespace Drupal\calculator\Controller;

use Drupal\Core\Controller\ControllerBase;


interface MyInterface { 
   public  function functionAddition(); 
   public  function functionSubraction(); 
   public  function functionMultiplication(); 
   public  function functionDivision(); 
}
	
trait statusMsgDisplay{
	public function displayMsg($data) {
		return "Successfully ".$data." !!!"."<br><br>";
	}
  
}

/**
 * An example controller.
 */
class CalculatorClass extends ControllerBase implements MyInterface{

  /**
   * Returns a render-able array for a test page.
   */
   
    public $data1 ;
	public $data2 ;
	
    use statusMsgDisplay;
	
	public function __construct ()
	{
	 $this->data1 = 14;
	 $this->data2 = 2;
	}
   
	public function functionAddition(){ 
		return $this->data1 + $this->data2 ;
	} 

	public function functionSubraction(){ 
		return $this->data1 - $this->data2 ;
	}

	public function functionMultiplication(){ 
	   return $this->data1 * $this->data2 ;
	}

	public function functionDivision(){ 
		return $this->data1 / $this->data2 ;
	}


	public function calculate(){
		
		
		$data.="<h2>Input for Calci is  : " .$this->data1." & ".$this->data2."</h2><br><br>";
		
		$data.="Addition Result : " .$this->functionAddition()."<br>";
		$data.=$this->displayMsg('Added')."<br>";
		$data.="Subtraction Result : " .$this->functionSubraction()."<br>";
		$data.=$this->displayMsg('Subracted')."<br>";
		$data.="Multiply Result :" .$this->functionMultiplication()."<br>";
		$data.=$this->displayMsg('Multiplied')."<br>";
		$data.="Division Result : " .$this->functionDivision()."<br>";
		$data.=$this->displayMsg('Divided')."<br>";
		$data.=$this->displayMsg('calcualted')."<br>";
		
		$build = [
		  '#markup' => $this->t($data),
		];
		
		
		
		return $build;
	}



}

?>