<?php

namespace WkHtmlToPdf\Options;

use WkHtmlToPdf\WkHtmlToPdf;

/**
 * @author ivanpepelko
 */
trait HeaderFooterOptionsTrait
{
    /**
     * Centered footer text.
     *
     * @param string $text
     *
     * @return WkHtmlToPdf
     */
    public function setFooterCenterText($text)
    {
        $this->arguments['footer-center'] = $text;

        return $this;
    }

    /**
     * Set footer font name (default Arial).
     *
     * @param string $name
     *
     * @return WkHtmlToPdf
     */
    public function setFooterFontName($name = 'Arial')
    {
        $this->arguments['footer-font-name'] = $name;

        return $this;
    }

    /**
     * Set footer font size (default 12).
     *
     * @param int $size
     *
     * @return WkHtmlToPdf
     */
    public function setFooterFontSize($size = 12)
    {
        $this->arguments['footer-font-size'] = intval($size);

        return $this;
    }

    /**
     * Adds a html footer.
     *
     * @param string $html
     *
     * @return WkHtmlToPdf
     */
    public function setFooterHtml($html)
    {
        $tmpFile = join_path($this->tmpDir, md5(time()) . '.html');
        file_put_contents($tmpFile, $html);

        $this->arguments['footer-html'] = $tmpFile;

        return $this;
    }

    /**
     * Adds a html footer.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function setFooterHtmlPath($path)
    {
        $this->arguments['footer-html'] = $path;

        return $this;
    }

    /**
     * Left aligned footer text.
     *
     * @param string $text
     *
     * @return WkHtmlToPdf
     */
    public function setFooterLeftText($text)
    {
        $this->arguments['footer-left'] = $text;

        return $this;
    }

    /**
     * Display line above the footer.
     *
     * @return WkHtmlToPdf
     */
    public function enableFooterLine()
    {
        if (array_key_exists('no-footer-line', $this->arguments)) {
            unset($this->arguments['no-footer-line']);
        }
        $this->arguments['footer-line'] = null;

        return $this;
    }

    /**
     * Do not display line above the footer.
     *
     * @return WkHtmlToPdf
     */
    public function disableFooterLine()
    {
        if (array_key_exists('footer-line', $this->arguments)) {
            unset($this->arguments['footer-line']);
        }
        $this->arguments['no-footer-line'] = null;

        return $this;
    }

    /**
     * Right aligned footer text.
     *
     * @param string $text
     *
     * @return WkHtmlToPdf
     */
    public function setFooterRightText($text)
    {
        $this->arguments['footer-right'] = $text;

        return $this;
    }

    /**
     * Spacing between footer and content in mm (default 0).
     *
     * @param float $spacing
     *
     * @return WkHtmlToPdf
     */
    public function setFooterSpacing($spacing = 0)
    {
        $this->arguments['footer-spacing'] = $spacing;

        return $this;
    }

    /**
     * Centered header text.
     *
     * @param string $text
     *
     * @return WkHtmlToPdf
     */
    public function setHeaderCenterText($text)
    {
        $this->arguments['header-center'] = $text;

        return $this;
    }

    /**
     * Set header font name (default Arial).
     *
     * @param string $name
     *
     * @return WkHtmlToPdf
     */
    public function setHeaderFontName($name = 'Arial')
    {
        $this->arguments['header-font-name'] = $name;

        return $this;
    }

    /**
     * Set header font size (default 12).
     *
     * @param int $size
     *
     * @return WkHtmlToPdf
     */
    public function setHeaderFontSize($size = 12)
    {
        $this->arguments['header-font-size'] = intval($size);

        return $this;
    }

    /**
     * Adds a html header.
     *
     * @param string $html
     *
     * @return WkHtmlToPdf
     */
    public function setHeaderHtml($html)
    {
        $tmpFile = join_path($this->tmpDir, md5(time()) . '.html');
        file_put_contents($tmpFile, $html);

        $this->arguments['header-html'] = $tmpFile;

        return $this;
    }

    /**
     * Adds a html header.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function setHeaderHtmlPath($path)
    {
        $this->arguments['header-html'] = $path;

        return $this;
    }

    /**
     * Left aligned header text.
     *
     * @param string $text
     *
     * @return WkHtmlToPdf
     */
    public function setHeaderLeftText($text)
    {
        $this->arguments['header-left'] = $text;

        return $this;
    }

    /**
     * Display line above the header.
     *
     * @return WkHtmlToPdf
     */
    public function enableHeaderLine()
    {
        if (array_key_exists('no-header-line', $this->arguments)) {
            unset($this->arguments['no-header-line']);
        }
        $this->arguments['header-line'] = null;

        return $this;
    }

    /**
     * Do not display line above the header.
     *
     * @return WkHtmlToPdf
     */
    public function disableHeaderLine()
    {
        if (array_key_exists('header-line', $this->arguments)) {
            unset($this->arguments['header-line']);
        }
        $this->arguments['no-header-line'] = null;

        return $this;
    }

    /**
     * Right aligned header text.
     *
     * @param string $text
     *
     * @return WkHtmlToPdf
     */
    public function setHeaderRightText($text)
    {
        $this->arguments['header-right'] = $text;

        return $this;
    }

    /**
     * Spacing between header and content in mm (default 0).
     *
     * @param float $spacing
     *
     * @return WkHtmlToPdf
     */
    public function setHeaderSpacing($spacing = 0)
    {
        $this->arguments['header-spacing'] = $spacing;

        return $this;
    }

    /**
     * Add custom value to be replaced in header/footer (--replace argument).
     *
     * @param string $name
     * @param string $value
     *
     * @return WkHtmlToPdf
     */
    public function addHeaderFooterVar($name, $value)
    {
        $this->arguments['replace'][$name] = $value;

        return $this;
    }

    /**
     * Add custom values to be replaced in header/footer (--replace argument).
     *
     * @param array $vars
     *
     * @return WkHtmlToPdf
     */
    public function addHeaderFooterVars(array $vars)
    {
        foreach ($vars as $name => $value) {
            $this->arguments['replace'][$name] = $value;
        }

        return $this;
    }
}
