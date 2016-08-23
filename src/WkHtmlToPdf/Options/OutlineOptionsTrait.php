<?php

namespace WkHtmlToPdf\Options;

use WkHtmlToPdf\WkHtmlToPdf;

/**
 * Outline options trait.
 *
 * @author ivanpepelko
 */
trait OutlineOptionsTrait
{
    /**
     * Dump the outline to a file.
     *
     * @param string $file
     *
     * @return WkHtmlToPdf
     */
    public function setDumpOutline($file)
    {
        $this->arguments['dump-outline'] = $file;

        return $this;
    }

    /**
     * Put an outline into the pdf (default).
     *
     * @return WkHtmlToPdf
     */
    public function enableOutline()
    {
        if (array_key_exists('no-outline', $this->arguments)) {
            unset($this->arguments['no-outline']);
        }
        $this->arguments['outline'] = null;

        return $this;
    }

    /**
     * Do not put an outline into the pdf.
     *
     * @return WkHtmlToPdf
     */
    public function disableOutline()
    {
        if (array_key_exists('outline', $this->arguments)) {
            unset($this->arguments['outline']);
        }
        $this->arguments['no-outline'] = null;

        return $this;
    }

    /**
     * Set the depth of the outline (default 4).
     *
     * @param int $level
     *
     * @return WkHtmlToPdf
     */
    public function setOutline($level = 4)
    {
        $this->arguments['outline-depth'] = $level;

        return $this;
    }
}
