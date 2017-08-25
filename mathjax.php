<?php

/**
 * @package     JCE
 * @subpackage  System.jce
 *
 * @copyright   Copyright (C) 2015 Ryan Demmer. All rights reserved.
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
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
class PlgSystemMathJax extends JPlugin
{
	public function onAfterRoute()
	{
		$app = JFactory::getApplication();

        if ($app->isAdmin()) {
            return;
        }
		
		$document 	= JFactory::getDocument();
		
		$options 	= $this->params->get('math_jax_options', 'TeX,MML,AM_CHTML');
		
		$document->addScript('https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=' . str_replace(',', '-', $options));
		
		$config = "MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});";
		
		$document->addScriptDeclaration($config, 'text/x-mathjax-config');
	}
}
