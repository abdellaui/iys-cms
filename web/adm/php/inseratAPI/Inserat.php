<?php
require_once('URLRenderer.php');
class Inserat extends URLRenderer{
    // intern
    public $portal = -1;
    public $key = -1;
    public $modificationDate = -1;
    public $url = -1;
    // vehicle
    public $price = -1;
    public $currency = -1;
    public $vatable = -1;

    public $class = -1;
    public $category = -1;
    public $condition = -1;
    public $make = -1;
    public $model = -1;
    public $modelDescription = -1;

    // specifications
    public $mileage = -1;
    public $powerKW = -1;
    public $powerPS = -1;
    public $fuel = -1;
    public $gearbox = -1;
    public $firstRegistration = -1;
    public $numberOfPreviousOwners = -1;
    public $airbag = -1;
    public $exteriorColor = -1;
    public $interiorType = -1;
    public $interiorColor = -1;
    // features
    public $featuresArray = [];

    // images
    public $imagesArray = [];

    // description
    public $enrichedDescription = -1;

    public function __construct($portal, $key){
        $this->portal = $portal;
        $this->key = $key;
    }
    public function __toString() {
        $string = $this->price;
        $string .= substr($this->getName(),15);
        $string .= $this->mileage;
        return $string;
    }

    public function getUrl(){
        return $this->key.'&p='.$this->portal.'&l='.$this->toURI($this->make.' '.$this->model);
    }

    public function getName(){
        return $this->make.' '.$this->modelDescription;
    }

    public function getPrice(){
        return $this->price.' '.$this->currency;
    }
    
    public function getCategory(){
        return $this->class.' / '.$this->category;
    }


}
?>