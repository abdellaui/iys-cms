<?php
require_once('IPortal.php');
require_once('Inserat.php');
require(__DIR__ . "./../../../secrets.php");
class MobileAPI implements IPortal{
    private $username;
    private $password;
    private $api_base;

    public function __construct(){
        $this->username = MOBILE_DE_API_PUBLIC;
        $this->password = MOBILE_DE_API_SECRET;
        $this->api_base = 'https://services.mobile.de/search-api/';
    }

    public function execute($query){
        $curl = curl_init($this->api_base . $query); 
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
        curl_setopt($curl, CURLOPT_USERPWD, $this->username.":".$this->password);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: application/xml','Accept-Language: de']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl);
        $curl_error = curl_error($curl);
        curl_close($curl);

        if($curl_error){ return 'error';}

        return $response;
    }
	
	
	public function getInserate(){

	$result = $this->execute('search?page.size=100');
		if($result!='error'){
		$xml = new SimpleXMLElement($result);
		$ns = $xml->getNamespaces(true);
		$child = $xml->children($ns['search']);
			if($child->ads->children($ns['ad'])){
				$inserats = [];
				foreach($child->ads->children($ns['ad']) AS $ad){
					$spec = $ad->vehicle->specifics->children($ns['ad']);

					$inserat = new Inserat('mobile', $ad->attributes()->key->__toString());
					
					$inserat->modificationDate = strtotime($ad->{'creation-date'}->attributes()->value->__toString());
					$inserat->url = $ad->{'detail-page'}->attributes()->url;

					$inserat->make = $ad->vehicle->make->children($ns['resource'])->{'local-description'};
					$inserat->model = $ad->vehicle->model->children($ns['resource'])->{'local-description'};
					$inserat->modelDescription = $ad->vehicle->{'model-description'}->attributes()->value;
		
					$inserat->vatable = $ad->price->vatable->attributes()->value;
					$inserat->price = number_format(substr($ad->price->{'consumer-price-amount'}->attributes()->value, 0, -2), 0,'', '.');
					$inserat->currency = ($ad->price->attributes()->currency =='EUR')?'€':$ad->price->attributes()->currency;
					$inserat->class = $ad->vehicle->class->children($ns['resource'])->{'local-description'};
					$inserat->category = $ad->vehicle->category->children($ns['resource'])->{'local-description'};
					$inserat->condition =$spec->condition->children($ns['resource'])->{'local-description'};
		
					$inserat->mileage = $spec->mileage->attributes()->value;
					$inserat->powerKW = $spec->power->attributes()->value;
					$inserat->powerPS = round($spec->power->attributes()->value*1.35962);
		
					$inserat->fuel = $spec->fuel->children($ns['resource'])->{'local-description'};
		
					$inserat->gearbox = $spec->gearbox->children($ns['resource'])->{'local-description'};
					$inserat->firstRegistration = $spec->{'first-registration'}->attributes()->value;
					$inserat->imagesArray[] = [str_replace('http://','https://',$ad->images->image->representation[3]->attributes()->url), ''];


					$inserats[] = $inserat;


				}
				return $inserats;
			}else{
				return -1;
			}
		}else{
			return -1;
		}
	}
	
	public function getInseratById($id){
		$result = $this->execute('ad/'.$id);
		if($result!='error'){
			$xml = new SimpleXMLElement($result);
			$ns = $xml->getNamespaces(true);
			$ad = $xml->children($ns['ad']);
			$spec = $ad->vehicle->specifics->children($ns['ad']);

			$inserat = new Inserat('mobile', $id);

			$inserat->modificationDate = strtotime($ad->{'creation-date'}->attributes()->value->__toString());
			$inserat->url = $ad->{'detail-page'}->attributes()->url;

			$inserat->make = $ad->vehicle->make->children($ns['resource'])->{'local-description'};
			$inserat->model = $ad->vehicle->model->children($ns['resource'])->{'local-description'};
			$inserat->modelDescription = $ad->vehicle->{'model-description'}->attributes()->value;

			$inserat->vatable = $ad->price->vatable->attributes()->value;
			$inserat->price = number_format(substr($ad->price->{'consumer-price-amount'}->attributes()->value, 0, -2), 0,'', '.');
			$inserat->currency = ($ad->price->attributes()->currency =='EUR')?'€':$ad->price->attributes()->currency;
			$inserat->class = $ad->vehicle->class->children($ns['resource'])->{'local-description'};
			$inserat->category = $ad->vehicle->category->children($ns['resource'])->{'local-description'};
			$inserat->condition =$spec->condition->children($ns['resource'])->{'local-description'};

			$inserat->mileage = $spec->mileage->attributes()->value;
			$inserat->powerKW = $spec->power->attributes()->value;
			$inserat->powerPS = round($spec->power->attributes()->value*1.35962);

			$inserat->fuel = $spec->fuel->children($ns['resource'])->{'local-description'};

			$inserat->gearbox = $spec->gearbox->children($ns['resource'])->{'local-description'};
			$inserat->firstRegistration = $spec->{'first-registration'}->attributes()->value;
			$inserat->numberOfPreviousOwners = $spec->{'number-of-previous-owners'};
			$inserat->airbag = $spec->airbag->children($ns['resource'])->{'local-description'};
			$inserat->exteriorColor = $spec->{'exterior-color'}->children($ns['resource'])->{'local-description'};
			$inserat->interiorType = $spec->{'interior-type'}->children($ns['resource'])->{'local-description'};
			$inserat->interiorColor = $spec->{'interior-color'}->children($ns['resource'])->{'local-description'};
			$inserat->enrichedDescription = str_replace('\\\\','<br>',$ad->enrichedDescription);

			foreach($ad->images->image AS $k){
				$inserat->imagesArray[] = [str_replace('http://','https://',$k->representation[0]->attributes()->url), str_replace('http://','https://',$k->representation[1]->attributes()->url)];
			}

			foreach($ad->vehicle->features->feature AS $feature){
				$inserat->featuresArray[] = $feature->children($ns['resource'])->{'local-description'};
			}

			return $inserat;

		}else{
			return -1;
		}

	}
}
?>