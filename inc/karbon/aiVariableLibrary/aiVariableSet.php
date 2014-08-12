<?php
class aiVariableSet
{
	private $_variableSetStart = "\t<variableSet locked='none' varSetName='binding1'>\n";
	private $_variableSetEnd   = "\t</variableSet>\n";
	private $_variableStart    = "\t\t<variables>\n";
	private $_variableEnd      = "\t\t</variables>\n";
	private $_dataSetStart     = "\t\t<v:sampleDataSets xmlns:v='http://ns.adobe.com/Variables/1.0/' xmlns='http://ns.adobe.com/GenericCustomNamespace/1.0/'>\n";
	private $_dataSetEnd       = "\t\t</v:sampleDataSets>\n";
	private $_vars             = array();
	private $_dataSets         = array();

	public function __construct(stdClass &$variableSet)
	{
		$vars     = $variableSet->variables;
		$dataSets = $variableSet->data;

		if((is_array($vars) && !empty($vars)) && (is_array($dataSets) && !empty($dataSets)))
		{
			$dataSetCount = count($dataSets);

			# create empty data sets
			foreach($dataSets as $ds)
			{
				$this->_dataSets[] = new aiDataSet(kTex::sanitizeString('trim',$ds->name));
			}

			foreach($vars as $v)
			{
				if($v->instances && $v->instances > 1)
				{
					for($i = 0;$i < $v->instances;)
					{
						++$i;
						$var = $this->addVariable($v,"_{$i}");
						$this->addDataItem($var,$dataSets);
					}
				}else
				{
					$var = $this->addVariable($v);
					$this->addDataItem($var,$dataSets);
				}
			}
		}
	}

	private function &addVariable(&$v,$suffix = '')
	{
		$type = sprintf('ai%sVariable',ucfirst(kTex::sanitizeString('trim',$v->type)));
		$var  = new $type(kTex::sanitizeString('trim',$v->name),$suffix);
		$this->_vars[] = $var;
		return $var;
	}

	private function addDataItem(aiBaseVariable $var,array &$dataSets)
	{
		$dataSetCount = count($this->_dataSets);

		for($i = 0;$i < $dataSetCount;$i++)
		{
			$this->_dataSets[$i]->addDataItem(new aiDataItem($var,kTex::sanitizeString('trim',$dataSets[$i]->values->{$var->getVarName()})));
		}
	}

	public function __toString()
	{
		$vars     = '';
		$dataSets = '';

		foreach($this->_vars as $v)
		{
			$vars .= "\t\t\t{$v}";
		}

		foreach($this->_dataSets as $ds)
		{
			$dataSets .= "{$ds}";
		}

		return sprintf("%s%s%s%s%s%s%s%s",$this->_variableSetStart,$this->_variableStart,$vars,$this->_variableEnd,$this->_dataSetStart,$dataSets,$this->_dataSetEnd,$this->_variableSetEnd);
	}
}
?>