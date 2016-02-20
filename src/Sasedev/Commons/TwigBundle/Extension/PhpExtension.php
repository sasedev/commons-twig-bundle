<?php

namespace Sasedev\Commons\TwigBundle\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 *
 * @author sasedev <seif.salah@gmail.com>
 */
class PhpExtension extends Twig_Extension
{

	/**
	 *
	 * {@inheritDoc} @see Twig_Extension::getFunctions()
	 */
	public function getFunctions()
	{
		$fonctions = array();

		$fonctions['CallPhp_*'] = new Twig_SimpleFunction('CallPhp_*', array($this, 'twigToPhp'), array('pre_escape' => 'html', 'is_safe' => array('html')));

		return $fonctions;
	}

	public function twigToPhp()
	{
		$arg_list = func_get_args();
		$function = array_shift($arg_list);

		return call_user_func_array($function, $arg_list);
	}

	/**
	 *
	 * {@inheritDoc} @see Twig_ExtensionInterface::getName()
	 */
	public function getName()
	{
		return 'Sasedev.Commons.Twig.CallPhp';
	}
}
