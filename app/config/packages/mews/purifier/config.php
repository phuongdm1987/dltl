<?php

/*
 * This file is part of HTMLPurifier Bundle.
 * (c) 2012 Maxime Dizerens
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array(
	'encoding' => 'UTF-8',
    'finalize' => true,
    'preload'  => false,
    'settings' => array(
        'default' => array(
            'HTML.Doctype'             => 'XHTML 1.0 Strict',
            'HTML.Allowed'             => 'div,b,strong,i,em,a[href|title],ul,ol,li,p[style|class],br,span[style|class],img[width|height|alt|src],h1,h2,h3,h4,h5,h6',
            'CSS.AllowedProperties'    => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty'   => true,
        ),
    ),
);
