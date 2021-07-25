<?php 
		class Logs {
		    private $path = __DIR__ . '/logs/';
			public function __construct($typ) {
				date_default_timezone_set('Europe/Berlin');	
				$this->path  = dirname(__FILE__)  . $this->path;
				$this->typ = $typ;
			}

			public function write($message) {
				$date = new DateTime();
				$log = $this->path . $date->format('Y-m-d')."-".$this->typ.".txt";
				if(is_dir($this->path)) {
					if(!file_exists($log)) {
						$fh  = fopen($log, 'a+') or die(var_dump($log).var_dump($message));
						$logcontent = "####################### Uhrzeit : " . $date->format('H:i:s')." #######################r\n\n\n" . $message ."\r\n";
						fwrite($fh, $logcontent);
						fclose($fh);
					}
					else {
						$this->edit($log,$date, $message);
					}
				}
				else {
					  if(mkdir($this->path,0777) === true) 
					  {
 						 $this->write($message);  
					  }	
				}
			 }
			    private function edit($log,$date,$message) {
				$logcontent = "####################### Uhrzeit : " . $date->format('H:i:s')." #######################\r\n\n\n" . $message ."\r\n\r\n";
				$logcontent = $logcontent . file_get_contents($log);
				file_put_contents($log, $logcontent);
			    }
		}
?>