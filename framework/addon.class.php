<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Addon {
	protected static $zip;
	protected static $tempPath;
	
	public static function loadXML($xml) {
		return $xml;
		//return json_decode(json_encode($xml));
	}
	
	public static function loadDescriptor($path) {
		if(file_exists($path)) {
			$fileName = basename($path);
			$addonName = current(explode('.',$fileName));
			if(substr($fileName,-4) == '.xml') {
				// Read descriptor file directly
				return self::loadXML(simplexml_load_file($path));
			} else {
				// Load descriptor file from ZIP
				self::$zip = new \ZipArchive();
				if(self::$zip->open($path) === true) {
					$addonIndex = self::$zip->locateName($addonName.'.xml',\ZipArchive::FL_NODIR);
					if($addonIndex === false) {
						throw new \Exception("Add-on does not contain expected addon.xml");
					}
					$descriptor = self::loadXML(simplexml_load_string(self::$zip->getFromIndex($addonIndex)));
					self::$zip->close();
					return $descriptor;
				} else {
					throw new \Exception("Add-on archive could not be opened");
				}
			}
		} else {
			throw new \Exception("Add-on not found");
		}
		return false;
	}
	
	public static function copyFile($source,$target,$base = '') {
		$sourceData = self::$zip->statName($source);
		if($sourceData === false)
			$sourceData = self::$zip->statName($base.$source);
		if($sourceData === false) {
			throw new \Exception("Could not locate file '{$source}'");
		} else {
			self::$zip->extractTo(__ROOT__.DS.$target,$sourceData['name']);
		}
	}
	
	public static function copyFolder($source,$target,$base = '') {
		$sourceData = self::$zip->statName($source.'/');
		if($sourceData === false)
			$sourceData = self::$zip->statName($base.$source.'/');
		if($sourceData === false) {
			throw new \Exception("Could not locate folder '{$source}'");
		} else {
			for($i = 0; $i < self::$zip->numFiles; $i++) {
				$fileName = self::$zip->getNameIndex($i);
				if(substr($fileName,0,strlen($sourceData['name'])) == $sourceData['name'])
					self::$zip->extractTo(__ROOT__.DS.$target,$fileName);
			}
		}
	}
	
	public static function download($path) {
		$success = false;
		$sourceFile = fopen($path,'rb');
		if($sourceFile) {
			self::$tempPath = ini_get('upload_tmp_dir').DS.basename($path);
			$targetFile = fopen(self::$tempPath,'wb');
			if($targetFile) {
				while(!feof($sourceFile))
					fwrite($targetFile,fread($sourceFile,8192),8192);
				$success = true;
				fclose($targetFile);
			}
			fclose($sourceFile);
		}
		return $success ? self::$tempPath : $success;
	}
	
	public static function install($path) {
		$descriptor = self::loadDescriptor($path);
		if(!$descriptor) {
			throw new \Exception("Could not load descriptor");
		}
		$zipPath = (string)$descriptor->install;
		// Download only if ZIP file is URL
		if(filter_var($zipPath,FILTER_VALIDATE_URL))
			$zipPath = self::download($zipPath);
		self::$zip = new \ZipArchive();
		if(self::$zip->open($zipPath) === false) {
			throw new \Exception("Could not load open ZIP archive");
		}
		$files = $descriptor->files;
		$target = (isset($descriptor->install->Attributes()['type']) ? $descriptor->install->Attributes()['type'] : '');
		$baseFolder = self::$zip->getNameIndex(0);
		$baseFolder = current(explode('/',$baseFolder)).'/';
		// Copy each file
		foreach($files->file as $file) {
			$fileName = (string)$file;
			if(isset($file->Attributes()['target'])) {
				self::copyFile($fileName,$file->Attributes()['target'],$baseFolder);
			} else {
				self::copyFile($fileName,$target,$baseFolder);
			}
		}
		foreach($files->folder as $folder) {
			$folderName = (string)$folder;
			if(isset($folder->Attributes()['target'])) {
				self::copyFolder($folderName,$folder->Attributes()['target'],$baseFolder);
			} else {
				self::copyFolder($folderName,$target,$baseFolder);
			}
		}
	}
}