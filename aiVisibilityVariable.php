<?php
class aiVisibilityVariable extends aiBaseVariable
{
	protected $_category     = '&ns_vars;';
	protected $_trait        = 'visibility';
	protected $_varName      = '';
	protected $_wrapperStart = '';
	protected $_wrapperEnd   = '';

	public function formatValue($val)
	{
		return !!$val ? 'true' : 'false';
	}
}
?>