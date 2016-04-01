<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\SmartTwig\Tests;

use PHPUnit_Framework_TestCase as TestCase;
use Tadcka\SmartTwig\Tests\Fixtures\Template\HTMLTemplate;
use Tadcka\SmartTwig\Tests\Fixtures\Template\JSONTemplate;
use Tadcka\SmartTwig\Tests\Fixtures\Template\JSTemplate;
use Twig_Environment as Enviroment;

/**
 * Class TemplateTest.
 *
 * @package Tadcka\SmartTwig\Tests
 */
class TemplateTest extends TestCase
{
    public function testHtmlRender()
    {
        $template = new HTMLTemplate(new Enviroment());
        $output = $template->render([]);

        $this->assertContains('<!-- Start Template: template.html.twig -->', $output);
        $this->assertContains('<p>test string</p>', $output);
        $this->assertContains('<!-- End Template: template.html.twig -->', $output);
    }

    public function testJsonRender()
    {
        $template = new JSONTemplate(new Enviroment());
        $output = $template->render([]);
        $output = json_decode($output);

        $this->assertEquals('template.json.twig', $output->template_name);
        $this->assertContains('<!-- Start Template: template.json.twig -->', $output->content);
        $this->assertContains('<p>test</p>', $output->content);
        $this->assertContains('<!-- End Template: template.json.twig -->', $output->content);
    }

    public function testJsRender()
    {
        $template = new JSTemplate(new Enviroment());
        $output = $template->render(array());

        $this->assertNotContains('<!-- Start Template:', $output);
        $this->assertContains('"test"', $output);
    }
}
