<?php
/**
 * @application    Cubo CMS
 * @type           Framework
 * @class          Database
 * @version        1.1.0
 * @date           2019-01-22
 * @author         Dan Barto
 * @copyright      Copyright (C) 2017 - 2019 Papiando Riba Internet. All rights reserved.
 * @license        GNU General Public License version 3 or later; see LICENSE.md
 */
namespace Cubo;

defined('__CUBO__') || new \Exception("No use starting a class without an include");

class Database {
	private $connection;
	private $user;
	private $password;
	protected static $dbh = null;
	private $className = null;
	protected $query;
	
	public function __construct($options) {
		$this->query = new \stdClass();
		if(is_array($options))
			foreach($options as $option=>$value)
				$this->$option = $value;
		return $this->connect();
	}
	
	public function __destruct() {
		$this->connected() && $this->disconnect();
	}
	
	public function connect() {
		if(empty($this->connection)) {
			throw new \Exception("[".get_class($this)."] [001] No database connection string");
			return null;
		} else {
			try {
				!empty($this->connection) && !empty($this->user) && !empty($this->password) && self::$dbh = new \PDO($this->connection,$this->user,$this->password);
				// TODO: $log = new Log(['result'=>"success",'message'=>"Open connection to database"]);
			} catch(PDOException $e) {
				die("class Database: ".$e->getMessage()."\n");
			}
		}
		return $this->connected();
	}
	
	public function connected() {
		return self::$dbh;
	}
	
	public function disconnected() {
		return !$this->connected();
	}
	
	public function disconnect() {
		self::$dbh = null;
	}
	
	public function query($query = null) {
		if(!is_string($query)) {
			switch($this->method) {
				case 'insert':
					$query = "INSERT INTO ".self::quote($this->query->insert);
					isset($this->query->columns) && $query .= ' ('.self::quote($this->query->columns).')';
					isset($this->query->values) && $query .= " VALUES (".self::comma($this->query->values).')';
					break;
				case 'select':
					$query = "SELECT ".$this->query->select;
					$query .= isset($this->query->from) ? " FROM ".self::quote($this->query->from) : "";
					$query .= isset($this->query->innerjoin) ? " INNER JOIN ".self::quote($this->query->innerjoin) : "";
					$query .= isset($this->query->on) ? " ON ".self::quote($this->query->on)."=".self::quote($this->query->innerjoin).".`id`" : "";
					$query .= isset($this->query->where) ? " WHERE ".$this->query->where : "";
					$query .= isset($this->query->group) ? " GROUP BY ".$this->query->group : "";
					$query .= isset($this->query->having) ? " HAVING ".$this->query->having : "";
					$query .= isset($this->query->order) ? " ORDER BY ".$this->query->order : "";
					$query .= isset($this->query->limit) ? " LIMIT ".$this->query->limit : "";
					$query .= isset($this->query->offset) ? " OFFSET ".$this->query->offset : "";
					break;
				case 'update':
					$query = "UPDATE ".self::string($this->query['update']);
					$query .= isset($this->query['set']) ? " SET ".self::comma($this->query['set']) : "";
					$query .= isset($this->query['where']) ? " WHERE ".$this->query['where'] : "";
					break;
				default:
					$query = "";
			}
			unset($this->method);
			$this->query = new \stdClass();
		}
		return $query;
	}
	
	// Added for debugging purposes
	public function getQuery() {
		return $this->query;
	}
	
	public function load($query = null,$list = null) {
		if(is_array($query)) {
			$list = $query;
			$query = null;
		}
		$sth = self::$dbh->prepare(empty($query) ? $this->query() : $query);
		$sth->execute($list);
		$result = $sth->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'\\'.__NAMESPACE__.'\\'.$this->className);
		$this->className = null;
		return $result;
	}
	
	public function loadObject($query = null,$list = null) {
		if(is_array($query)) {
			$list = $query;
			$query = null;
		}
		$sth = self::$dbh->prepare(empty($query) ? $this->query() : $query);
		$sth->execute($list);
		$sth->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,'\\'.__NAMESPACE__.'\\'.$this->className);
		$result = $sth->fetch();
		$this->className = null;
		return $result;
	}
	
	public function loadItems($query = null,$list = null) {
		if(is_array($query)) {
			$list = $query;
			$query = null;
		}
		$sth = self::$dbh->prepare(empty($query) ? $this->query() : $query);
		$sth->execute($list);
		$sth->setFetchMode(\PDO::FETCH_ASSOC);
		$result = $sth->fetchAll();
		$this->className = null;
		return $result;
	}
	
	public function loadItem($query = null,$list = null) {
		if(is_array($query)) {
			$list = $query;
			$query = null;
		}
		$sth = self::$dbh->prepare(empty($query) ? $this->query() : $query);
		$sth->execute($list);
		$sth->setFetchMode(\PDO::FETCH_ASSOC);
		$result = $sth->fetch();
		$this->className = null;
		return $result;
	}
	
	public function execute($query = null,$list = null) {
		if(is_array($query)) {
			$list = $query;
			$query = null;
		}
		$sth = self::$dbh->prepare(empty($query) ? $this->query() : $query);
		$result = $sth->execute($list);
		$this->className = null;
		return $result;
	}
	
	public function id() {
		return $this->dbh->lastInsertId();
	}
	
	public function columns($fields) {
		$this->query->columns = $fields;
		return $this;
	}
	
	public function delete() {
		$this->method = 'delete';
		return $this;
	}
	
	public function from($table) {
		$this->query->from = $table;
		$this->className = $table;
		return $this;
	}
	
	public function group($fields) {
		$this->query->group = $fields;
		return $this;
	}
	
	public function having($conditions) {
		$this->query->having = $conditions;
		return $this;
	}
	
	public function innerjoin($table) {
		$this->query->innerjoin = $table;
		return $this;
	}
	
	public function insert($table) {
		$this->method = "insert";
		$this->query->insert = $table;
		return $this;
	}
	
	public function join($table,$id) {
		$this->query->innerjoin = $table;
		$this->query->on = $id;
		return $this;
	}
	
	public function limit($num) {
		$this->query->limit = $num;
		return $this;
	}
	
	public function offset($num) {
		$this->query->offset = $num;
		return $this;
	}
	
	public function on($id) {
		$this->query->on = $id;
		return $this;
	}
	
	public function order($sort) {
		$this->query->order = $sort;
		return $this;
	}
	
	public function select($fields) {
		$this->method = 'select';
		$this->query->select = $fields;
		return $this;
	}
	
	public function update($table) {
		$this->method = 'update';
		$this->query->update = $table;
		return $this;
	}
	
	public function values($fields) {
		$this->query->values = $fields;
		return $this;
	}
	
	public function where($conditions) {
		$this->query->where = $conditions;
		return $this;
	}
	
	public function data($data) {
		$json = json_decode($data,true);
		if (json_last_error() === JSON_ERROR_NONE) {
			$this->query->columns = array_keys($json);
			$this->query->values = array_values($json);
			// TODO: UPDATE SET statement
		} else {
			throw new \Exception("[".get_class($this)."] [011] No JSON data provided");
		}
		return $this;
	}
	
	public static function quote($object) {
		if(is_array($object)) {
			$result = "";
			$first = true;
			foreach($object as $item) {
				$first ? $first = false : $result .= ',';
				$result .= self::quote($item);
			}
		} elseif(strpos($object,',')) {
			$result = self::quote(explode(',',$object));
		} else {
			$result = "`{$object}`";
		}
		return $result;
	}
	
	public static function seo($string,$separator = '-') {
		$accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
		$special_cases = array('&'=>'and',"'"=>'');
		$string = strtolower(trim($string));
		$string = str_replace(array_keys($special_cases),array_values($special_cases),$string);
		$string = preg_replace($accents_regex,'$1',htmlentities($string,ENT_QUOTES,'UTF-8'));
		$string = preg_replace("/[^a-z0-9]/u","$separator",$string);
		$string = preg_replace("/[$separator]+/u","$separator",$string);
		return $string;
	}
	
	public static function string($object) {
		if(is_array($object)) {
			$result = "";
			$first = true;
			foreach($object as $item) {
				$first ? $first = false : $result .= ',';
				$result .= self::string($item);
			}
		} else {
			$result = self::$dbh->quote($object);
		}
		return $result;
	}
}
?>