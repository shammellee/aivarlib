<?php
class aiDataSet
{
	private $_wrapperStart            = '';
	private $_wrapperStartPlaceholder = "\t\t\t<v:sampleDataSet dataSetName='%s'>\n";
	private $_wrapperEnd              = "\t\t\t</v:sampleDataSet>\n";
	private $_name                    = '';
	private $_dataItems               = array();
	private $_repeatCount             = 1;

	public function __construct($name)
	{
		$this->setDataSetName($name);
	}

	public function setDataSetName($name)
	{
		if(is_string($name) && !empty($name))
		{
			$this->_name         = kTex::sanitizeString('trim',$name);
			$this->_wrapperStart = sprintf($this->_wrapperStartPlaceholder,$name);
			return $this;
		}

		return false;
	}

	public function addDataItem(aiDataItem $item)
	{
		$this->_dataItems[] = $item;
	}

	public function __toString()
	{
		$str = '';

		foreach($this->_dataItems as $i)
		{
			$str .= "\t\t\t{$i}";
		}

		return sprintf("%s%s%s",$this->_wrapperStart,$str,$this->_wrapperEnd);
	}
}
?>