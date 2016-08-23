<?php

namespace WkHtmlToPdf\Options;

use WkHtmlToPdf\WkHtmlToPdf;

/**
 * @author ivanpepelko
 */
trait TocOptionsTrait
{
    /**
     * Do not use dotted lines in the toc.
     *
     * @return WkHtmlToPdf
     */
    public function disableTocDottedLines()
    {
        $this->arguments['disable-dotted-lines'] = null;

        return $this;
    }

    /**
     * Use dotted lines in the toc (if dotted lines are present in html).
     *
     * @return WkHtmlToPdf
     */
    public function enableTocDottedLines()
    {
        if (array_key_exists('disable-dotted-lines', $this->arguments)) {
            unset($this->arguments['disable-dotted-lines']);
        }

        return $this;
    }

    /**
     * The header text of the toc (default 'Table of Contents').
     *
     * @param string $text
     *
     * @return WkHtmlToPdf
     */
    public function setTocHeaderText($text = 'Table of Contents')
    {
        $this->arguments['toc-header-text'] = $text;

        return $this;
    }

    /**
     * For each level of headings in the toc indent by this length (default 1em).
     *
     * @param string $width
     *
     * @return WkHtmlToPdf
     */
    public function setTocLevelIndentation($width = '1em')
    {
        $this->arguments['toc-level-indentation'] = $width;

        return $this;
    }

    /**
     * Do not link from toc to sections.
     *
     * @return WkHtmlToPdf
     */
    public function disableTocLinks()
    {
        $this->arguments['disable-toc-links'] = null;

        return $this;
    }

    /**
     * Link from toc to sections (only if it was disabled by disableTocLinks()).
     *
     * @return WkHtmlToPdf
     */
    public function enableTocLinks()
    {
        if (array_key_exists('disable-toc-links', $this->arguments)) {
            unset($this->arguments['disable-toc-links']);
        }

        return $this;
    }

    /**
     * For each level of headings in the toc the font is scaled by this factor (default 0.8).
     *
     * @param float $factor
     *
     * @return WkHtmlToPdf
     */
    public function setTocTextSizeShrinking($factor = 0.8)
    {
        $this->arguments['toc-text-size-shrink'] = $factor;

        return $this;
    }

    /**
     * Use the supplied xsl style sheet for printing the table of content.
     *
     * @param string $path Path to xsl style sheet
     *
     * @return WkHtmlToPdf
     */
    public function setTocXslStyleSheet($path)
    {
        $this->arguments['xsl-style-sheet'] = $path;

        return $this;
    }
}
