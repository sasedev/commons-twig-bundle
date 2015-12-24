<?php

namespace Sasedev\Commons\TwigBundle\Extension;

use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

/**
 * Font Awesome icon helper
 * 
 * @author sasedev <seif.salah@gmail.com>
 */
class FontAwesomeIconExtension extends Twig_Extension
{

	/**
	 *
	 * {@inheritDoc} @see Twig_Extension::getFilters()
	 */
	public function getFilters()
	{
		return array(
			new Twig_SimpleFilter('parse_icons', array($this, 'parseIconsFilter'), array('pre_escape' => 'html', 'is_safe' => array('html'))));
	}

	/**
	 *
	 * {@inheritDoc} @see Twig_Extension::getFunctions()
	 */
	public function getFunctions()
	{
		return array(
			new Twig_SimpleFunction('faIco', array($this, 'iconFunction'), array('pre_escape' => 'html', 'is_safe' => array('html'))));
	}

	/**
	 * Parses the given string and replaces all occurrences of .
	 * icon-[name] with the corresponding icon.
	 * 
	 * @param string $text
	 *        	The text to parse
	 * @return string The HTML code with the icons
	 */
	public function parseIconsFilter($text)
	{
		$that = $this;
		return preg_replace_callback('/\.faIco-([a-z0-9-]+)/', 
			function ($matches) use ($that)
			{
				return $that->iconFunction($matches[1]);
			}, $text);
	}

	/**
	 * Returns the HTML code for the given icon.
	 * 
	 * @param string $icon
	 *        	The name of the icon
	 * @return string The HTML code for the icon
	 */
	public function iconFunction($icon)
	{
		return sprintf('<span class="fa fa-%s"></span>', $icon);
	}

	/**
	 *
	 * {@inheritDoc} @see Twig_ExtensionInterface::getName()
	 */
	public function getName()
	{
		return 'Sasedev.Commons.Twig.FontAwesomeIcon';
	}
}
