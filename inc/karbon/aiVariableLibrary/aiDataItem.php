<?php
class aiDataItem
{
	private $_tagName      = '';
	private $_wrapperStart = '';
	private $_wrapperEnd   = '';
	private $_value        = '';

	public function __construct(aiBaseVariable &$var,$value)
	{
		$this->_tagName      = $var->getVarName(true);
		$this->_wrapperStart = $var->getWrapperStart();
		$this->_wrapperEnd   = $var->getWrapperEnd();
		$this->_value        = $var->formatValue($value);
	}

	public function __toString()
	{
		$str = "\t" . '<%1$s>%2$s%4$s%3$s</%1$s>' . "\n";
		return sprintf($str,$this->_tagName,$this->_wrapperStart,$this->_wrapperEnd,$this->_value);
	}
}
?>