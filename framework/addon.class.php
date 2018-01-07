<?php
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Addon {
	protected static $zip;
	
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
	
	public static function copyFile($source,$target,$root = '') {
		$sourceData = self::$zip->statName($source);
		if($sourceData === false)
			$sourceData = self::$zip->statName($root.'/'.$source);
		if($sourceData === false) {
			throw new \Exception("Could not locate file '{$source}'");
		} else {
			self::$zip->extractTo(__ROOT__.DS.$target,$sourceData['name']);
		}
	}
	
	public static function copyFolder($source,$target,$root = '') {
		$sourceData = self::$zip->statName($source.'/');
		if($sourceData === false)
			$sourceData = self::$zip->statName($root.'/'.$source.'/');
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
	
	public static function install($path) {
		if($descriptor = self::loadDescriptor($path)) {
		} else {
			throw new \Exception("Could not load descriptor");
		}
		$install = $descriptor->install;
		$root = (isset($descriptor->name) ? (string)$descriptor->name : '');
		$target = (isset($install->Attributes()['type']) ? $install->Attributes()['type'] : '');
		self::$zip = new \ZipArchive();
		if(self::$zip->open((string)$install) === false) {
			throw new \Exception("Add-on archive could not be opened");
		}
		$files = $descriptor->files;
		foreach($files->file as $file) {
			$fileName = (string)$file;
			if(isset($file->Attributes()['target'])) {
				self::copyFile($fileName,$file->Attributes()['target'],$root);
			} else {
				self::copyFile($fileName,$target,$root);
			}
		}
		foreach($files->folder as $folder) {
			$folderName = (string)$folder;
			if(isset($folder->Attributes()['target'])) {
				self::copyFolder($folderName,$folder->Attributes()['target'],$root);
			} else {
				self::copyFolder($folderName,$target,$root);
			}
		}
	}
}