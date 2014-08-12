<?php
class aiVariableLibrary
{
	const LIB_HEAD = <<<'HEAD'
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20001102//EN"    "http://www.w3.org/TR/2000/CR-SVG-20001102/DTD/svg-20001102.dtd" [
	<!ENTITY ns_graphs "http://ns.adobe.com/Graphs/1.0/">
	<!ENTITY ns_vars "http://ns.adobe.com/Variables/1.0/">
	<!ENTITY ns_imrep "http://ns.adobe.com/ImageReplacement/1.0/">
	<!ENTITY ns_custom "http://ns.adobe.com/GenericCustomNamespace/1.0/">
	<!ENTITY ns_flows "http://ns.adobe.com/Flows/1.0/">
<!ENTITY ns_extend "http://ns.adobe.com/Extensibility/1.0/">
]>
<svg>
<variableSets xmlns='&ns_vars;'>
HEAD;
	const LIB_FOOT = <<<'FOOT'
</variableSets>
</svg>
FOOT;

	private $_variableSets      = array();
	private static $_workingDir = '';

	public function __construct($jsonFile)
	{
		$input             = kIO::loadJson($jsonFile);
		self::$_workingDir = dirname(realpath($jsonFile)) . DS;

		foreach($input->variableSets as $vs)
		{
			$this->addSet(new aiVariableSet($vs));
		}

	}

	private function addSet($varSet)
	{
		if(is_a($varSet,'aiVariableSet'))
		{
			$this->_variableSets[] = $varSet;
		}
	}

	public static function getWorkingDir()
	{
		return self::$_workingDir;
	}

	public function __toString()
	{
		$varSets = '';
        
		foreach($this->_variableSets as $vs)
		{
			$varSets .= "{$vs}";
		}
        
		return sprintf("%s\n%s%s\n",self::LIB_HEAD,$varSets,self::LIB_FOOT);
	}
}
?>