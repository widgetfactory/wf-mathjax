<?php

/**
 * @package     MathJax
 * @subpackage  System.wf_mathjax
 *
 * @copyright   Copyright (C) 2018 Ryan Demmer. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */
defined('JPATH_BASE') or die;

/**
 * JCE
 *
 * @package     JCE
 * @subpackage  System.jce
 * @since       2.5.5
 */
class PlgSystemWf_Mathjax extends JPlugin
{
	public function onAfterRoute()
	{
		$app = JFactory::getApplication();

		if ($app->isAdmin()) {
		    return;
		}
		
		$document = JFactory::getDocument();
		
		$options 	= $this->params->get('mathjax_options', 'TeX,MML,AM_CHTML');
		$delim 		= $this->params->get('mathjax_delimiter', '$ $');
		
		// array of inline delimiter options
		$delim = explode(',', $delim);
		
		// process individual delimiters
		array_walk($delim, function(&$item) {
			$item = explode(' ', trim($item));
		});
		
		$document->addScript('https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=' . str_replace(',', '-', $options));
		
		$data = array(
			'tex2jax' => array(
				'inlineMath' => $delim
			)
		);
		
		$config = "MathJax.Hub.Config(" . json_encode($data) . ");";
		
		$document->addScriptDeclaration($config, 'text/x-mathjax-config');
	}
}
