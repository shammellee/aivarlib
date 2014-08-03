<?php
class aiBaseVariable
{
	protected $_category      = '';
	protected $_trait         = '';
	protected $_varName       = '';
	protected $_instanceSuffix = '';
	protected $_wrapperStart  = '';
	protected $_wrapperEnd    = '';

	public function __construct($varName,$instanceSuffix = '')
	{
		$this->setVarName($varName);

		if(is_string($instanceSuffix) && !empty($instanceSuffix))
		{
			$this->_instanceSuffix = $instanceSuffix;
		}
	}

	public function setVarName($varName)
	{
		if(is_string($varName) && !empty($varName))
		{
			$this->_varName = trim($varName);
			return $this;
		}

		return false;
	}

	public function getVarName($includeInstanceSuffix = false)
	{
		return $this->_varName . ($includeInstanceSuffix ? $this->_instanceSuffix : '');
	}

	public function getWrapperStart()
	{
		return $this->_wrapperStart;
	}

	public function getWrapperEnd()
	{
		return $this->_wrapperEnd;
	}

	public function formatValue($val)
	{
		return $val;
	}

	public function __toString()
	{
		$str = "<variable category='%s' trait='%s' varName='%s'></variable>\n";
		return sprintf($str,$this->_category,$this->_trait,$this->getVarName(true));
	}
}
?>