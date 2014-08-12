<?php
class aiImageVariable extends aiBaseVariable
{
	protected $_category     = 'http://ns.adobe.com/Variables/1.0/';
	protected $_trait        = 'fileref';
	protected $_varName      = '';
	protected $_wrapperStart = 'file:///';
	protected $_wrapperEnd   = '';

	public function formatValue($val)
	{
		if(is_string($val) && !empty($val))
		{
			$wd = aiVariableLibrary::getWorkingDir();

			if(kIO::isValidPath($val))
			{
				if(is_file(realpath($val)))
				{
					return realpath($val);
				}elseif(0 === strpos($val,'./'))
				{
					return $wd . substr($val,2);
				}else
				{
					return $val;
				}
			}else
			{
				return "{$wd}{$val}";
			}
		}
		return $val;
	}
}
?>