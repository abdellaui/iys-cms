<?php
require_once('Inserat.php');
require_once('MobileAPI.php');

class ApiClass {
	private $mobile;

	public function __construct(){
		$this->mobile = new MobileAPI();
	}


	public function listInserate($page = 0){
		$inserats = [];

		$mobileInserate = $this->mobile->getInserate();
		if($mobileInserate == -1) return -1;

		$inserats = array_merge($mobileInserate);
		$inserats = array_unique($inserats);

		if(empty($inserats)) return -1;

		usort($inserats, function($a, $b){
			$aD = $a->modificationDate;
			$bD = $b->modificationDate;
		   
			if($aD == $bD) return 0;
			if($aD < $bD) return 1;
			if($aD > $bD) return -1;
		});
		$pages = '';
		/*
		$pages .= '<br><br><br><br><br>';
		$pages .= $this->blaetterfunktion($page, $count, '/fahrzeuge', '6', 'page');
		*/
		return $this->renderInserate($inserats).$pages;

	}

	public function showInseratMobile($id){
		$inserat = $this->mobile->getInseratById($id);
		if($inserat == -1) return -1;

		return $this->renderSingleInserat($inserat);
	}

	public function showInseratAutoscout($id){
		return -1;
	}

	private function renderInserate($inseratArray) {
		$return = '';
		$init = false;
		foreach($inseratArray AS $inserat){
			if($inserat->vatable=='false'){
				$ausweisbar ='MwSt. nicht ausweisbar';
			}else{
				$ausweisbar ='MwSt. ausweisbar';
			}
			if($init){
				$return .= '<hr class="iysCmsAutoHaendler">';
			}else{
				$return .= '';
			}
			$return .= '<div class="row"><div class="col-sm-12"><h3>';
			$return .= $inserat->getName();
			$return .= '</h3></div>';
			$return .= '<div class="col-sm-4 col-md-3 "><a href="/fahrzeuge?fid=';
			$return .= $inserat->getUrl();
			$return .= '"  title="';
			$return .= $inserat->getName();
			$return .= '">';
			$return .= '<img class="shadowBorder img-responsive center-block" src="';
			$return .= $inserat->imagesArray[0][0];
			$return .= '" alt="';
			$return .= $inserat->getName();
			$return .= '"></a></div>';
			$return .= '<div class="col-sm-8 col-md-9 noPadding"><div class="col-sm-4 col-sm-push-8 text-right"><h3><b>';
			$return .= $inserat->getPrice();
			$return .= '</b></h3><h5>'.$ausweisbar.'</h5>';
			$return .= '<a class="btn btn-default" href="/fahrzeuge?fid=';
			$return .= $inserat->getUrl();
			$return .= '"  title="';
			$return .= $inserat->getName();
			$return .= '">';
			$return .= '<i class="glyphicon glyphicon-info-sign"></i> Info</a></div><div class="col-sm-8 col-sm-pull-4 noPadding"><p><b>';
			$return .= $inserat->getCategory();
			$return .= '<br>';
			$return .= $inserat->condition;
			$return .= '</b></p>';
			$return .= '<div class="col-xs-6 noPadding">Kilometerstand</div><div class="col-xs-6 noPadding text-bold">';
			$return .= $inserat->mileage;
			$return .= ' km</div>';
			$return .= '<div class="col-xs-6 noPadding">Leistung</div><div class="col-xs-6 noPadding text-bold">';
			$return .= $inserat->powerKW;
			$return .= ' kW (';
			$return .= $inserat->powerPS;
			$return .= ' PS)</div>';
			$return .='<div class="col-xs-6 noPadding">Kraftstoffart</div><div class="col-xs-6 noPadding text-bold">';
			$return .= $inserat->fuel;
			$return .= '</div>';
			$return .= '<div class="col-xs-6 noPadding">Getriebe</div><div class="col-xs-6 noPadding text-bold">';
			$return .= $inserat->gearbox;
			$return .= '</div>';
			$return .= '<div class="col-xs-6 noPadding">Erstzulassung</div><div class="col-xs-6 noPadding text-bold">';
			$return .= $inserat->firstRegistration;
			$return .= '</div>';
			$return .= '</div></div></div>';
			$init = true;
		}
		return $return;
	}

	private function renderSingleInserat($inserat) {
		$return = '';
		$return .= '<div class="row"><div class="col-sm-12"><hr class="iysCmsAutoHaendler"><h1 class="iysCmsAutoHaendlerText">';
		$return .= $inserat->getName();
		$return .= '</h1><hr class="iysCmsAutoHaendler"></div><div class="col-sm-12"><ul id="automobileiysCmsGalery">';
		
		foreach($inserat->imagesArray AS $image){
			$return .= '<li data-thumb="';
			$return .= $image[0];
			$return .= '" data-src="';
			$return .= $image[1];
			$return .= '"><img src="';
			$return .= $image[1];
			$return .= '" class="galeryResponsive"></li>';
		}

		if($inserat->vatable =='false'){
			$ausweisbar ='MwSt. nicht ausweisbar';
		}else{
			$ausweisbar ='MwSt. ausweisbar';
		}
		$return .= '</ul></div><div class="col-sm-12"><hr class="iysCmsAutoHaendler"></div><div class="col-sm-12"><div class="row noPadding"><div class="col-sm-12 hidden-md hidden-lg"><h3><b>';
		$return .= $inserat->getPrice();
		$return .= '</b></h3><h5>'.$ausweisbar.'</h5>';

		$return .= '<a class="btn btn-default pull-right" href="';
		$return .= $inserat->url;
		$return .= '" target="_blank" title="';
		$return .= $inserat->getName();
		$return .= '">';
		$return .= '<i class="glyphicon-glyphicon-share-alt"></i> zum Inserat</a>';

		$return .= '</div><div class="col-sm-12 hidden-md hidden-lg"><hr class="iysCmsAutoHaendler"></div><div class="col-sm-8"><h4><b>';
		$return .= $inserat->getCategory();
		$return .= '<br>';
		$return .= $inserat->condition;
		$return .= '</b></h4>';
		$return .='<div class="row"><div class="col-xs-6">Kategorie</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->category;
		$return .= '</div></div>';
		$return .='<div class="row"><div class="col-xs-6">Marke</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->make;
		$return .= '</div></div>';
		$return .='<div class="row"><div class="col-xs-6">Modell</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->model;
		$return .= '</div></div>';
		$return .='<div class="row"><div class="col-xs-6">Kilometerstand</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->mileage;
		$return .= ' km</div></div>';
		$return .='<div class="row"><div class="col-xs-6">Leistung</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->powerKW;
		$return .= ' kW (';
		$return .= $inserat->powerPS;
		$return .= ' PS)</div></div>';
		$return .='<div class="row"><div class="col-xs-6">Kraftstoffart</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->fuel;
		$return .= '</div></div>';
		$return .='<div class="row"><div class="col-xs-6">Getriebe</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->gearbox;
		$return .= '</div></div>';
		$return .='<div class="row"><div class="col-xs-6">Erstzulassung</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->firstRegistration;
		$return .= '</div></div>';
		$return .='<div class="row"><div class="col-xs-6">Anzahl der Fahrzeughalter</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->numberOfPreviousOwners;
		$return .= '</div></div>';
		$return .='<div class="row"><div class="col-xs-6">Airbags</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->airbag;
		$return .= '</div></div>';
		$return .='<div class="row"><div class="col-xs-6">Farbe</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->exteriorColor;
		$return .= '</div></div>';
		$return .='<div class="row"><div class="col-xs-6">Innenausstattung</div><div class="col-xs-6 noPadding text-bold">';
		$return .= $inserat->interiorType;
		$return .= ', ';
		$return .= $inserat->interiorColor;
		$return .= '</div></div>';
		$return .='</div><div class="col-sm-4 hidden-sm hidden-xs text-right"><h3><b>';
		$return .= $inserat->getPrice();
		$return .= '</b></h3><h5>'.$ausweisbar.'</h5>';

		$return .= '<a class="btn btn-default pull-right" href="';
		$return .= $inserat->url;
		$return .= '" target="_blank" title="';
		$return .= $inserat->getName();
		$return .= '">';
		$return .= '<i class="glyphicon-glyphicon-share-alt"></i> zum Inserat</a>';

		$return .= '</div></div></div><div class="col-sm-12"><hr class="iysCmsAutoHaendler"></div>';
		$return .='<div class="col-sm-12"><div class="col-sm-12 noPadding"><h4><b>Ausstattung</b></h4></div>';
		
		foreach($inserat->featuresArray AS $feature){
			$return .= '<div class="col-sm-6 col-md-4"><i class="glyphicon glyphicon-ok"></i>&nbsp; ';
			$return .= $feature;
			$return .= '</div>';
		}
		
		$return .= '</div>';
		$return .= '<div class="col-sm-12"><hr class="iysCmsAutoHaendler"></div><div class="col-sm-12"><div class="col-sm-12 noPadding"><h4><b>Fahrzeugbeschreibung</b></h4>';
		$return .= $inserat->enrichedDescription;
		$return .= '</div></div>';
		$return .= '<div class="col-sm-12"><hr class="iysCmsAutoHaendler"></div><div class="col-sm-12"><div class="col-sm-12 noPadding"><h4><b>Kontaktaufnahme</b></h4></div><form method="post" class="form-horizontal" id="kontaktFormular" data-toggle="validator" role="form"><!-- Text input--><div class="form-group has-feedback"><label class="col-md-2 control-label">Ihr Name</label>  <div class="col-md-10"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input  name="vorname" placeholder="Vor- und Nachname" class="form-control" type="text" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div></div></div><!-- Text input--><div class="form-group has-feedback"><label class="col-md-2 control-label">E-Mail</label>  <div class="col-md-10 inputGroupContainer"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input name="email" placeholder="E-Mail Addresse" class="form-control"  type="text" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div></div></div><!-- Text input--><div class="form-group has-feedback"><label class="col-md-2 control-label" >Betreff</label> <div class="col-md-10"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-share-alt"></i></span><input name="betreff" placeholder="Betreff" class="form-control" value="(Fahrzeuganfrage) ';
		$return .= $inserat->getName();
		$return .= '" type="text" required><span class="glyphicon form-control-feedback" aria-hidden="true"></span></div></div></div><div class="form-group has-feedback"><label class="col-md-2 control-label"></label><div class="col-md-10"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span><textarea class="form-control" name="text" placeholder="" rows="10" required></textarea></div></div></div><!-- Button --><div class="form-group has-feedback"><label class="col-md-2 control-label"></label><div class="col-md-10"><button type="submit" class="btn btn-danger btn-block" >Senden <span class="glyphicon glyphicon-send"></span></button></div></div></form><div id="modalAlles" class="modal fade" role="dialog"><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Ladet...</h4></div><div class="modal-body"><p>Ladet...</p></div><div class="modal-footer"><button type="button" class="btn btn-danger"  data-dismiss="modal">Schließen</button></div></div></div></div></div></div>';

		if(isset($GLOBALS['mvcNameToIndex']['title'])){
			$GLOBALS['replacer'][1][$GLOBALS['mvcNameToIndex']['title']]= 'Automobile iysCms | '.$inserat->getName();
		}

		if(isset($GLOBALS['mvcNameToIndex']['beschreibung'])){
			$GLOBALS['replacer'][1][$GLOBALS['mvcNameToIndex']['beschreibung']]= $inserat->getName().' / '.$inserat->getPrice().' / '. $inserat->getCategory().' / '.$inserat->condition;
		}

		return $return;
	}



	private function blaetterfunktion($seite,$maxseite,$url,$anzahl,$get_name){
	   if($get_name!='-'){
		 $anhang = "&";
		 $pfad = "=";
			   }else{
		$anhang = "";
		$pfad = "";		
	   }
   if($anzahl%2 != 0) $anzahl++;

   $a = $seite-($anzahl/2);
   $b = 0;
   $blaetter = array();
   while($b <= $anzahl)
      {
      if($a > 0 AND $a <= $maxseite)
         {
         $blaetter[] = $a;
         $b++;
         }
      else if($a > $maxseite AND ($a-$anzahl-2)>=0)
         {
         $blaetter = array();
         $a -= ($anzahl+2);
         $b = 0;
         }
      else if($a > $maxseite AND ($a-$anzahl-2)<0)
         {
         break;
         }

      $a++;
      }
   $return = '<nav class="seitenNav"><ul class="pagination pagination-lg">';
   if(!in_array(1,$blaetter) AND count($blaetter) > 1)
      {


      if(!in_array(2,$blaetter)){ $return .= '<li><a href="'.$url.$anhang.$get_name.''.$pfad.'1">1</a></li><li><a title="more">...</a></li>';
      }else{$return .= '<li><a href="'.$url.$anhang.$get_name.''.$pfad.'1">1</a></li>';
      }}

   foreach($blaetter AS $blatt)
      {
      if($blatt == $seite){ 
			$return .= '<li class="active"><a href="'.$url.$anhang.$get_name.''.$pfad.''.$blatt.'">'.$blatt.'</a></li>';
		} else {
			$return .= '<li><a href="'.$url.$anhang.$get_name.''.$pfad.''.$blatt.'">'.$blatt.'</a></li>';
		}
	  }

   if(!in_array($maxseite,$blaetter) AND count($blaetter) > 1)
      {
      if(!in_array(($maxseite-1),$blaetter)){
		  $return .= '<li><a title="more">...</a></li><li><a href="'.$url.$anhang.$get_name.''.$pfad.''.$maxseite.'">'.$maxseite.'</a></li>';
		}else{ 
	  $return .= '<li><a href="'.$url.$anhang.$get_name.''.$pfad.''.$maxseite.'">'.$maxseite.'</a></li>';
		}
      }
   $return .= '</ul></nav>';
   if(empty($return)||$maxseite==1)
      return '';
   else
      return $return;
   }   
}
?>