<?php

namespace WkHtmlToPdf\Options;

use WkHtmlToPdf\WkHtmlToPdf;

/**
 * General wkhtmltopdf options.
 *
 * @author ivanpepelko
 */
trait GlobalOptionsTrait
{
    /**
     * Collate when printing multiple copies (default true).
     *
     * @return WkHtmlToPdf
     */
    public function enableCollate()
    {
        if (array_key_exists('no-collate', $this->arguments)) {
            unset($this->arguments['no-collate']);
        }
        $this->arguments['collate'] = null;

        return $this;
    }

    /**
     * Do not collate when printing multiple copies (default true).
     *
     * @return WkHtmlToPdf
     */
    public function disableCollate()
    {
        if (array_key_exists('collate', $this->arguments)) {
            unset($this->arguments['collate']);
        }
        $this->arguments['no-collate'] = null;

        return $this;
    }

    /**
     * Read and write cookies from and to the supplied cookie jar file.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function setCookieJar($path)
    {
        $this->arguments['cookie-jar'] = $path;

        return $this;
    }

    /**
     * Number of copies to print into the pdf file (default 1).
     *
     * @param int $number
     *
     * @return WkHtmlToPdf
     */
    public function setCopies($number = 1)
    {
        $this->arguments['copies'] = $number;

        return $this;
    }

    /**
     * Change the dpi explicitly (this has no effect on X11 based systems).
     *
     * @param int $dpi
     *
     * @return WkHtmlToPdf
     */
    public function setDpi($dpi)
    {
        $this->arguments['dpi'] = $dpi;

        return $this;
    }

    /**
     * PDF will be generated in grayscale.
     *
     * @return WkHtmlToPdf
     */
    public function enableGrayscale()
    {
        if (!array_key_exists('grayscale', $this->arguments)) {
            $this->arguments['grayscale'] = null;
        }
    }

    /**
     * PDF will not be generated in grayscale.
     *
     * @return WkHtmlToPdf
     */
    public function disableGrayscale()
    {
        if (array_key_exists('grayscale', $this->arguments)) {
            unset($this->arguments['grayscale']);
        }

        return $this;
    }

    /**
     * When embedding images scale them down to this dpi (default 600).
     *
     * @param int $imageDpi
     *
     * @return WkHtmlToPdf
     */
    public function setImageDpi($imageDpi = 600)
    {
        $this->arguments['image-dpi'] = $imageDpi;

        return $this;
    }

    /**
     * When jpeg compressing images use this quality (default 94).
     *
     * @param int $imageQuality
     *
     * @return WkHtmlToPdf
     */
    public function setImageQuality($imageQuality = 94)
    {
        $this->arguments['image-quality'] = $imageQuality;

        return $this;
    }

    /**
     * Generates lower quality pdf/ps. Useful to shrink the result document space.
     *
     * @return WkHtmlToPdf
     */
    public function enableLowQuality()
    {
        if (!array_key_exists('lowquality', $this->arguments)) {
            $this->arguments['lowquality'] = null;
        }

        return $this;
    }

    /**
     * Disable lower quality pdf/ps.
     *
     * @return WkHtmlToPdf
     */
    public function disableLowQuality()
    {
        if (array_key_exists('lowquality', $this->arguments)) {
            unset($this->arguments['lowquality']);
        }

        return $this;
    }

    /**
     * Set the page bottom margin.
     *
     * @param string $marginBottom
     *
     * @return WkHtmlToPdf
     */
    public function setMarginBottom($marginBottom)
    {
        $this->arguments['margin-bottom'] = $marginBottom;

        return $this;
    }

    /**
     * Set the page left margin (default 10mm).
     *
     * @param string $marginLeft
     *
     * @return WkHtmlToPdf
     */
    public function setMarginLeft($marginLeft)
    {
        $this->arguments['margin-left'] = $marginLeft;

        return $this;
    }

    /**
     * Set the page right margin (default 10mm).
     *
     * @param string $marginRight
     *
     * @return WkHtmlToPdf
     */
    public function setMarginRight($marginRight)
    {
        $this->arguments['margin-right'] = $marginRight;

        return $this;
    }

    /**
     * Set the page top margin.
     *
     * @param string $marginTop
     *
     * @return WkHtmlToPdf
     */
    public function setMarginTop($marginTop)
    {
        $this->arguments['margin-top'] = $marginTop;

        return $this;
    }

    /**
     * Set all margins.
     *
     * @param string $marginTop
     * @param string $marginRight
     * @param string $marginBottom
     * @param string $marginLeft
     *
     * @return WkHtmlToPdf
     */
    public function setMargins($marginTop, $marginRight, $marginBottom, $marginLeft)
    {
        $this->arguments['margin-top'] = $marginTop;
        $this->arguments['margin-right'] = $marginRight;
        $this->arguments['margin-bottom'] = $marginBottom;
        $this->arguments['margin-left'] = $marginLeft;

        return $this;
    }

    /**
     * Set all margins to same size.
     *
     * @param type $margin
     *
     * @return WkHtmlToPdf
     */
    public function setMarginsAll($margin)
    {
        $this->arguments['margin-top'] = $margin;
        $this->arguments['margin-right'] = $margin;
        $this->arguments['margin-bottom'] = $margin;
        $this->arguments['margin-left'] = $margin;

        return $this;
    }

    /**
     * Set orientation to Landscape or Portrait (or P|L, default Portrait).
     *
     * @param string $orientation
     *
     * @return WkHtmlToPdf
     */
    public function setOrientation($orientation = 'Portrait')
    {
        if ('P' === $orientation) {
            $orientation = 'Portrait';
        }

        if ('L' === $orientation) {
            $orientation = 'Landscape';
        }

        $this->arguments['orientation'] = ucfirst($orientation);

        return $this;
    }

    /**
     * Set page height.
     *
     * @param string $pageHeight
     *
     * @return WkHtmlToPdf
     */
    public function setPageHeight($pageHeight)
    {
        $this->arguments['page-height'] = $pageHeight;

        return $this;
    }

    /**
     * Set page width.
     *
     * @param string $pageWidth
     *
     * @return WkHtmlToPdf
     */
    public function setPageWidth($pageWidth)
    {
        $this->arguments['page-width'] = $pageWidth;

        return $this;
    }

    /**
     * Set paper size to: A4, Letter, etc. (default A4).
     *
     * @param string $pageSize
     *
     * @return WkHtmlToPdf
     */
    public function setPageSize($pageSize = 'A4')
    {
        $this->arguments['page-size'] = $pageSize;

        return $this;
    }

    /**
     * Use lossless compression on pdf objects.
     *
     * @return WkHtmlToPdf
     */
    public function enablePdfCompression()
    {
        if (array_key_exists('no-pdf-compression', $this->arguments)) {
            unset($this->arguments['no-pdf-compression']);
        }

        return $this;
    }

    /**
     * Disable using of lossless compression on pdf objects.
     *
     * @return WkHtmlToPdf
     */
    public function disablePdfCompression()
    {
        if (!array_key_exists('no-pdf-compression', $this->arguments)) {
            $this->arguments['no-pdf-compression'] = null;
        }

        return $this;
    }

    /**
     * The title of the generated pdf file (The title of the first document is used if not specified).
     *
     * @param string $title
     *
     * @return WkHtmlToPdf
     */
    public function setTitle($title)
    {
        $this->arguments['title'] = $title;

        return $this;
    }

    /**
     * Alias of setTitle.
     *
     * @param string $title
     *
     * @return WkHtmlToPdf
     */
    public function setDocumentTitle($title)
    {
        $this->arguments['title'] = $title;

        return $this;
    }

    /**
     * Use the X server (some plugins and other stuff might not work without X11).
     *
     * @return WkHtmlToPdf
     */
    public function enableXserver()
    {
        if (!array_key_exists('use-xserver', $this->arguments)) {
            $this->arguments['use-xserver'] = null;
        }

        return $this;
    }

    /**
     * Do not use the X server (some plugins and other stuff might not work without X11).
     *
     * @return WkHtmlToPdf
     */
    public function disableXserver()
    {
        if (array_key_exists('use-xserver', $this->arguments)) {
            unset($this->arguments['use-xserver']);
        }

        return $this;
    }
}
