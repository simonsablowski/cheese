<?php

class Request extends Application {
	protected $query = NULL;
	protected $controller = NULL;
	protected $action = NULL;
	protected $parameters = NULL;
	
	public function __construct($query) {
		$this->setQuery($query);
	}
	
	protected function getAlias($query) {
		if (is_null($this->getConfiguration())) {
			throw new FatalError('Request configuration undefined');
		}
		if (is_null($this->getConfiguration('aliasQueries'))) {
			throw new FatalError('Alias queries undefined', $this->getConfiguration());
		}
		
		foreach ($this->getConfiguration('aliasQueries') as $pattern => $replacement) {
			$alias = preg_replace(sprintf('#^%s$#i', $pattern), $replacement, $query, -1, $replaced);
			if ($replaced) return $alias;
		}
		return $query;
	}
	
	protected function resolveQuery() {
		$query = $this->getQuery() ? $this->getQuery() : $this->getConfiguration('defaultQuery');
		return $this->getAlias($query);
	}
	
	public function analyze() {
		$segments = explode('/', $this->resolveQuery());
		if (is_string($segments)) $segments = array($segments);
		
		if (isset($segments[0]) && $segments[0]) $this->setController($segments[0]);
		else throw new FatalError('No controller defined', $segments);
		
		if (isset($segments[1]) && $segments[1]) $this->setAction($segments[1]);
		else throw new FatalError('No action defined', $segments);
		
		$this->setParameters(array_slice($segments, 2));
	}
	
	protected function escape($data) {
		return $data;
	}
	
	public function getData($field = NULL) {
		$request = array_merge($_GET, $_POST, $_SERVER);
		
		if (is_null($field)) {
			return $this->escape($request);
		} else if (isset($request[$field])) {
			return $this->escape($request[$field]);
		} else {
			return NULL;
		}
	}
	
	public function isSubmitted($field = 'submit') {
		return !is_null($this->getData($field));
	}
}