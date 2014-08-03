<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'conf.php';
require_once KBN_UTILS_DIR . 'kUtils.php';

function registerAIVarLib($class)
{
	$file = KBN_AI_VAR_LIB_DIR . $class . '.php';
	kIO::inc($file);
}

spl_autoload_register('registerAIVarLib');
?>