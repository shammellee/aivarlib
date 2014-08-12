<?php
class aiVariableLibraryTemplate
{
	public function __construct()
	{
	}

	public function __toString()
	{
		return <<<T
{
	"version":"0.1"
	,"variableSets":
	[
		{
			"variables":
			[
				{"name":"variable1","type":"string"}
			]
			,"data":
			[
				{
					"name":"data set 1"
					,"values":
					{
						"variable1":"hello"
					}
				}
			]
		}
	]
}
T;
	}
}
?>