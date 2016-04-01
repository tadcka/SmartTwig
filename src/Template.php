<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\SmartTwig;

use Twig_Template as TwigTemplate;

/**
 * Class Template.
 * 
 * @package Tadcka\SmartTwig
 */
abstract class Template extends TwigTemplate
{
    /**
     * Render template with a given context and adds template and parent template name to output.
     *
     * @param array $context
     *
     * @return string
     */
    public function render(array $context)
    {
        $templateContent = parent::render($context);
        $templateJson = json_decode($templateContent);

        if (is_object($templateJson)) {
            $templateJson->template_name = $this->getTemplateName();

            if (false == empty($templateJson->content)) {
                $templateJson->content = $this->wrapContent($templateJson->content, true);
            }

            return json_encode($templateJson);
        }

        return $this->wrapContent($templateContent);
    }

    /**
     * Wraps content into additional HTML comment tags with template name information.
     *
     * @param string $content
     * @param bool $forced
     *
     * @return string
     */
    protected function wrapContent($content, $forced = false)
    {
        if (false === $this->canWrapContent($forced)) {
            return $content;
        }

        $wrapContent = '<!-- Start Template: ' . $this->getTemplateName();

        if ($this->parent) {
            $wrapContent .= ' (Parent Template: ' . $this->parent->getTemplateName(). ')';
        }

        $wrapContent .= " -->\n";
        $wrapContent .= $content;
        $wrapContent .= '<!-- End Template: ' . $this->getTemplateName() . ' -->';

        return $wrapContent;
    }

    /**
     * @param bool $forced
     *
     * @return bool
     */
    protected function canWrapContent($forced)
    {
        return $forced || ('.html.twig' === substr($this->getTemplateName(), -10));
    }
}
