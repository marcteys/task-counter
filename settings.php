<?php 
 class Task { 
	  var $name;var $id;var $color; var $icon;
	  // Default variables for design. There can be more. 

	public function __construct($n, $c, $i,$id = null) 
	{ 
	    $this->name = $n; 
	    $this->color = $c; 
	    $this->icon = $i; 
	    if($id == null) $this->id = $n;
	    else $this->id = $id; 
	} 

	function displayTast($lastDate){ 
	 echo '<div class="button" data-task="'.$this->id.'" style="background:'.$this->color.';"><i class="fas '.$this->icon.' "></i><span>'.$this->name.' '.  $lastDate .'</span>  <i class="arrow fas fa-chevron-right"></i></div>'; 
	} 
	function getId(){ 
	 return  $this->id; 
	} 
} 


$taskList = array(
	// Some have 3 parameters, others have 4. The first paramter is the display name, the last one is the ID. Sometimes the ID has to be different, in case of accents for instance. 
	new Task("Courses","#1abc9c","fa-shopping-cart"),
	new Task("Lessives","#2ecc71","fa-tshirt"),
	new Task("Vaisselle","#3498db","fa-utensils"),
	new Task("Poussières","#e74c3c","fa-wind","Poussieres"),
	new Task("Aspirateur","#8e44ad","fa-broom"),
	new Task("Serpillere","#f1c40f","fa-tint"),
	new Task("Salle de bain","#e67e22","fa-shower","SDB"),
	new Task("Toilettes","#c0392b","fa-toilet-paper"),
	new Task("Cuisine","#8e44ad","fa-spray-can","cuisine")
);

$settings = array(
	"users" => array("Marion", "Marc"),
	"tasks" => $taskList
);

 ?>