<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\SmartTwig\Tests\Fixtures\Template;

use Tadcka\SmartTwig\Template;

/**
 * Class JSONTemplate.
 * 
 * @package Tadcka\SmartTwig\Tests\Fixtures\Template
 */
class JSONTemplate extends Template
{
    /**
     * {@inheritdoc}
     */
    public function getTemplateName()
    {
        return 'template.json.twig';
    }

    /**
     * {@inheritdoc}
     */
    protected function doDisplay(array $context, array $blocks = array())
    {
        echo json_encode(array('content' => "<p>test</p>\n"));
    }
}
