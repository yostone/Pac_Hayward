<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once __DIR__  . '/../../../../core/php/core.inc.php';

class PaC_Hayward extends eqLogic {
	
	
    /*     * *************************Attributs****************************** */

    /*     * ***********************Methode static*************************** */

    
     //Fonction exécutée automatiquement toutes les minutes par Jeedom
//public static function cron() {
//		  foreach (self::byType('PaC_Hayward') as $PaC_Hayward) {//parcours tous les équipements du plugin vdm
//			  if ($PaC_Hayward->getIsEnable() == 1) {//vérifie que l'équipement est actif
//				  $cmd = $PaC_Hayward->getCmd(null, 'Update');//retourne la commande "refresh si elle exxiste
//				  if (!is_object($cmd)) {//Si la commande n'existe pas
//				  	continue; //continue la boucle
//				  }
//				  $cmd->execCmd(); // la commande existe on la lance
//			  }
//		  }
 //     }
     
//Fonction exécutée 5min  par Jeedom
public static function cron5() {
	try {
		log::add('PaC_Hayward', 'debug','Function cron5 : Lancement');
			foreach (self::byType('PaC_Hayward') as $PaC_Hayward) {//parcours tous les équipements du plugin vdm
				if ($PaC_Hayward->getIsEnable() == 1) {//vérifie que l'équipement est actif
					$cmd = $PaC_Hayward->getCmd(null, 'refresh');//retourne la commande "refresh si elle exxiste
					if (!is_object($cmd)) {//Si la commande n'existe pas
						continue; //continue la boucle
					}
					$cmd->execCmd(); // la commande existe on la lance
					log::add('PaC_Hayward', 'debug','Function cron5 : Ok');
				}
			}	  
	} catch (Exception $e) {
		//log::add('PaC_Hayward', 'error', __('Erreur lors de l\'éxecution du cron5 '  . ' ' . $e->getMessage()));
		log::add('PaC_Hayward', 'error', 'Erreur lors de l\'éxecution du cron5  ' . $e->getMessage() );
	}	
}
	
//Fonction exécutée 10min  par Jeedom
public static function cron10() {
	try {
		log::add('PaC_Hayward', 'debug','Function cron10 : Lancement');
			foreach (self::byType('PaC_Hayward') as $PaC_Hayward) {//parcours tous les équipements du plugin vdm
				if ($PaC_Hayward->getIsEnable() == 1) {//vérifie que l'équipement est actif
					$cmd = $PaC_Hayward->getCmd(null, 'refresh');//retourne la commande "refresh si elle exxiste
					if (!is_object($cmd)) {//Si la commande n'existe pas
						continue; //continue la boucle
					}
					$cmd->execCmd(); // la commande existe on la lance
					log::add('PaC_Hayward', 'debug','Function cron10 : Ok');
				}
			}	  
	} catch (Exception $e) {
		//log::add('PaC_Hayward', 'error', __('Erreur lors de l\'éxecution du cron10 '  . ' ' . $e->getMessage()));
		log::add('PaC_Hayward', 'error', 'Erreur lors de l\'éxecution du cron10  ' . $e->getMessage() );
	}	
}
	
//Fonction exécutée 15min  par Jeedom
public static function cron15() {
	try {
		log::add('PaC_Hayward', 'debug','Function cron15 : Lancement');
			foreach (self::byType('PaC_Hayward') as $PaC_Hayward) {//parcours tous les équipements du plugin vdm
				if ($PaC_Hayward->getIsEnable() == 1) {//vérifie que l'équipement est actif
					$cmd = $PaC_Hayward->getCmd(null, 'refresh');//retourne la commande "refresh si elle exxiste
					if (!is_object($cmd)) {//Si la commande n'existe pas
						continue; //continue la boucle
					}
					$cmd->execCmd(); // la commande existe on la lance
					log::add('PaC_Hayward', 'debug','Function cron15 : Ok');
				}
			}	  
	} catch (Exception $e) {
		//log::add('PaC_Hayward', 'error', __('Erreur lors de l\'éxecution du cron15 '  . ' ' . $e->getMessage()));
		log::add('PaC_Hayward', 'error', 'Erreur lors de l\'éxecution du cron15  ' . $e->getMessage() );
	}	
}	

//Fonction exécutée automatiquement toutes les heures par Jeedom
 //public static function cronHourly () {
//		  foreach (self::byType('PaC_Hayward') as $PaC_Hayward) {//parcours tous les équipements du plugin vdm
//			  if ($PaC_Hayward->getIsEnable() == 1) {//vérifie que l'équipement est actif
//				  $cmd = $PaC_Hayward->getCmd(null, 'refresh');//retourne la commande "refresh si elle exxiste
//				  if (!is_object($cmd)) {//Si la commande n'existe pas
//				  	continue; //continue la boucle
//				  }
//				  $cmd->execCmd(); // la commande existe on la lance
//			  }
//		  }
 //     }
	  
    /*
     * Fonction exécutée automatiquement tous les jours par Jeedom
      public static function cronDaily() {

      }
     */



    /*     * *********************Méthodes d'instance************************* */


Public function Update() {	
	
		
			
}
	
	public function Lecture_Ambiante() {
	/*
		log::add('PaC_Hayward', 'debug','Function Lecture_Ambiante : Lancement' );
		//$url = "http://192.168.0.10/pompeHayward.html";
		$MyIpJeedom = $this->getConfiguration("MyIpJeedom"); 
		$url = "http://".$MyIpJeedom."/pompeHayward.html"; 
		$data = file_get_contents($url);
        if ($data == false) {
			log::add('PaC_Hayward', 'debug','Function Lecture_Ambiante : page vierge' );
          	return -100;
        }
        else {      
			$data = str_replace('?', '', $data);
			@$dom = new DOMDocument();
			libxml_use_internal_errors(true);
			$dom->loadHTML($data);    
			libxml_use_internal_errors(false);
			$xpath = new DOMXPath($dom);
			$divs = $xpath->query('//div[@class="pc"]//div[@class="kg1"]//span');
			log::add('PaC_Hayward', 'debug','Function Lecture_Ambiante : Ok' );
			return $divs[0]->nodeValue ;
        }

	*/			
	}
  
	public function Lecture_EntreeEau() {
		try {
			log::add('PaC_Hayward', 'debug','Function Lecture_EntreeEau : Lancement' );	
			$login = $this->getConfiguration("Login"); 
			$password = $this->getConfiguration("Password"); 

			$client = new SoapClient("http://www.phnixsmart.com/Phnix.WaterHeater.WebService/SmartDeviceService.asmx?wsdl");

			$tomorrow = date("Y-m-d", time() + 86400);
			$today = date('Y-m-d');
			$result = $client->GetWHTemperatureHistoryData(array('barcode' => $login,'beginDate' => $today, 'endDate' => $tomorrow));
			if (!empty($result->GetWHTemperatureHistoryDataResult->PackFullDataOf2Array)) {
				$data = $result->GetWHTemperatureHistoryDataResult->PackFullDataOf2Array;
				$json = json_decode($data);
				$waterIn = $json[0]->WaterIn;
				$waterOut = $json[0]->WaterOut;
			} else {
				$waterIn = -99 ;
				log::add('PaC_Hayward', 'debug','Function Lecture_EntreeEau : vierge' );
			}

			log::add('PaC_Hayward', 'debug','Function Lecture_EntreeEau : Ok' );
			return $waterIn ;
	
		} catch (Exception $e) {
			//log::add('PaC_Hayward', 'error', __('Erreur Function Lecture_EntreeEau '  . ' ' . $e->getMessage()));
			log::add('PaC_Hayward', 'error', 'Erreur Function Lecture_EntreeEau ' . $e->getMessage() );
			
		}		
	}

	public function Lecture_SortieEau() {
		try {
			log::add('PaC_Hayward', 'debug','Function Lecture_SortieEau : Lancement' );
			$login = $this->getConfiguration("Login"); 
			$password = $this->getConfiguration("Password"); 

			$client = new SoapClient("http://www.phnixsmart.com/Phnix.WaterHeater.WebService/SmartDeviceService.asmx?wsdl");

			$tomorrow = date("Y-m-d", time() + 86400);
			$today = date('Y-m-d');
			$result = $client->GetWHTemperatureHistoryData(array('barcode' => $login,'beginDate' => $today, 'endDate' => $tomorrow));
			if (!empty($result->GetWHTemperatureHistoryDataResult->PackFullDataOf2Array)) {
				$data = $result->GetWHTemperatureHistoryDataResult->PackFullDataOf2Array;
				$json = json_decode($data);
				$waterIn = $json[0]->WaterIn;
				$waterOut = $json[0]->WaterOut;
			} else {
				$waterOut = -99 ;
				log::add('PaC_Hayward', 'debug','Function Lecture_SortieEau : vierge' );
			}

			log::add('PaC_Hayward', 'debug','Function Lecture_SortieEau : Ok' );
			return $waterOut ;		

		} catch (Exception $e) {
			//log::add('PaC_Hayward', 'error', __('Erreur Function Lecture_SortieEau '  . ' ' . $e->getMessage()));
			log::add('PaC_Hayward', 'error', 'Erreur Function Lecture_SortieEau ' . $e->getMessage() );
		}			
	}
	
	public function Lecture_Consigne() {
		try {
			//log::add('PaC_Hayward', 'debug','Function Lecture_Consigne : Lancement' );
		
		} catch (Exception $e) {
			//log::add('PaC_Hayward', 'error', __('Erreur Function Lecture_Consigne '  . ' ' . $e->getMessage()));
			log::add('PaC_Hayward', 'error', 'Erreur Function Lecture_Consigne ' . $e->getMessage() );
		}	
	}
	
		public function Lecture_Consigne2($value) {
		try {
			log::add('PaC_Hayward', 'debug','Function Lecture_Consigne : Lancement/Ok' );
			return $value;
		
		} catch (Exception $e) {
			//log::add('PaC_Hayward', 'error', __('Erreur Function Lecture_Consigne2 '  . ' ' . $e->getMessage()));
			log::add('PaC_Hayward', 'error', 'Erreur Function Lecture_Consigne2 ' . $e->getMessage() );
		}	
	}
	
	public function LectureSliderConsigne($valueSlider) {
		log::add('PaC_Hayward', 'debug','Function LectureSliderConsigne : Lancement/Ok' );
		return $valueSlider ;
	}

	public function Lecture_Mode() {
		log::add('PaC_Hayward', 'debug','Function Lecture_Mode : Lancement/ok' );
		$Mode = $this->getValue('4_Mode');
		return $Mode ;

		
		/*
		log::add('PaC_Hayward', 'debug','Function Lecture_Mode : Lancement' );
		//$url = "http://192.168.0.10/pompeHayward.html";
		$MyIpJeedom = $this->getConfiguration("MyIpJeedom"); 
		$url = "http://".$MyIpJeedom."/pompeHayward.html";
		$data = file_get_contents($url);
        if ($data == false) {
			log::add('PaC_Hayward', 'debug','Function Lecture_Mode : page vierge' );
          	return -100;
        }
        else {      
			@$dom = new DOMDocument();
			libxml_use_internal_errors(true);
			$dom->loadHTML($data);
			libxml_use_internal_errors(false);
			$xpath = new DOMXPath($dom);
			$divs = $xpath->query('//div[@class="pc"]//div[@class="kg"]//span');
			log::add('PaC_Hayward', 'debug','Function Lecture_Mode : Ok' );
			return $divs[0]->nodeValue ;
        }
		
	*/
		}
	
	public function Lecture_Power() {
		log::add('PaC_Hayward', 'debug','Function Lecture_Power : Lancement/ok' );
		$Power = $this->getValue('2_Power');
		return $Power ;
		
		/*
		log::add('PaC_Hayward', 'debug','Function Lecture_Power : Lancement' );
		//$url = "http://192.168.0.10/pompeHayward.html";
		$MyIpJeedom = $this->getConfiguration("MyIpJeedom"); 
		$url = "http://".$MyIpJeedom."/pompeHayward.html";
		$data = file_get_contents($url);
        if ($data == false) {
			log::add('PaC_Hayward', 'debug','Function Lecture_Power : page vierge' );
          	return -100;
        }
        else {      
			@$dom = new DOMDocument();
			libxml_use_internal_errors(true);
			$dom->loadHTML($data);
			libxml_use_internal_errors(false);
			$xpath = new DOMXPath($dom);
			$divs = $xpath->query('//div[@class="pc"]//span');
			log::add('PaC_Hayward', 'debug','Function Lecture_Power : Ok' );
			return $divs[15]->nodeValue ;
        }

	*/
		}
  
	public function LectureCycle() {
      	$EntreeEau = $this->Lecture_EntreeEau();
        $SortieEau = $this->Lecture_SortieEau();
        $Consigne = $this->Lecture_Consigne();	
        $Mode = $this->Lecture_Mode();
		$Power = $this->Lecture_Power();		
		$EnCycle = "A l'arret";
		
		if ($Power=="On" ){
          	$EnCycle = "En veille";
			if ($Mode=="Chauffage" ){
				if ($SortieEau>=$EntreeEau+1 and $EntreeEau<=$Consigne){
					$EnCycle= "En chauffe";
				}
			} elseif ($Mode=="Refroidissement" ){
				if ($EntreeEau>=$SortieEau+1 and $SortieEau>=$Consigne){
					$EnCycle= "En refroidissement";
				}
			} elseif ($Mode=="Auto" ){
				if ($SortieEau>=$EntreeEau+1 and $EntreeEau<=$Consigne){
					$EnCycle= "En chauffe";
                } elseif ($EntreeEau>=$SortieEau+1 and $SortieEau>=$Consigne){
                  	$EnCycle= "En refroidissement";
				}
			}
		}
		
		log::add('PaC_Hayward', 'debug','Function LectureCycle : Lancement/Ok' );
		return $EnCycle ;
	}
  
public function ExecuteCmdPompe($VarPilotagePompe) {
	try {
		log::add('PaC_Hayward', 'debug','Function ExecuteCmdPompe : Lancement' );
		
		$login = $this->getConfiguration("Login"); 
		$password = $this->getConfiguration("Password"); 
		$setpoint = $this->Lecture_Consigne();	
		//$power = 'ON';

		//Mise en marche de la pompe
		if ($VarPilotagePompe == 'Marche') {		
				switch ($setpoint) {
					case 25:
						$setpoint = 'qlqxgwEAL6gACEABAQZ8bnR8THxafEw9PQAAAAAAAAAA5BU=';
						break;
					case 26:
						$setpoint = 'qlqxgwEAL6gACEABAQZ8cHR8THxafEw9PQACAAAAAAAAofs=';
						break;
					case 27:
						$setpoint = 'qlqxgwEAL6gACEABAQZ8cnR8THxafEw9PQAAAAAAAAAAI4M=';
						break;
					case 28:
						$setpoint = 'qlqxgwEAL6gACEABAQZ8dHR8THxafEw9PQACAAAAAAAA4Mo';
						break;
					Case 29:
						$setpoint = 'qlqxgwEAL6gACEABAQZ8dnR8THxafEw9PQACAAAAAAAAQXI=';
						break;
					case 30:
						$setpoint = 'qlqxgwEAL6gACEABAQZ8eHR8THxafEw9PQAAAAAAAAAAAFk=';
						break;
					case 31:
						$setpoint = 'qlqxgwEAL6gACEABAQZ8enR8THxafEw9PQACAAAAAAAAgiE=';
						break;
					case 32:
						$setpoint = 'qlqxgwEAL6gACEABAQZ8fHR8THxafEw9PQACAAAAAAAAYqg=';
						break;
					}

			} elseif ($VarPilotagePompe == 'Arret') {		
				switch ($setpoint) {
					case 25:
						$setpoint = 'qlqxgwEAL6gACEAAAQZybnR8THxafEw9PQACAAAAAAAAffA=';
						break;
					case 26:
						$setpoint = 'qlqxgwEAL6gACEAAAQZycHR8THxafEw9PQAAAAAAAAAAOB4=';
						break;
					case 27:
						$setpoint = 'qlqxgwEAL6gACEAAAQZycnR8THxafEw9PQACAAAAAAAAumY=';
						break;
					case 28:
						$setpoint = 'qlqxgwEAL6gACEAAAQZydHR8THxafEw9PQACAAAAAAAAWu8';
						break;
					case 29:
						$setpoint = 'qlqxgwEAL6gACEAAAQZ8dnR8THxafEw9PQACAAAAAAAAkb4=';
						break;
					case 30:
						$setpoint = 'qlqxgwEAL6gACEAAAQZ8eHR8THxafEw9PQAAAAAAAAAA0JU=';
						break;
					case 31:
						$setpoint = 'qlqxgwEAL6gACEAAAQZ8e3R8THxafEw9PQACAAAAAAAAAxE=';
						break;
					case 32:
						$setpoint = 'qlqxgwEAL6gACEAAAQZ8fHR8THxafEw9PQAAAAAAAAAAkaQ=';
						break;
				}
	
			} elseif ($VarPilotagePompe == 'Refroidissement') {
				//Affectation mode pompe

			} elseif ($VarPilotagePompe == 'Chauffage') {
				//Affectation mode pompe

			} elseif ($VarPilotagePompe == 'Auto') {
				//Affectation mode pompe

			} elseif ($VarPilotagePompe == 'AutorisationOn') {
				//Autorisation

			} elseif ($VarPilotagePompe == 'AutorisationOff') {
				//Autorisation
	
			} elseif ($VarPilotagePompe == 'TimerTime') {
				//Timer pompe
				
			} 
			

		$setpoint = base64_decode($setpoint);
		$client = new SoapClient("http://www.phnixsmart.com/Phnix.WaterHeater.WebService/SmartDeviceService.asmx?wsdl");
		$result = $client->SavePackageData(array('company' => 'PHNIX','barcode' => $login, 'pw' => $password, 'requestPackData' => $setpoint));

		if (!empty($result->SavePackageDataResult->ResponseCode)) {
			$data = $result->SavePackageDataResult->ResponseCode;
			log::add('PaC_Hayward', 'debug','Function ExecuteCmdSetConsigne : Ok' );
		} else {
			log::add('PaC_Hayward', 'error','Function ExecuteCmdSetConsigne : Serveur hayward down' );
		}
		
	} catch (Exception $e) {
		//log::add('PaC_Hayward', 'error', __('Erreur lors de l\'éxecution de ExecuteCmdPompe '  . ' ' . $e->getMessage()));
		log::add('PaC_Hayward', 'error', 'Erreur lors de l\'éxecution de ExecuteCmdPompe ' . $e->getMessage() );
	}	
}

public function ExecuteCmdSetConsigne($VarConsigne) {
	
	log::add('PaC_Hayward', 'debug','Function ExecuteCmdSetConsigne : Lancement' );
	$login = $this->getConfiguration("Login"); 
	$password = $this->getConfiguration("Password"); 
	$setpoint = $VarConsigne; 
	$power = 'ON';

if ($power == 'ON') {
  	switch ($setpoint) {
    	case 25:
        	$setpoint = 'qlqxgwEAL6gACEABAQZ8bnR8THxafEw9PQAAAAAAAAAA5BU=';
        	break;
    	case 26:
        	$setpoint = 'qlqxgwEAL6gACEABAQZ8cHR8THxafEw9PQACAAAAAAAAofs=';
        	break;
    	case 27:
        	$setpoint = 'qlqxgwEAL6gACEABAQZ8cnR8THxafEw9PQAAAAAAAAAAI4M=';
        	break;
      	case 28:
        	$setpoint = 'qlqxgwEAL6gACEABAQZ8dHR8THxafEw9PQACAAAAAAAA4Mo';
        	break;
        case 29:
        	$setpoint = 'qlqxgwEAL6gACEABAQZ8dnR8THxafEw9PQACAAAAAAAAQXI=';
        	break;
        case 30:
        	$setpoint = 'qlqxgwEAL6gACEABAQZ8eHR8THxafEw9PQAAAAAAAAAAAFk=';
        	break;
        case 31:
        	$setpoint = 'qlqxgwEAL6gACEABAQZ8enR8THxafEw9PQACAAAAAAAAgiE=';
        	break;
        case 32:
        	$setpoint = 'qlqxgwEAL6gACEABAQZ8fHR8THxafEw9PQACAAAAAAAAYqg=';
        	break;
	}
} else {
  	switch ($setpoint) {
    	case 25:
        	$setpoint = 'qlqxgwEAL6gACEAAAQZybnR8THxafEw9PQACAAAAAAAAffA=';
        	break;
    	case 26:
        	$setpoint = 'qlqxgwEAL6gACEAAAQZycHR8THxafEw9PQAAAAAAAAAAOB4=';
        	break;
    	case 27:
        	$setpoint = 'qlqxgwEAL6gACEAAAQZycnR8THxafEw9PQACAAAAAAAAumY=';
        	break;
      	case 28:
        	$setpoint = 'qlqxgwEAL6gACEAAAQZydHR8THxafEw9PQACAAAAAAAAWu8';
        	break;
        case 29:
        	$setpoint = 'qlqxgwEAL6gACEAAAQZ8dnR8THxafEw9PQACAAAAAAAAkb4=';
        	break;
        case 30:
        	$setpoint = 'qlqxgwEAL6gACEAAAQZ8eHR8THxafEw9PQAAAAAAAAAA0JU=';
        	break;
        case 31:
        	$setpoint = 'qlqxgwEAL6gACEAAAQZ8e3R8THxafEw9PQACAAAAAAAAAxE=';
        	break;
        case 32:
        	$setpoint = 'qlqxgwEAL6gACEAAAQZ8fHR8THxafEw9PQAAAAAAAAAAkaQ=';
        	break;
	}
}

	$setpoint = base64_decode($setpoint);
	$client = new SoapClient("http://www.phnixsmart.com/Phnix.WaterHeater.WebService/SmartDeviceService.asmx?wsdl");
	$result = $client->SavePackageData(array('company' => 'PHNIX','barcode' => $login, 'pw' => $password, 'requestPackData' => $setpoint));

	if (!empty($result->SavePackageDataResult->ResponseCode)) {
		$data = $result->SavePackageDataResult->ResponseCode;
		log::add('PaC_Hayward', 'debug','Function ExecuteCmdSetConsigne : Ok' );
	} else {
		log::add('PaC_Hayward', 'error','Function ExecuteCmdSetConsigne : Serveur hayward down' );
	}


}

	// Méthode appellée avant la création de votre objet
    public function preInsert() {
        
    }

	//Méthode appellée après la création de votre objet
    public function postInsert() {
        foreach (self::byType('PaC_Hayward') as $PaC_Hayward) {//parcours tous les équipements du plugin vdm
			  if ($PaC_Hayward->getIsEnable() == 1) {//vérifie que l'équipement est actif
				  $cmd = $PaC_Hayward->getCmd(null, '7timer');//retourne la commande "refresh si elle exxiste
				  if (!is_object($cmd)) {//Si la commande n'existe pas
				  	continue; //continue la boucle
				  }
				  $cmd->execCmd(); // la commande existe on la lance
			  }
		  }
    }

	//Méthode appellée avant la sauvegarde (creation et mise à jour donc) de votre objet
    public function preSave() {
        
    }

	//Méthode appellée après la sauvegarde de votre objet
    public function postSave() {
		//retour consigne
		$info = $this->getCmd(null, '1_consigne');
		if (!is_object($info)) {
			$info = new PaC_HaywardCmd();
			$info->setName(__('Consigne', __FILE__));
		}
		$info->setLogicalId('1_consigne');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('°C');
		$info->setOrder(1);
		$info->save();	

		//info entrée eau
		$info = $this->getCmd(null, '1_EntreeEau');
		if (!is_object($info)) {
			$info = new PaC_HaywardCmd();
			$info->setName(__('Entrée d eau', __FILE__));
		}
		$info->setLogicalId('1_EntreeEau');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('°C');
		$info->setOrder(2);
		$info->save();	

		//info sortie eau
		$info = $this->getCmd(null, '1_SortieEau');
		if (!is_object($info)) {
			$info = new PaC_HaywardCmd();
			$info->setName(__('Sortie d eau', __FILE__));
		}
		$info->setLogicalId('1_SortieEau');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('°C');
		$info->setOrder(3);
		$info->save();		

		//info du mode en cours
		$info = $this->getCmd(null, '4_Mode');
		if (!is_object($info)) {
			$info = new PaC_HaywardCmd();
			$info->setName(__('Mode en cours : ', __FILE__));
		}
		$info->setLogicalId('4_Mode');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setOrder(7);
		$info->save();	

		//info si en marche ou pas 
		$info = $this->getCmd(null, '2_Power');
		if (!is_object($info)) {
			$info = new PaC_HaywardCmd();
			$info->setName(__('Power  : ', __FILE__));
		}
		$info->setLogicalId('2_Power');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setOrder(4);
		$info->save();	
      
                //info si la pompe tourne
		$info = $this->getCmd(null, '8_EnCycle');
		if (!is_object($info)) {
			$info = new PaC_HaywardCmd();
			$info->setName(__('Etat : ', __FILE__));
		}
		$info->setLogicalId('8_EnCycle');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setOrder(40);
		$info->save();	
		
		//rafraichissement des infos
		$refresh = $this->getCmd(null, 'refresh');
		if (!is_object($refresh)) {
			$refresh = new PaC_HaywardCmd();
			$refresh->setName(__('Rafraichir', __FILE__));
			$refresh->setConfiguration('PacHayward_cmd', true);
		}
		$refresh->setEqLogic_id($this->getId());
		$refresh->setLogicalId('refresh');
		$refresh->setType('action');
		$refresh->setSubType('other');
		$refresh->save();   

		//changement de consigne
		$action = $this->getCmd(null, '6_Set_consigne');
		if (!is_object($action)) {
			$action = new PaC_HaywardCmd();
			$action->setName(__('Modifier consigne', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('6_Set_consigne');
		$action->setType('action');
		$action->setSubType('other');
		$action->setOrder(11);
		$action->save();  

		//retour slider
		$info = $this->getCmd(null, '6_RetourSliderconsigne');
		if (!is_object($info)) {
			$info = new PaC_HaywardCmd();
			$info->setName(__('Consigne demandée : ', __FILE__));
		}
		$info->setLogicalId('6_RetourSliderconsigne');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setConfiguration('consigne','valeur');
		//$info->setIsHistorized(1);
		$info->setUnite('°C');
		$info->setOrder(12);
		$info->save();	
		
		//Slider consigne
		$action = $this->getCmd(null, '6_SliderConsigne');
		if (!is_object($action)) {
			$action = new PaC_HaywardCmd();
			$action->setLogicalId('6_SliderConsigne');
			$action->setName(__('Changer consigne', __FILE__));
		}
		$action->setType('action');
		$action->setSubType('slider');
	    	$action->setConfiguration('stepValue', 0.5);
		$action->setConfiguration('minValue', 8);
		$action->setConfiguration('maxValue', 32);
		$action->setEqLogic_id($this->getId());
	    	$action->setUnite('°C');
		$action->setOrder(13);
		$action->save();		
		
		//Mise en route
		$action = $this->getCmd(null, '3_Marche');
		if (!is_object($action)) {
			$action = new PaC_HaywardCmd();
			$action->setName(__('Marche', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('3_Marche');
		$action->setType('action');
		$action->setSubType('other');
		$action->setOrder(5);
		$action->save();  

		//Mise en stop
		$action = $this->getCmd(null, '3_Arret');
		if (!is_object($action)) {
			$action = new PaC_HaywardCmd();
			$action->setName(__('Arret', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('3_Arret');
		$action->setType('action');
		$action->setSubType('other');
		$action->setOrder(6);
		$action->save();  

		//Mode auto
		$action = $this->getCmd(null, '5_ModeAuto');
		if (!is_object($action)) {
			$action = new PaC_HaywardCmd();
			$action->setName(__('Auto', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('5_ModeAuto');
		$action->setType('action');
		$action->setSubType('other');
		$action->setOrder(8);
		$action->save();  
		
		//Mode refroidissement
		$action = $this->getCmd(null, '5_ModeRefroidissement');
		if (!is_object($action)) {
			$action = new PaC_HaywardCmd();
			$action->setName(__('Refroidissement', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('5_ModeRefroidissement');
		$action->setType('action');
		$action->setSubType('other');
		$action->setOrder(9);
		$action->save();  
		
		//Mode Chauffage
		$action = $this->getCmd(null, '5_ModeChauffage');
		if (!is_object($action)) {
			$action = new PaC_HaywardCmd();
			$action->setName(__('Chauffage', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('5_ModeChauffage');
		$action->setType('action');
		$action->setSubType('other');
		$action->setOrder(10);
		$action->save();  
		
		//Debug
		$action = $this->getCmd(null, '7_Debug');
		if (!is_object($action)) {
			$action = new PaC_HaywardCmd();
			$action->setName(__('7_Debug', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('7_Debug');
		$action->setType('action');
		$action->setSubType('other');
		$action->setIsVisible(0);
		$action->setOrder(20);
		$action->save();  
		
		//7timer
		$action = $this->getCmd(null, '7timer');
		if (!is_object($action)) {
			$action = new PaC_HaywardCmd();
			$action->setName(__('7timer', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('7timer');
		$action->setType('action');
		$action->setSubType('other');
		$action->setIsVisible(0);
		$action->setOrder(30);
		$action->save();  
		
		foreach (self::byType('PaC_Hayward') as $PaC_Hayward) {//parcours tous les équipements du plugin vdm
			  if ($PaC_Hayward->getIsEnable() == 1) {//vérifie que l'équipement est actif
				  $cmd = $PaC_Hayward->getCmd(null, '7timer');//retourne la commande "refresh si elle exxiste
				  if (!is_object($cmd)) {//Si la commande n'existe pas
				  	continue; //continue la boucle
				  }
				  $cmd->execCmd(); // la commande existe on la lance
			  }
		  }
	
		
    }

    public function preUpdate() {
        
    }

    public function postUpdate() {
        
    }

    public function preRemove() {
        
    }

    public function postRemove() {
        
    }

    /*
     * Non obligatoire mais permet de modifier l'affichage du widget si vous en avez besoin
      public function toHtml($_version = 'dashboard') {

      }
     */

    /*
     * Non obligatoire mais ca permet de déclencher une action après modification de variable de configuration
    public static function postConfig_<Variable>() {
    }
     */

    /*
     * Non obligatoire mais ca permet de déclencher une action avant modification de variable de configuration
    public static function preConfig_<Variable>() {
    }
     */

    /*     * **********************Getteur Setteur*************************** */
}


class PaC_HaywardCmd extends cmd {
    /*     * *************************Attributs****************************** */


    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    /*
     * Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
      public function dontRemoveCmd() {
      return true;
      }
     */
	 
    public function execute($_options = array()) {
		$eqlogic = $this->getEqLogic(); //récupère l'éqlogic de la commande $this
		switch ($this->getLogicalId()) {	//vérifie le logicalid de la commande 	
			case '3_Marche':
				$cmd = $eqlogic->ExecuteCmdPompe('Marche');
				$info = $eqlogic->Update();
            
		//		$info = $eqlogic->Lecture_Consigne(); 
        //    	if ($info != -100) {
		//			$eqlogic->checkAndUpdateCmd('1_consigne', $info); 
        //        }
            
				$info = $eqlogic->Lecture_EntreeEau(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
                }
                  
				$info = $eqlogic->Lecture_SortieEau(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
                }
            
				$info = $eqlogic->Lecture_Mode(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
                }
            
				//$info = $eqlogic->Lecture_Power(); 	
                //if ($info != -100) {
					//$eqlogic->checkAndUpdateCmd('2_Power', $info);
					$eqlogic->checkAndUpdateCmd('2_Power', 'Marche');
                //}
            
            	$info = $eqlogic->LectureCycle(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
                }
                  
				break;
			case '3_Arret':
				$cmd = $eqlogic->ExecuteCmdPompe('Arret');
				$info = $eqlogic->Update();
                  
		//		$info = $eqlogic->Lecture_Consigne(); 	
         //       if ($info != -100) {  
		//			$eqlogic->checkAndUpdateCmd('1_consigne', $info); 
         //       }
                  
				$info = $eqlogic->Lecture_EntreeEau(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
                }
                  
				$info = $eqlogic->Lecture_SortieEau(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
                }
                  
				$info = $eqlogic->Lecture_Mode(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
                }
                  
				//$info = $eqlogic->Lecture_Power(); 	
                //if ($info != -100) {
				//	$eqlogic->checkAndUpdateCmd('2_Power', $info);
					$eqlogic->checkAndUpdateCmd('2_Power', 'Arret');
                //}
                  
            	$info = $eqlogic->LectureCycle(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
                }
                  
				break;
			case '5_ModeRefroidissement':
				$cmd = $eqlogic->ExecuteCmdPompe('Refroidissement');
				$info = $eqlogic->Update();
                  
		//		$info = $eqlogic->Lecture_Consigne(); 	
         //       if ($info != -100) {
		//			$eqlogic->checkAndUpdateCmd('1_consigne', $info); 
         //       }
                  
				$info = $eqlogic->Lecture_EntreeEau(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
                }
                  
				$info = $eqlogic->Lecture_SortieEau(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
                }
                  
				//$info = $eqlogic->Lecture_Mode(); 	
                //if ($info != -100) {
				//	$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
					$eqlogic->checkAndUpdateCmd('4_Mode','Refroidissement'); 
                //}
                  
				$info = $eqlogic->Lecture_Power(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('2_Power', $info);
                }
                  
            	$info = $eqlogic->LectureCycle(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
                }
                  
				break;
			case '5_ModeChauffage':
				$cmd = $eqlogic->ExecuteCmdPompe('Chauffage');
				$info = $eqlogic->Update();
                  
		//		$info = $eqlogic->Lecture_Consigne(); 	
         //       if ($info != -100) {
		//			$eqlogic->checkAndUpdateCmd('1_consigne', $info); 
         //       }  
                  
				$info = $eqlogic->Lecture_EntreeEau(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
                }
                  
				$info = $eqlogic->Lecture_SortieEau(); 
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
                }
                  
				//$info = $eqlogic->Lecture_Mode(); 	
                //if ($info != -100) {
				//	$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
					$eqlogic->checkAndUpdateCmd('4_Mode', 'Chauffage'); 
                //}
                  
				$info = $eqlogic->Lecture_Power(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('2_Power', $info);
                }
                  
            	$info = $eqlogic->LectureCycle(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
                }
                  
				break;
			case '5_ModeAuto':
				$cmd = $eqlogic->ExecuteCmdPompe('Auto');
				$info = $eqlogic->Update();
                  
		//		$info = $eqlogic->Lecture_Consigne(); 	
         //       if ($info != -100) {
		//			$eqlogic->checkAndUpdateCmd('1_consigne', $info); 
         //       }
                  
				$info = $eqlogic->Lecture_EntreeEau(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
                }
                  
				$info = $eqlogic->Lecture_SortieEau(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
                }
                  
				//$info = $eqlogic->Lecture_Mode(); 	
                //if ($info != -100) {
				//	$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
					$eqlogic->checkAndUpdateCmd('4_Mode', 'Auto'); 
                //}  
                  
				$info = $eqlogic->Lecture_Power(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('2_Power', $info);
                }
                  
            	$info = $eqlogic->LectureCycle(); 
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
                }
                  
				break;
			case '6_SliderConsigne':
				$info = $eqlogic->LectureSliderConsigne($_options['slider']/1);
				$eqlogic->checkAndUpdateCmd('6_RetourSliderconsigne', $info); 
				break;
			case '6_Set_consigne':
				$consigne = $eqlogic->getCmd(null, '6_RetourSliderconsigne');
                $value = $consigne->execCmd();
				$cmd = $eqlogic->ExecuteCmdSetConsigne($value);
				
				$info = $eqlogic->Update();
				
//				$info = $eqlogic->Lecture_Consigne(); 	//On lance la fonction randomVdm() pour récupérer une vdm et on la stocke dans la variable $info
//            	if ($info != -100) {
//					$eqlogic->checkAndUpdateCmd('1_consigne', $info); // on met à jour la commande avec le LogicalId "story"  de l'eqlogic 
//				}
				
				$info = $eqlogic->Lecture_Consigne2($value); 	//On lance la fonction randomVdm() pour récupérer une vdm et on la stocke dans la variable $info
            	if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_consigne', $info); // on met à jour la commande avec le LogicalId "story"  de l'eqlogic 
				}
                  
				$info = $eqlogic->Lecture_EntreeEau(); 	
            	if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
				}
                  
				$info = $eqlogic->Lecture_SortieEau(); 	
            	if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
				}
                  
				$info = $eqlogic->Lecture_Mode(); 	
            	if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
				}
                  
				$info = $eqlogic->Lecture_Power(); 	
            	if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('2_Power', $info); 
                }
            
            	$info = $eqlogic->LectureCycle(); 	
            	if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
                }
                  
				break;
			case '7_Debug':
				//break;
				
			case '7timer':
				$info = $eqlogic->ExecuteCmdPompe('TimerTime');
				break;
            
            case '8_EnCycle':
            	$info = $eqlogic->LectureCycle(); 	
				$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
				break;
            
			case 'refresh': // LogicalId de la commande rafraîchir que l’on a créé dans la méthode Postsave de la classe vdm . 
				$info = $eqlogic->Update();
				
			//	$info = $eqlogic->Lecture_Consigne(); 	//On lance la fonction randomVdm() pour récupérer une vdm et on la stocke dans la variable $info
			//	if ($info != -100) {            
			//		$eqlogic->checkAndUpdateCmd('1_consigne', $info); // on met à jour la commande avec le LogicalId "story"  de l'eqlogic 
			//	}
            
				$info = $eqlogic->Lecture_EntreeEau(); 	
            	if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
                }
				
				$info = $eqlogic->Lecture_SortieEau(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
				}
                  
				$info = $eqlogic->Lecture_Mode(); 	
                if ($info != -100) {  
					$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
				}
                  
				$info = $eqlogic->Lecture_Power(); 	
                if ($info != -100) {  
					$eqlogic->checkAndUpdateCmd('2_Power', $info); 
                }
                  
            	$info = $eqlogic->LectureCycle(); 	
                if ($info != -100) {
					$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
				}
				
				break;
		}
    }

    /*     * **********************Getteur Setteur*************************** */
}
