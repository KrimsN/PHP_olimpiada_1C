<?php

	$handle = fopen("input.txt", "r");

	$conf = fgets($handle);
	$conf = json_decode($conf, true);

	$write = fopen("output.txt", "w");
	$result = [];
	if(is_array($conf)){
		$i = 0;
		while(!feof($handle)){

			$class = fgets($handle);
			$class = trim($class);
			$result[$i] =  "\n" . $class;

			foreach($conf as $ar){
			$confNamespace = explode('\\', $ar['namespace']);
			$r = find($ar, $class);

			if($r){
				$result[$i] .= $r;
			}

		}
		$i++;
	}

	$res = implode("\n", $result);
	fwrite($write, $res);

	}
	function casefunc($name, $type){
		switch ($type) {
			case 'camel':
				return array_map('camel', $name);
				break;

			case 'lower':
				return array_map('lower', $name);
				break;

			case 'snake':
				return  array_map('snake', $name);
				
				break;

			case 'default':
				return  $name;
				break;	
		}
	}
	
	
	function find($conf, $className){

		$namespace = explode('\\', $conf['namespace']);
		$className = explode('\\', $className);

		if(!array_diff($namespace, $className)){
			$className[count($className) - 1] = trim($className[count($className) - 1]) ;
			$className = array_diff ($className, $namespace);
			$className = casefunc($className, $conf['type']);
			$str = implode('/', $className);
			$result = "\n" . $conf['base_dir'] . $str . '.php';
			return $result;
		}else return false;
	}
	function camel($str){
			return lcfirst ( $str );
		}
	function lower($str){
		return strtolower ( $str );
	}

	function snake($str){
		return from_camel_case($str);
	}

	function from_camel_case($input) {
  		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
  		$ret = $matches[0];
  	foreach ($ret as &$match) {
    	$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
  	}
  		return implode('_', $ret);
}
