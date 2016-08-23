<?php

namespace WkHtmlToPdf\Options;

use WkHtmlToPdf\WkHtmlToPdf;

/**
 * Page options trait.
 *
 * @author ivanpepelko
 */
trait PageOptionsTrait
{
    /**
     * Show javascript debugging output (only when constructor param $debug == true).
     *
     * @return WkHtmlToPdf
     */
    public function enableJavascriptDebugging()
    {
        if (array_key_exists('no-debug-javascript', $this->arguments)) {
            unset($this->arguments ['no-debug-javascript']);
        }
        $this->arguments['debug-javascript'] = null;

        return $this;
    }

    /**
     * Do not show javascript debugging output (only when constructor param $debug == true).
     *
     * @return WkHtmlToPdf
     */
    public function disableJavascriptDebugging()
    {
        if (array_key_exists('debug-javascript', $this->arguments)) {
            unset($this->arguments ['debug-javascript']);
        }
        $this->arguments['no-debug-javascript'] = null;

        return $this;
    }

    /**
     * Do print background (default).
     *
     * @return WkHtmlToPdf
     */
    public function enableBackground()
    {
        if (array_key_exists('no-background', $this->arguments)) {
            unset($this->arguments['no-background']);
        }
        $this->arguments['background'] = null;

        return $this;
    }

    /**
     * Do not print background.
     *
     * @return WkHtmlToPdf
     */
    public function disableBackground()
    {
        if (array_key_exists('background', $this->arguments)) {
            unset($this->arguments['background']);
        }
        $this->arguments['no-background'] = null;

        return $this;
    }

    /**
     * Set web cache directory.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function setCacheDir($path)
    {
        $this->arguments['cache-dir'] = $path;

        return $this;
    }

    /**
     * Use this SVG file when rendering checked checkboxes.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function setCheckboxCheckedSvg($path)
    {
        $this->arguments['checkbox-checked-svg'] = $path;

        return $this;
    }

    /**
     * Use this SVG file when rendering unchecked checkboxes.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function setCheckboxUncheckedSvg($path)
    {
        $this->arguments['checkbox-svg'] = $path;

        return $this;
    }

    /**
     * Use this SVG file when rendering checked radiobuttons.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function setRadiobuttonCheckedSvg($path)
    {
        $this->arguments['radiobutton-checked-svg'] = $path;

        return $this;
    }

    /**
     * Use this SVG file when rendering unchecked radiobuttons.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function setRadiobuttonUncheckedSvg($path)
    {
        $this->arguments['radiobutton-svg'] = $path;

        return $this;
    }

    /**
     * Set an additional cookie.
     *
     * @param string $name
     * @param string $value
     *
     * @return WkHtmlToPdf
     */
    public function addCookie($name, $value)
    {
        $this->arguments['cookie'][$name] = urlencode($value);

        return $this;
    }

    /**
     * Set additional cookies.
     *
     * @param array $cookies
     *
     * @return WkHtmlToPdf
     */
    public function addCookies(array $cookies)
    {
        foreach ($cookies as $name => $value) {
            $this->arguments['cookie'][$name] = urlencode($value);
        }

        return $this;
    }

    /**
     * Set an additional HTTP header.
     *
     * @param string $name
     * @param string $value
     *
     * @return WkHtmlToPdf
     */
    public function addCustomHttpHeader($name, $value)
    {
        $this->arguments['custom-header'][$name] = $value;

        return $this;
    }

    /**
     * Set additional HTTP headers.
     *
     * @param array $headers
     *
     * @return WkHtmlToPdf
     */
    public function addCustomHttpHeaders(array $headers)
    {
        foreach ($headers as $name => $value) {
            $this->arguments['custom-header'][$name] = $value;
        }

        return $this;
    }

    /**
     * Add HTTP headers specified by addCustomHeader() for each resource request.
     *
     * @return WkHtmlToPdf
     */
    public function enableCustomHttpHeaderPropagination()
    {
        if (array_key_exists('no-custom-header-propagination', $this->arguments)) {
            unset($this->arguments['no-custom-header-propagination']);
        }
        $this->arguments['custom-header-propagation'] = null;

        return $this;
    }

    /**
     * Do not add HTTP headers specified by addCustomHeader() for each resource request.
     *
     * @return WkHtmlToPdf
     */
    public function disableCustomHttpHeaderPropagination()
    {
        if (array_key_exists('custom-header-propagination', $this->arguments)) {
            unset($this->arguments['custom-header-propagination']);
        }
        $this->arguments['no-custom-header-propagation'] = null;

        return $this;
    }

    /**
     * Add a default header, with the name of the page to the left,
     * and the page number to the right,
     * this is short for:
     * setHeaderLeft('[webpage]'),
     * setHeaderRight('[page]/[toPage]'),
     * setMarginTop('2cm'),
     * enableHeaderLine().
     *
     * @return WkHtmlToPdf
     */
    public function addDefaultHeader()
    {
        $this->arguments['default-header'] = null;

        return $this;
    }

    /**
     * Set the default text encoding, for input.
     *
     * @param string $encoding
     *
     * @return WkHtmlToPdf
     */
    public function setEncoding($encoding)
    {
        $this->arguments['encoding'] = $encoding;

        return $this;
    }

    /**
     * Do not make links to remote web pages.
     *
     * @return WkHtmlToPdf
     */
    public function disableExternalLinks()
    {
        if (array_key_exists('enable-external-links', $this->arguments)) {
            unset($this->arguments['enable-external-links']);
        }
        $this->arguments['disable-external-links'] = null;

        return $this;
    }

    /**
     * Make links to remote web pages (default).
     *
     * @return WkHtmlToPdf
     */
    public function enableExternalLinks()
    {
        if (array_key_exists('disable-external-links', $this->arguments)) {
            unset($this->arguments['disable-external-links']);
        }
        $this->arguments['enable-external-links'] = null;

        return $this;
    }

    /**
     * Do not turn HTML form fields into pdf form fields (default).
     *
     * @return WkHtmlToPdf
     */
    public function disableForms()
    {
        if (array_key_exists('enable-forms', $this->arguments)) {
            unset($this->arguments['enable-forms']);
        }
        $this->arguments['disable-forms'] = null;

        return $this;
    }

    /**
     * Turn HTML form fields into pdf form fields.
     *
     * @return WkHtmlToPdf
     */
    public function enableForms()
    {
        if (array_key_exists('disable-forms', $this->arguments)) {
            unset($this->arguments['disable-forms']);
        }
        $this->arguments['enable-forms'] = null;

        return $this;
    }

    /**
     * Do load or print images (default).
     *
     * @return WkHtmlToPdf
     */
    public function disableImages()
    {
        if (array_key_exists('images', $this->arguments)) {
            unset($this->arguments['images']);
        }
        $this->arguments['no-images'] = null;

        return $this;
    }

    /**
     * Do not load or print images.
     *
     * @return WkHtmlToPdf
     */
    public function enableImages()
    {
        if (array_key_exists('no-images', $this->arguments)) {
            unset($this->arguments['no-images']);
        }
        $this->arguments['images'] = null;

        return $this;
    }

    /**
     * Do not make local links.
     *
     * @return WkHtmlToPdf
     */
    public function disableInternalLinks()
    {
        if (array_key_exists('enable-internal-links', $this->arguments)) {
            unset($this->arguments['enable-internal-links']);
        }
        $this->arguments['disable-internal-links'] = null;

        return $this;
    }

    /**
     * Make local links (default).
     *
     * @return WkHtmlToPdf
     */
    public function enableInternalLinks()
    {
        if (array_key_exists('disable-internal-links', $this->arguments)) {
            unset($this->arguments['disable-internal-links']);
        }
        $this->arguments['enable-internal-links'] = null;

        return $this;
    }

    /**
     * Do not allow web pages to run javascript.
     *
     * @return WkHtmlToPdf
     */
    public function disableJavascript()
    {
        if (array_key_exists('enable-javascript', $this->arguments)) {
            unset($this->arguments['enable-javascript']);
        }
        $this->arguments['disable-javascript'] = null;

        return $this;
    }

    /**
     * Do allow web pages to run javascript (default).
     *
     * @return WkHtmlToPdf
     */
    public function enableJavascript()
    {
        if (array_key_exists('disable-javascript', $this->arguments)) {
            unset($this->arguments['disable-javascript']);
        }
        $this->arguments['enable-javascript'] = null;

        return $this;
    }

    /**
     * Wait some milliseconds for javascript finish (default 200).
     *
     * @param int $msec
     *
     * @return WkHtmlToPdf
     */
    public function setJavascriptDelay($msec = 200)
    {
        $this->arguments['javascript-delay'] = intval($msec);

        return $this;
    }

    /**
     * Disable installed plugins (default).
     *
     * @return WkHtmlToPdf
     */
    public function disablePlugins()
    {
        if (array_key_exists('enable-plugins', $this->arguments)) {
            unset($this->arguments['enable-plugins']);
        }
        $this->arguments['disable-plugins'] = null;

        return $this;
    }

    /**
     * Enable installed plugins (plugins will likely not work).
     *
     * @return WkHtmlToPdf
     */
    public function enablePlugins()
    {
        if (array_key_exists('disable-plugins', $this->arguments)) {
            unset($this->arguments['disable-plugins']);
        }
        $this->arguments['enable-plugins'] = null;

        return $this;
    }

    /**
     * Do not link from section header to toc (default).
     *
     * @return WkHtmlToPdf
     */
    public function disableTocBackLinks()
    {
        if (array_key_exists('enable-toc-back-links', $this->arguments)) {
            unset($this->arguments['enable-toc-back-links']);
        }
        $this->arguments['disable-toc-back-links'] = null;

        return $this;
    }

    /**
     * Link from section header to toc.
     *
     * @return WkHtmlToPdf
     */
    public function enableTocBackLinks()
    {
        if (array_key_exists('disable-toc-back-links', $this->arguments)) {
            unset($this->arguments['disable-toc-back-links']);
        }
        $this->arguments['enable-toc-back-links'] = null;

        return $this;
    }

    /**
     * Disable the intelligent shrinking strategy used by WebKit that makes the pixel/dpi ratio none constant.
     *
     * @return WkHtmlToPdf
     */
    public function disableSmartShrinking()
    {
        if (array_key_exists('enable-smart-shrinking', $this->arguments)) {
            unset($this->arguments['enable-smart-shrinking']);
        }
        $this->arguments['disable-smart-shrinking'] = null;

        return $this;
    }

    /**
     * Enable the intelligent shrinking strategy used by WebKit that makes the pixel/dpi ratio none constant (default).
     *
     * @return WkHtmlToPdf
     */
    public function enableSmartShrinking()
    {
        if (array_key_exists('disable-smart-shrinking', $this->arguments)) {
            unset($this->arguments['disable-smart-shrinking']);
        }
        $this->arguments['enable-smart-shrinking'] = null;

        return $this;
    }

    /**
     * Allow the file or files from the specified folder to be loaded.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function addAllowedPath($path)
    {
        $this->arguments['allow'][] = $path;

        return $this;
    }

    /**
     * Allow the file or files from the specified folders to be loaded.
     *
     * @param string[] $paths
     *
     * @return WkHtmlToPdf
     */
    public function addAllowedPaths(array $paths)
    {
        foreach ($paths as $path) {
            $this->arguments['allow'][] = $path;
        }

        return $this;
    }

    /**
     * Do not allowed conversion of a local file to read in other local files, unless explicitly allowed with allow().
     *
     * @return WkHtmlToPdf
     */
    public function disableLocalFileAccess()
    {
        if (array_key_exists('enable-local-file-access', $this->arguments)) {
            unset($this->arguments['enable-local-file-access']);
        }
        $this->arguments['disable-local-file-access'] = null;

        return $this;
    }

    /**
     * Allowed conversion of a local file to read in other local files. (default).
     *
     * @return WkHtmlToPdf
     */
    public function enableLocalFileAccess()
    {
        if (array_key_exists('disable-local-file-access', $this->arguments)) {
            unset($this->arguments['disable-local-file-access']);
        }
        $this->arguments['enable-local-file-access'] = null;

        return $this;
    }

    /**
     * Run this additional javascript after the page is done loading.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function addScript($path)
    {
        $this->arguments['run-script'][] = $path;

        return $this;
    }

    /**
     * Run this additional javascripts after the page is done loading.
     *
     * @param string[] $paths
     *
     * @return WkHtmlToPdf
     */
    public function addScripts(array $paths)
    {
        foreach ($paths as $path) {
            $this->arguments['run-script'][] = $path;
        }

        return $this;
    }

    /**
     * Keep relative external links as relative external links.
     *
     * @return WkHtmlToPdf
     */
    public function keepRelativeLinks()
    {
        if (array_key_exists('resolve-relative-links', $this->arguments)) {
            unset($this->arguments['resolve-relative-links']);
        }
        $this->arguments['keep-relative-links'] = null;

        return $this;
    }

    /**
     * Resolve relative external links into absolute links (default).
     *
     * @return WkHtmlToPdf
     */
    public function resolveRelativeLinks()
    {
        if (array_key_exists('keep-relative-links', $this->arguments)) {
            unset($this->arguments['keep-relative-links']);
        }
        $this->arguments['resolve-relative-links'] = null;

        return $this;
    }

    /**
     * Specify how to handle pages that fail to load: abort, ignore or skip (default abort).
     *
     * @param string $handler
     *
     * @return WkHtmlToPdf
     */
    public function setLoadErrorHandling($handler)
    {
        $this->arguments['load-error-handling'] = $handler;

        return $this;
    }

    /**
     * Specify how to handle media files that fail to load: abort, ignore or skip (default ignore).
     *
     * @param string $handler
     *
     * @return WkHtmlToPdf
     */
    public function setLoadMediaErrorHandling($handler)
    {
        $this->arguments['load-media-error-handling'] = $handler;

        return $this;
    }

    /**
     * Minimum font size.
     *
     * @param int $size
     *
     * @return WkHtmlToPdf
     */
    public function setMinimumFontSize($size)
    {
        $this->arguments['minimum-font-size'] = intval($size);

        return $this;
    }

    /**
     * Set the starting page number (default 0).
     *
     * @param int $offset
     *
     * @return WkHtmlToPdf
     */
    public function setPageOffset($offset = 0)
    {
        $this->arguments['page-offset'] = intval($offset);

        return $this;
    }

    /**
     * Use print media-type instead of screen.
     *
     * @return WkHtmlToPdf
     */
    public function enablePrintMediaType()
    {
        if (!$this->isQtPatched) {
            if (array_key_exists('no-print-media-type', $this->arguments)) {
                unset($this->arguments['no-print-media-type']);
            }
            $this->arguments['print-media-type'] = null;
        } else {
            trigger_error('Print media arguments are not supported on wkhtmltopdf with unpatched qt.', E_USER_WARNING);
        }

        return $this;
    }

    /**
     * Do not use print media-type instead of screen (default).
     *
     * @return WkHtmlToPdf
     */
    public function disablePrintMediaType()
    {
        if (!$this->isQtPatched) {
            if (array_key_exists('print-media-type', $this->arguments)) {
                unset($this->arguments['print-media-type']);
            }
            $this->arguments['no-print-media-type'] = null;
        } else {
            trigger_error('Print media arguments are not supported by wkhtmltopdf with unpatched qt.', E_USER_WARNING);
        }

        return $this;
    }

    /**
     * Set viewport size if you have custom scrollbars or css attribute overflow to emulate window size.
     *
     * @param string $size hxw, in pixels
     *
     * @return WkHtmlToPdf
     */
    public function setViewportSize($size)
    {
        $this->arguments['viewport-size'] = $size;

        return $this;
    }

    /**
     * Use this zoom factor (default 1).
     *
     * @param float $zoom
     *
     * @return WkHtmlToPdf
     */
    public function setZoom($zoom = 1.0)
    {
        $this->arguments['zoom'] = $zoom;

        return $this;
    }

    /**
     * Do not Stop slow running javascripts.
     *
     * @return WkHtmlToPdf
     */
    public function enableSlowScripts()
    {
        if (array_key_exists('stop-slow-scripts', $this->arguments)) {
            unset($this->arguments['stop-slow-scripts']);
        }
        $this->arguments['no-stop-slow-scripts'] = null;

        return $this;
    }

    /**
     * Stop slow running javascripts (default).
     *
     * @return WkHtmlToPdf
     */
    public function disableSlowScripts()
    {
        if (array_key_exists('no-stop-slow-scripts', $this->arguments)) {
            unset($this->arguments['no-stop-slow-scripts']);
        }
        $this->arguments['stop-slow-scripts'] = null;

        return $this;
    }

    /**
     * Add an additional post field.
     *
     * @param string $name
     * @param string $value
     *
     * @return WkHtmlToPdf
     */
    public function addHttpPostField($name, $value)
    {
        $this->arguments['post'][$name] = $value;

        return $this;
    }

    /**
     * Add an additional post fields.
     *
     * @param string[] $fields
     *
     * @return WkHtmlToPdf
     */
    public function addHttpPostFields(array $fields)
    {
        foreach ($fields as $name => $value) {
            $this->arguments['post'][$name] = $value;
        }

        return $this;
    }

    /**
     * Add an additional post file.
     *
     * @param string $name
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function addHttpPostFile($name, $path)
    {
        $this->arguments['post'][$name] = $path;

        return $this;
    }

    /**
     * Add an additional post files.
     *
     * @param string[] $files
     *
     * @return WkHtmlToPdf
     */
    public function addHttpPostFiles(array $files)
    {
        foreach ($files as $name => $path) {
            $this->arguments['post'][$name] = $path;
        }

        return $this;
    }

    /**
     * Specify a user style sheet, to load with every page.
     *
     * @param string $url
     *
     * @return WkHtmlToPdf
     */
    public function setUserStyleSheet($url)
    {
        $this->arguments['user-style-sheet'] = $url;

        return $this;
    }

    /**
     * HTTP Authentication username.
     *
     * @param string $username
     *
     * @return WkHtmlToPdf
     */
    public function setHttpAuthUsername($username)
    {
        $this->arguments['username'] = $username;

        return $this;
    }

    /**
     * HTTP Authentication password.
     *
     * @param string $password
     *
     * @return WkHtmlToPdf
     */
    public function setHttpAuthPassword($password)
    {
        $this->arguments['password'] = $password;

        return $this;
    }

    /**
     * Use a proxy.
     *
     * @param string $proxy
     *
     * @return Wkh2ps
     */
    public function setProxy($proxy)
    {
        $this->arguments['proxy'] = $proxy;

        return $this;
    }

    /**
     * Wait until window.status is equal to this string before rendering page.
     *
     * @param string $windowStatus
     *
     * @return WkHtmlToPdf
     */
    public function waitWindowStatus($windowStatus)
    {
        $this->arguments['window-status'] = $windowStatus;

        return $this;
    }

    /**
     * Bypass proxy for host (repeatable).
     *
     * @param string $value
     *
     * @return WkHtmlToPdf
     */
    public function setBypassProxy($value)
    {
        $this->arguments['bypass-proxy-for'] = $value;

        return $this;
    }

    /**
     * Do not include the page in the table of contents and outlines.
     *
     * @return WkHtmlToPdf
     */
    public function excludeFromOutline()
    {
        if (array_key_exists('include-in-outline', $this->arguments)) {
            unset($this->arguments['include-in-outline']);
        }
        $this->arguments['exclude-from-outline'] = null;

        return $this;
    }

    /**
     * Include the page in the table of contents and outlines (default).
     *
     * @return WkHtmlToPdf
     */
    public function includeInOutline()
    {
        if (array_key_exists('exclude-from-outline', $this->arguments)) {
            unset($this->arguments['exclude-from-outline']);
        }
        $this->arguments['include-in-outline'] = null;

        return $this;
    }
}
