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
		//$handle = @fopen("http://smartemp.hayward.fr:9000/", "r");
		//if ($handle) {
		//	log::add('PaC_Hayward', 'debug','Function cron5 : Serveur hayward ok' );
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
		//} else {
		//	log::add('PaC_Hayward', 'error','Function cron5 : Serveur hayward down' );
		//}
		  
	} catch (Exception $e) {
		log::add('PaC_Hayward', 'error', __('Erreur lors de l\'éxecution du cron5 '  . ' ' . $e->getMessage()));
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
	try {
		log::add('PaC_Hayward', 'debug','Function Update : Lancement');
		
		$TimeOutServeur=0 ;
		gotoCom:
		
		$handle = @fopen("http://smartemp.hayward.fr:9000/", "r");
		if ($handle) {
			log::add('PaC_Hayward', 'debug','Function Update : Serveur hayward ok, téléchargement de la page web');
			// ************* DEBUT DES VARIABLES
			$username = $this->getConfiguration("Login"); 
			$password = $this->getConfiguration("Password"); 
			$MyIpJeedom = $this->getConfiguration("MyIpJeedom"); 
			$login_url = 'http://smartemp.hayward.fr:9000/login'; //url de la page d'accueil (identification)
			//$cookie = 'PLAY_LANG=en'; //contenu du cookie
			$source= 'http://smartemp.hayward.fr:9000/'; //page à récupérer
			$pompe_html = '/var/www/html/pompeHayward.html'; //page créée
			$x = "64";
			$y = "20";
			// ************* FIN DES VARIABLES

			//initialisation curl
			$ch = curl_init();
		
			//en-têtes http
			$header[0] = "Host: http://smartemp.hayward.fr:9000";
			$header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
			$header[] = "Accept-Language: fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7"; 
			$header[] = "Accept-Charset: utf-8";
			$header[] = "Connection: keep-alive";
			$header[] = "Keep-Alive: 300";
			$header[] = "Pragma: no-cache";
			$header[] = "Cache-control: max-age=0";
			$header[] = "Origin: http://smartemp.hayward.fr:9000";
			$header[] = "Upgrade-Insecure-Requests: 1";
			$header[] = "Content-Type: application/x-www-form-urlencoded";
			$header[] = "Accept-Encoding: gzip, deflate";
			$header[] = "Referer: http://smartemp.hayward.fr:9000/login";
			$header[] = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36";
		
			//défini l'url de connexion/identification
			curl_setopt($ch, CURLOPT_URL, $login_url);
			//active HTTP POST
			curl_setopt($ch, CURLOPT_POST, 1);
			//affecte les variables à envoyer et le clic sur le bouton de connexion
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'barCode='.$username.'&pwd='.$password.'&ImageButton1.x='.$x.'&ImageButton1.y='.$y);
			
			//défini les en-têtes http
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			
			// Définition de la méthode d'authentification du serveur
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
			
			//gestion du cookie
			//curl_setopt( $curl, CURLOPT_COOKIE, $cookie);
			curl_setopt($ch, CURLOPT_COOKIEJAR, "/var/www/html/tmp/cookie"); //Le fichier dans lequel les cookies seront enregistrés
			
			//Setting CURLOPT_RETURNTRANSFER variable to 1 will force cURL
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			//exécute la requête - login
			$store = curl_exec($ch);
			
			curl_setopt($ch, CURLOPT_POST, 0);
			curl_setopt($ch, CURLOPT_COOKIEFILE, "/var/www/html/tmp/cookie"); //Le fichier cookie à utiliser
			curl_setopt($ch, CURLOPT_URL, $source);//la page à récupérer
			//execute la requête
			$content = curl_exec($ch);
			
			curl_close($ch); // on ferme la session curl
			
			log::add('PaC_Hayward', 'debug','Function Update : Téléchargement de la page web terminé');
			
			//Traduction
			date_default_timezone_set('Europe/Paris');
			$content = str_replace("Ambient", "Ambient - ".date('d m Y H:i'), $content);
			$content = str_replace("Heating", "Chauffage", $content);
			$content = str_replace("Cooling", "Froid", $content);
			$content = str_replace('<input id="isPowerSwitch" type="checkbox" name="isPowerSwitch"  />', '<span class="Power">On</span>', $content);
			$content = str_replace('<input id="isPowerSwitch" type="checkbox" name="isPowerSwitch" checked="checked" />', '<span class="Power">Off</span>', $content);
			//$content = str_replace('â„ƒ', '', $content);
			
			//enregistre le contenu de la page dans un fichier html
			//file_put_contents($pompe_html, $content);
			file_put_contents($pompe_html, utf8_decode($content));
	
			//change les droits sur le fichier - écriture
			chmod($pompe_html,0777);
			
			log::add('PaC_Hayward', 'debug','Function Update : Ok');
			
		} else {
			
			if ($TimeOutServeur < 3) {
				log::add('PaC_Hayward', 'debug','Function Update : tentative de connection au serveur');
				$TimeOutServeur++ ;
				goto gotoCom;
			}
			log::add('PaC_Hayward', 'error','Function Update : Serveur hayward down');
		}
		
	} catch (Exception $e) {
		log::add('PaC_Hayward', 'error', __('Erreur lors de l\'éxecution de Update '  . ' ' . $e->getMessage()));
	}		
}
	
	public function Lecture_Ambiante() {
		log::add('PaC_Hayward', 'debug','Function Lecture_Ambiante : Lancement' );
		//$url = "http://192.168.0.10/pompeHayward.html";
		$MyIpJeedom = $this->getConfiguration("MyIpJeedom"); 
		$url = "http://".$MyIpJeedom."/pompeHayward.html";
		$data = file_get_contents($url);
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

	public function Lecture_EntreeEau() {
		log::add('PaC_Hayward', 'debug','Function Lecture_EntreeEau : Lancement' );
		//$url = "http://192.168.0.10/pompeHayward.html";
		$MyIpJeedom = $this->getConfiguration("MyIpJeedom"); 
		$url = "http://".$MyIpJeedom."/pompeHayward.html";
		$data = file_get_contents($url);
		$data = str_replace('?', '', $data);
		@$dom = new DOMDocument();
		libxml_use_internal_errors(true);
		$dom->loadHTML($data);
		libxml_use_internal_errors(false);
		$xpath = new DOMXPath($dom);
		$divs = $xpath->query('//div[@class="pc"]//div[@class="kg1"]//span');
		log::add('PaC_Hayward', 'debug','Function Lecture_EntreeEau : Ok' );
		return $divs[1]->nodeValue ;
	}

	public function Lecture_SortieEau() {
		log::add('PaC_Hayward', 'debug','Function Lecture_SortieEau : Lancement' );
		//$url = "http://192.168.0.10/pompeHayward.html";
		$MyIpJeedom = $this->getConfiguration("MyIpJeedom"); 
		$url = "http://".$MyIpJeedom."/pompeHayward.html";
		$data = file_get_contents($url);
		$data = str_replace('?', '', $data);
		@$dom = new DOMDocument();
		libxml_use_internal_errors(true);
		$dom->loadHTML($data);
		libxml_use_internal_errors(false);
		$xpath = new DOMXPath($dom);
		$divs = $xpath->query('//div[@class="pc"]//div[@class="kg1"]//span');
		log::add('PaC_Hayward', 'debug','Function Lecture_SortieEau : Ok' );
		return $divs[2]->nodeValue ;
	}
	
	public function Lecture_Consigne() {
		log::add('PaC_Hayward', 'debug','Function Lecture_Consigne : Lancement' );
		//$url = "http://192.168.0.10/pompeHayward.html";
		$MyIpJeedom = $this->getConfiguration("MyIpJeedom"); 
		$url = "http://".$MyIpJeedom."/pompeHayward.html";
		$data = file_get_contents($url);
		$data = str_replace('?', '', $data);
		@$dom = new DOMDocument();
		libxml_use_internal_errors(true);
		$dom->loadHTML($data);
		libxml_use_internal_errors(false);
		$xpath = new DOMXPath($dom);
		$divs = $xpath->query('//div[@class="pc"]//div[@class="kg"]//span');
		log::add('PaC_Hayward', 'debug','Function Lecture_Consigne : Ok' );
		return $divs[1]->nodeValue ;
	}
	
	public function LectureSliderConsigne($valueSlider) {
		log::add('PaC_Hayward', 'debug','Function LectureSliderConsigne : Lancement/Ok' );
		return $valueSlider ;
	}

	public function Lecture_Mode() {
		log::add('PaC_Hayward', 'debug','Function Lecture_Mode : Lancement' );
		//$url = "http://192.168.0.10/pompeHayward.html";
		$MyIpJeedom = $this->getConfiguration("MyIpJeedom"); 
		$url = "http://".$MyIpJeedom."/pompeHayward.html";
		$data = file_get_contents($url);
		@$dom = new DOMDocument();
		libxml_use_internal_errors(true);
		$dom->loadHTML($data);
		libxml_use_internal_errors(false);
		$xpath = new DOMXPath($dom);
		$divs = $xpath->query('//div[@class="pc"]//div[@class="kg"]//span');
		log::add('PaC_Hayward', 'debug','Function Lecture_Mode : Ok' );
		return $divs[0]->nodeValue ;
	}
	
	public function Lecture_Power() {
		log::add('PaC_Hayward', 'debug','Function Lecture_Power : Lancement' );
		//$url = "http://192.168.0.10/pompeHayward.html";
		$MyIpJeedom = $this->getConfiguration("MyIpJeedom"); 
		$url = "http://".$MyIpJeedom."/pompeHayward.html";
		$data = file_get_contents($url);
		@$dom = new DOMDocument();
		libxml_use_internal_errors(true);
		$dom->loadHTML($data);
		libxml_use_internal_errors(false);
		$xpath = new DOMXPath($dom);
		$divs = $xpath->query('//div[@class="pc"]//span');
		log::add('PaC_Hayward', 'debug','Function Lecture_Power : Ok' );
		return $divs[15]->nodeValue ;
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
		$handle = @fopen("http://smartemp.hayward.fr:9000/", "r");
		if ($handle) {
			log::add('PaC_Hayward', 'debug','Function ExecuteCmdPompe : Serveur hayward ok' );
			// ************* DEBUT DES VARIABLES
			$username = $this->getConfiguration("Login"); 
			$password = $this->getConfiguration("Password"); 
			$MyIpJeedom = $this->getConfiguration("MyIpJeedom");
			$login_url = 'http://smartemp.hayward.fr:9000/login'; //url de la page d'accueil (identification)
			//$cookie = 'PLAY_LANG=en'; //contenu du cookie
			$source= 'http://smartemp.hayward.fr:9000'; //page à récupérer
			// ************* FIN DES VARIABLES
			
			//initialisation curl
			$ch = curl_init();
			
			//en-têtes http
			$header[0] = "Host: http://smartemp.hayward.fr:9000";
			$header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
			$header[] = "Accept-Language: fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7"; 
			$header[] = "Accept-Charset: utf-8";
			$header[] = "Connection: keep-alive";
			$header[] = "Keep-Alive: 300";
			$header[] = "Pragma: no-cache";
			$header[] = "Cache-control: max-age=0";
			$header[] = "Origin: http://smartemp.hayward.fr:9000";
			$header[] = "Upgrade-Insecure-Requests: 1";
			$header[] = "Content-Type: application/x-www-form-urlencoded";
			$header[] = "Accept-Encoding: gzip, deflate";
			$header[] = "Referer: http://smartemp.hayward.fr:9000/login";
			$header[] = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36";
			
			//défini l'url de connexion/identification
			curl_setopt($ch, CURLOPT_URL, $login_url);
			//active HTTP POST
			curl_setopt($ch, CURLOPT_POST, 1);
			//affecte les variables à envoyer et le clic sur le bouton de connexion
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'barCode='.$username.'&pwd='.$password.'&ImageButton1.x='.$x.'&ImageButton1.y='.$y);
			
			//défini les en-têtes http
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			
			// Définition de la méthode d'authentification du serveur
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
			
			//gestion du cookie
			curl_setopt($ch, CURLOPT_COOKIEJAR, "/var/www/html/tmp/cookie"); //Le fichier dans lequel les cookies seront enregistrés
			
			//Setting CURLOPT_RETURNTRANSFER variable to 1 will force cURL
			//not to print out the results of its query.
			//Instead, it will return the results as a string return value
			//from curl_exec() instead of the usual true/false.
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			//exécute la requête - login
			$store = curl_exec($ch);
			
			//Mise en marche de la pompe
			if ($VarPilotagePompe == 'Marche') {
				curl_setopt($ch, CURLOPT_URL, 'http://smartemp.hayward.fr:9000/power');
				//affecte les variables à envoyer et le clic sur le bouton de connexion
				curl_setopt($ch, CURLOPT_POSTFIELDS, 'power=true');
			} elseif ($VarPilotagePompe == 'Arret') {
				curl_setopt($ch, CURLOPT_URL, 'http://smartemp.hayward.fr:9000/power');
				//affecte les variables à envoyer et le clic sur le bouton de connexion
				curl_setopt($ch, CURLOPT_POSTFIELDS, 'power=false');
			} elseif ($VarPilotagePompe == 'Refroidissement') {
				//Affectation mode pompe
				curl_setopt($ch, CURLOPT_URL, 'http://smartemp.hayward.fr:9000/internal/setmode');
				//affecte les variables à envoyer et le clic sur le bouton de connexion
				curl_setopt($ch, CURLOPT_POSTFIELDS, 'mode=0'); //0=refroidissement 1=Chauffage 2=Auto	
			} elseif ($VarPilotagePompe == 'Chauffage') {
				//Affectation mode pompe
				curl_setopt($ch, CURLOPT_URL, 'http://smartemp.hayward.fr:9000/internal/setmode');
				//affecte les variables à envoyer et le clic sur le bouton de connexion
				curl_setopt($ch, CURLOPT_POSTFIELDS, 'mode=1'); //0=refroidissement 1=Chauffage 2=Auto	
			} elseif ($VarPilotagePompe == 'Auto') {
				//Affectation mode pompe
				curl_setopt($ch, CURLOPT_URL, 'http://smartemp.hayward.fr:9000/internal/setmode');
				//affecte les variables à envoyer et le clic sur le bouton de connexion
				curl_setopt($ch, CURLOPT_POSTFIELDS, 'mode=2'); //0=refroidissement 1=Chauffage 2=Auto	
			} elseif ($VarPilotagePompe == 'AutorisationOn') {
				//Autorisation
				curl_setopt($ch, CURLOPT_URL, 'http://smartemp.hayward.fr:9000/control');
				//affecte les variables à envoyer et le clic sur le bouton de connexion
				curl_setopt($ch, CURLOPT_POSTFIELDS, 'control=true'); 
			} elseif ($VarPilotagePompe == 'AutorisationOff') {
				//Autorisation
				curl_setopt($ch, CURLOPT_URL, 'http://smartemp.hayward.fr:9000/control');
				//affecte les variables à envoyer et le clic sur le bouton de connexion
				curl_setopt($ch, CURLOPT_POSTFIELDS, 'control=false'); 		
			} elseif ($VarPilotagePompe == 'TimerTime') {
				//Timer pompe
				curl_setopt($ch, CURLOPT_URL, 'http://smartemp.hayward.fr:9000/internal/timer');
				//affecte les variables à envoyer et le clic sur le bouton de connexion
				//Envoi de toutes les valeurs seulement
				$timerOneOnMin = $this->getConfiguration("Timer1MinDep"); 
				$timerOneOnHour = $this->getConfiguration("Timer1HourDep"); 
				$timerOneOffMin = $this->getConfiguration("Timer1MinFin"); 
				$timerOneOffHour = $this->getConfiguration("Timer1HourFin"); 
				$timerTwoOnMin = $this->getConfiguration("Timer2MinDep"); 
				$timerTwoOnHour = $this->getConfiguration("Timer2HourDep"); 
				$timerTwoOffMin = $this->getConfiguration("Timer2MinFin"); 
				$timerTwoOffHour = $this->getConfiguration("Timer2HourFin"); 
				$Timer1OnDep = $this->getConfiguration("Timer1OnDep");
				$Timer1OnFin = $this->getConfiguration("Timer1OnFin");		
				$Timer2OnDep = $this->getConfiguration("Timer2OnDep");
				$Timer2OnFin = $this->getConfiguration("Timer2OnFin");			
				$resultatTimer = 'timerOneOnMin='.$timerOneOnMin.'&timerOneOnHour='.$timerOneOnHour.'&timerOneOn='.$Timer1OnDep
								.'&timerOneOffMin='.$timerOneOffMin.'&timerOneOffHour='.$timerOneOffHour.'&timerOneOff='.$Timer1OnFin
								.'&timerTwoOnMin='.$timerTwoOnMin.'&timerTwoOnHour='.$timerTwoOnHour.'&timerTwoOn='.$Timer2OnDep
								.'&timerTwoOffMin='.$timerTwoOffMin.'&timerTwoOffHour='.$timerTwoOffHour.'&timerTwoOff='.$Timer2OnFin ;
												
				curl_setopt($ch, CURLOPT_POSTFIELDS,$resultatTimer);
				
				//curl_setopt($ch, CURLOPT_POSTFIELDS,'timerOneOnMin='.$timerOneOnMin.'&timerOneOnHour='.$timerOneOnHour.'&timerOneOn=0'
				//								   .'&timerOneOffMin='.$timerOneOffMin.'&timerOneOffHour='.$timerOneOffHour.'&timerOneOff=0'
				//								   .'&timerTwoOnMin='.$timerTwoOnMin.'&timerTwoOnHour='.$timerTwoOnHour.'&timerTwoOn=0'
				//								   .'&timerTwoOffMin='.$timerTwoOffMin.'&timerTwoOffHour='.$timerTwoOffHour.'&timerTwoOff=0');
				
				//Envoi du timer 1 pour l'activer ou pas
				//curl_setopt($ch, CURLOPT_POSTFIELDS, 'timerOneOnMin=01'.'&timerOneOnHour=11'.'&timerOneOn=1'.'&timerOneOffMin=02'.'&timerOneOffHour=09'.'&timerOneOff=1'.'&timerTwoOnMin=12'.'&timerTwoOnHour=03'.'&timerTwoOffMin=13'.'&timerTwoOffHour=04');
				//Envoi du timer 2 pour l'activer ou pas
				//curl_setopt($ch, CURLOPT_POSTFIELDS, 'timerOneOnMin=01'.'&timerOneOnHour=11'.'&timerOneOffMin=02'.'&timerOneOffHour=09'.'&timerTwoOnMin=12'.'&timerTwoOnHour=03'.'&timerTwoOn=1'.'&timerTwoOffMin=13'.'&timerTwoOffHour=04'.'&timerTwoOff=1');
				//Envoi de toute la config du timer
				//curl_setopt($ch, CURLOPT_POSTFIELDS, 'timerOneOnMin=00'.'&timerOneOnHour=00'.'&timerOneOn=1'.'&timerOneOffMin=00'.'&timerOneOffHour=00'.'&timerOneOff=1'.'&timerTwoOnMin=00'.'&timerTwoOnHour=00'.'&timerTwoOn=1'.'&timerTwoOffMin=00'.'&timerTwoOffHour=00'.'&timerTwoOff=1');
			} 
			
			$store = curl_exec($ch);
			curl_close($ch); // on ferme la session curl
			
			log::add('PaC_Hayward', 'debug','Function ExecuteCmdPompe : Ok' );
			
			
		} else {
			log::add('PaC_Hayward', 'error','Function ExecuteCmdPompe : Serveur hayward down' );
		}
		
	} catch (Exception $e) {
		log::add('PaC_Hayward', 'error', __('Erreur lors de l\'éxecution de ExecuteCmdPompe '  . ' ' . $e->getMessage()));
	}	
}

public function ExecuteCmdSetConsigne($VarConsigne) {
	try {
		log::add('PaC_Hayward', 'debug','Function ExecuteCmdSetConsigne : Lancement' );
		$handle = @fopen("http://smartemp.hayward.fr:9000/", "r");
		if ($handle) {
			log::add('PaC_Hayward', 'debug','Function ExecuteCmdSetConsigne : Serveur hayward ok' );
			// ************* DEBUT DES VARIABLES
			$username = $this->getConfiguration("Login"); 
			$password = $this->getConfiguration("Password"); 
			$MyIpJeedom = $this->getConfiguration("MyIpJeedom");
			$login_url = 'http://smartemp.hayward.fr:9000/login'; //url de la page d'accueil (identification)
			//$cookie = 'PLAY_LANG=en'; //contenu du cookie
			$source= 'http://smartemp.hayward.fr:9000'; //page à récupérer
			// ************* FIN DES VARIABLES
			
			//initialisation curl
			$ch = curl_init();
			
			//en-têtes http
			$header[0] = "Host: http://smartemp.hayward.fr:9000";
			$header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
			$header[] = "Accept-Language: fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7"; 
			$header[] = "Accept-Charset: utf-8";
			$header[] = "Connection: keep-alive";
			$header[] = "Keep-Alive: 300";
			$header[] = "Pragma: no-cache";
			$header[] = "Cache-control: max-age=0";
			$header[] = "Origin: http://smartemp.hayward.fr:9000";
			$header[] = "Upgrade-Insecure-Requests: 1";
			$header[] = "Content-Type: application/x-www-form-urlencoded";
			$header[] = "Accept-Encoding: gzip, deflate";
			$header[] = "Referer: http://smartemp.hayward.fr:9000/login";
			$header[] = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36";
			
			//défini l'url de connexion/identification
			curl_setopt($ch, CURLOPT_URL, $login_url);
			//active HTTP POST
			curl_setopt($ch, CURLOPT_POST, 1);
			//affecte les variables à envoyer et le clic sur le bouton de connexion
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'barCode='.$username.'&pwd='.$password.'&ImageButton1.x='.$x.'&ImageButton1.y='.$y);
			
			//défini les en-têtes http
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			
			// Définition de la méthode d'authentification du serveur
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
			
			//gestion du cookie
			curl_setopt($ch, CURLOPT_COOKIEJAR, "/var/www/html/tmp/cookie"); //Le fichier dans lequel les cookies seront enregistrés
			
			//Setting CURLOPT_RETURNTRANSFER variable to 1 will force cURL
			//not to print out the results of its query.
			//Instead, it will return the results as a string return value
			//from curl_exec() instead of the usual true/false.
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			//exécute la requête - login
			$store = curl_exec($ch);
	
			//Affectation consigne pompe
			$target = $VarConsigne; 
			$target=($target*1.8)+32; //Conversion en F°
			curl_setopt($ch, CURLOPT_URL, 'http://smartemp.hayward.fr:9000/internal/settarget');
			//affecte les variables à envoyer et le clic sur le bouton de connexion
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'target='.$target);
			$store = curl_exec($ch);
	
			curl_close($ch); // on ferme la session curl
			
			log::add('PaC_Hayward', 'debug','Function ExecuteCmdSetConsigne : Ok' );
			
		} else {
			log::add('PaC_Hayward', 'error','Function ExecuteCmdSetConsigne : Serveur hayward down' );
		}
		
	} catch (Exception $e) {
		log::add('PaC_Hayward', 'error', __('Erreur lors de l\'éxecution de ExecuteCmdSetConsigne '  . ' ' . $e->getMessage()));
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
				$info = $eqlogic->Lecture_Consigne(); 	
				$eqlogic->checkAndUpdateCmd('1_consigne', $info); 
				$info = $eqlogic->Lecture_EntreeEau(); 	
				$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
				$info = $eqlogic->Lecture_SortieEau(); 	
				$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
				$info = $eqlogic->Lecture_Mode(); 	
				$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
				$info = $eqlogic->Lecture_Power(); 	
				$eqlogic->checkAndUpdateCmd('2_Power', $info);
            	$info = $eqlogic->LectureCycle(); 	
				$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
				break;
			case '3_Arret':
				$cmd = $eqlogic->ExecuteCmdPompe('Arret');
				$info = $eqlogic->Update();
				$info = $eqlogic->Lecture_Consigne(); 	
				$eqlogic->checkAndUpdateCmd('1_consigne', $info); 
				$info = $eqlogic->Lecture_EntreeEau(); 	
				$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
				$info = $eqlogic->Lecture_SortieEau(); 	
				$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
				$info = $eqlogic->Lecture_Mode(); 	
				$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
				$info = $eqlogic->Lecture_Power(); 	
				$eqlogic->checkAndUpdateCmd('2_Power', $info);
            	$info = $eqlogic->LectureCycle(); 	
				$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
				break;
			case '5_ModeRefroidissement':
				$cmd = $eqlogic->ExecuteCmdPompe('Refroidissement');
				$info = $eqlogic->Update();
				$info = $eqlogic->Lecture_Consigne(); 	
				$eqlogic->checkAndUpdateCmd('1_consigne', $info); 
				$info = $eqlogic->Lecture_EntreeEau(); 	
				$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
				$info = $eqlogic->Lecture_SortieEau(); 	
				$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
				$info = $eqlogic->Lecture_Mode(); 	
				$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
				$info = $eqlogic->Lecture_Power(); 	
				$eqlogic->checkAndUpdateCmd('2_Power', $info);
            	$info = $eqlogic->LectureCycle(); 	
				$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
				break;
			case '5_ModeChauffage':
				$cmd = $eqlogic->ExecuteCmdPompe('Chauffage');
				$info = $eqlogic->Update();
				$info = $eqlogic->Lecture_Consigne(); 	
				$eqlogic->checkAndUpdateCmd('1_consigne', $info); 
				$info = $eqlogic->Lecture_EntreeEau(); 	
				$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
				$info = $eqlogic->Lecture_SortieEau(); 	
				$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
				$info = $eqlogic->Lecture_Mode(); 	
				$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
				$info = $eqlogic->Lecture_Power(); 	
				$eqlogic->checkAndUpdateCmd('2_Power', $info);
            	$info = $eqlogic->LectureCycle(); 	
				$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
				break;
			case '5_ModeAuto':
				$cmd = $eqlogic->ExecuteCmdPompe('Auto');
				$info = $eqlogic->Update();
				$info = $eqlogic->Lecture_Consigne(); 	
				$eqlogic->checkAndUpdateCmd('1_consigne', $info); 
				$info = $eqlogic->Lecture_EntreeEau(); 	
				$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
				$info = $eqlogic->Lecture_SortieEau(); 	
				$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
				$info = $eqlogic->Lecture_Mode(); 	
				$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
				$info = $eqlogic->Lecture_Power(); 	
				$eqlogic->checkAndUpdateCmd('2_Power', $info);
            	$info = $eqlogic->LectureCycle(); 	
				$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
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
				
				$info = $eqlogic->Lecture_Consigne(); 	//On lance la fonction randomVdm() pour récupérer une vdm et on la stocke dans la variable $info
				$eqlogic->checkAndUpdateCmd('1_consigne', $info); // on met à jour la commande avec le LogicalId "story"  de l'eqlogic 
				
				$info = $eqlogic->Lecture_EntreeEau(); 	
				$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
				
				$info = $eqlogic->Lecture_SortieEau(); 	
				$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
				
				$info = $eqlogic->Lecture_Mode(); 	
				$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
				
				$info = $eqlogic->Lecture_Power(); 	
				$eqlogic->checkAndUpdateCmd('2_Power', $info); 
            
            	$info = $eqlogic->LectureCycle(); 	
				$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
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
				
				$info = $eqlogic->Lecture_Consigne(); 	//On lance la fonction randomVdm() pour récupérer une vdm et on la stocke dans la variable $info
				$eqlogic->checkAndUpdateCmd('1_consigne', $info); // on met à jour la commande avec le LogicalId "story"  de l'eqlogic 
				
				$info = $eqlogic->Lecture_EntreeEau(); 	
				$eqlogic->checkAndUpdateCmd('1_EntreeEau', $info); 
				
				$info = $eqlogic->Lecture_SortieEau(); 	
				$eqlogic->checkAndUpdateCmd('1_SortieEau', $info); 
				
				$info = $eqlogic->Lecture_Mode(); 	
				$eqlogic->checkAndUpdateCmd('4_Mode', $info); 
				
				$info = $eqlogic->Lecture_Power(); 	
				$eqlogic->checkAndUpdateCmd('2_Power', $info); 
            
            	$info = $eqlogic->LectureCycle(); 	
				$eqlogic->checkAndUpdateCmd('8_EnCycle', $info);
				
				
				break;
		}
    }

    /*     * **********************Getteur Setteur*************************** */
}
