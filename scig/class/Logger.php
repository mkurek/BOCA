<?php
	class Logger {
		var $filehandle;
		function Logger($filename) {
			$this->filehandle=fopen($filename,"a+");
		}

		function writeLog($message) {
			fwrite($this->filehandle,$message."\n");
		}
		
		function close() {
			fclose($this->filehandle);
		}
	}

?>
