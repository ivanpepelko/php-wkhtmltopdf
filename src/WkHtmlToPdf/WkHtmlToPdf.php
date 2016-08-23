<?php

namespace WkHtmlToPdf;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Description of Wkp2p.
 *
 * @author ivanpepelko
 */
class WkHtmlToPdf
{
    use Options\GlobalOptionsTrait,
        Options\OutlineOptionsTrait,
        Options\PageOptionsTrait,
        Options\HeaderFooterOptionsTrait,
        Options\TocOptionsTrait;

    private $processBuilder = null;
    private $isQtPatched;
    private $arguments = [];
    private $inputPath;
    private $outputPath;
    private $isPrefetchEnabled = false;
    private $output;
    private $tmpDir;
    private $debug = false;

    /**
     * @param string $wkhtml2pdf Path to wkhtmltopdf binary
     * @param string $tmpDir     Path to tmp dir
     * @param bool   $debug
     *
     * @throws Exception
     */
    public function __construct($wkhtml2pdf, $tmpDir = '/tmp', $debug = false)
    {
        if (!is_executable($wkhtml2pdf)) {
            throw new Exception('wkhtml2pdf binary doesn\'t exist or is not executable.');
        }

        $this->debug = $debug;
        $this->tmpDir = $tmpDir;

        $this->processBuilder = ProcessBuilder::create()
                ->setPrefix($wkhtml2pdf);

        $isQtPatched = false;
        $localpb = clone $this->processBuilder;
        $localpb->add('-V')
                ->getProcess()
                ->run(function ($t, $buffer) use ($isQtPatched) {
                    $isQtPatched = strpos($buffer, 'with patched qt') !== false;
                });
        $this->isQtPatched = $isQtPatched;
    }

    /**
     * Set input file path.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function setInputPath($path)
    {
        $this->inputPath = $path;

        return $this;
    }

    /**
     * Set input html.
     *
     * @param string $html
     *
     * @return WkHtmlToPdf
     */
    public function setInputHtml($html)
    {
        $tmpFile = join_path($this->tmpDir, md5(time()) . '.html');
        if (!is_writable(dirname($tmpFile))) {
            throw new Exception('Temporary dir is not writable.');
        }
        file_put_contents($tmpFile, $html);
        $this->inputPath = $tmpFile;

        return $this;
    }

    /**
     * Set output file path.
     *
     * @param string $path
     *
     * @return WkHtmlToPdf
     */
    public function setOutputPath($path)
    {
        $this->outputPath = $path;

        return $this;
    }

    /**
     * Get pdf as string.
     *
     * @return string
     */
    public function getOutput()
    {
        if (!$this->output) {
            throw new Exception('Html is not converted to pdf yet. Call convert() first!');
        }

        return $this->output;
    }

    /**
     * PnP method to get you going ASAP. Sets margins to 6.3mm,
     * viewport size to 800x1280, enables low quality and enables media-print if available.
     *
     * @return WkHtmlToPdf
     */
    public function useRecommendedOptions()
    {
        $this->setMarginsAll('6.3mm')
                ->setViewportSize('800x1280')
                ->enableLowQuality()
                ->setLoadErrorHandling('ignore')
                ->setLoadMediaErrorHandling('ignore');
        if ($this->isQtPatched) {
            $this->enablePrintMediaType();
        }

        return $this;
    }

    /**
     * Do conversion.
     *
     * @throws Exception
     *
     * @return WkHtmlToPdf
     */
    public function convert()
    {
        $uri = new Uri($this->inputPath);
        $isRemote = in_array($uri->getScheme(), ['http', 'https']);

        if (!$isRemote && !is_readable($this->inputPath)) {
            throw new Exception('Input file is not readable.');
        }

        $outputPath = $this->outputPath ?: join_path($this->tmpDir, md5(time()) . '.pdf');

        if (!is_writable(dirname($outputPath))) {
            throw new Exception('Output file is not writable.');
        }

        $inputPath = $this->inputPath;
        if ($isRemote && $this->isPrefetchEnabled) {
            $tmpInput = join_path($this->tmpDir, time() . '.html');
            $inputPath = $tmpInput;
            // @todo: http options
            $combined = $this->combineAssets($this->inputPath);
            file_put_contents($tmpInput, $combined);
        }

        $pb = $this->processBuilder;

        foreach ($this->arguments as $arg => $value) {
            if (is_array($value)) {
                foreach ($value as $name => $val) {
                    // if $value is hash create new arg for every value, in form: '--arg name value'
                    // if $value is array create new arg for every value, in form: '--arg value'
                    $pb->add("--$arg");
                    if (is_string($name)) {
                        $pb->add($name);
                    }
                    $pb->add("$val");
                }
            } else {
                $pb->add("--$arg");
                if ($value) {
                    $pb->add($value);
                }
            }
        }

        $process = $pb->add($inputPath)
                ->add($outputPath)
                ->getProcess();

        $process->run(function ($t, $buffer) {
            if ($this->debug) {
                fwrite(STDERR, $buffer);
            }
        });

        $this->output = file_get_contents($outputPath);
        if (!$this->outputPath) {
            unlink($outputPath);
        }

        if (isset($tmpInput) && is_writable($tmpInput)) {
            unlink($tmpInput);
        }

        return $this;
    }

    /**
     * Prefetch html and feed local file to wkhtmltopdf.
     *
     * @return WkHtmlToPdf
     */
    public function enablePrefetch()
    {
        $this->isPrefetchEnabled = true;

        return $this;
    }

    /**
     * Disable html prefetching.
     *
     * @return WkHtmlToPdf
     */
    public function disablePrefetch()
    {
        $this->isPrefetchEnabled = false;

        return $this;
    }

    /**
     * Set argument (works only when constructor param $debug == true).
     * All pdf generation related args have their dedicated method.
     *
     * @param string $arg
     * @param mixed  $val
     *
     * @return WkHtmlToPdf
     */
    public function setArg($arg, $val = null)
    {
        if ($this->debug) {
            $this->arguments[$arg] = $val;
        }

        return $this;
    }

    /**
     * Unset argument (works only when constructor param $debug == true).
     * All pdf generation related args have their dedicated method.
     *
     * @param string $arg
     *
     * @return WkHtmlToPdf
     */
    public function unsetArg($arg)
    {
        if ($this->debug && array_key_exists($arg, $this->arguments)) {
            unset($this->arguments[$arg]);
        }

        return $this;
    }

    /**
     * Replace link[rel=stylesheet], script[src], img and css url() with inline equivalent.
     * This method is still WIP and may not give desired results.
     *
     * @param string $path
     *
     * @return string Html with inlined resources
     */
    private function combineAssets($path)
    {
        $remoteUri = new Uri($path);
        $baseUri = $remoteUri->getScheme() . '://' . $remoteUri->getHost();
        $client = new Client([
            'base_uri' => $baseUri,
        ]);

        $htmlContents = $client->get($path)
                ->getBody()
                ->getContents();

        $crawler = new Crawler();
        $crawler->addHtmlContent($htmlContents);

        $crawler->filter('link')->each(function ($node) use ($client) {
            /* @var $node Crawler */

            if ('stylesheet' !== $node->attr('rel')) {
                return;
            }

            $href = $node->attr('href');

            $newNodeContents = $client
                    ->get($href)
                    ->getBody()
                    ->getContents();

            //$url = '#\b(([\w-]+:\/\/?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/)))#iS';
            preg_replace_callback("/url\(([A-Za-z0-9\:\.\-_\/]+)\);/", function ($matches) use ($client, $href) {
                try {
                    $resource = $client->get(dirname($href) . DIRECTORY_SEPARATOR . end($matches));
                    $mime = $resource->getHeader('Content-Type')[0];

                    return sprintf('url(data:%s;base64,%s)', $mime, base64_encode($resource->getBody()->getContents()));
                } catch (Exception $e) {
                    //just continue as if nothing happened
                }
            }, $newNodeContents);

            $oldNode = $node->getNode(0);
            $newNode = $oldNode
                    ->ownerDocument
                    ->createElement('style', $newNodeContents);

            $node->parents()
                    ->getNode(0)
                    ->replaceChild($newNode, $oldNode);
        });

        $crawler->filter('script')->each(function ($node) use ($client) {
            /* @var $node Crawler */

            $src = $node->attr('src');

            if (trim($node->text()) || !$src) {
                $isGa = false !== strpos($node->text(), 'GoogleAnalyticsObject');

                if ($isGa) {
                    $nativeNode = $node->getNode(0);
                    $node->getNode(0)->parentNode->removeChild($nativeNode);
                }

                return;
            }

            $newNodeContents = $client
                    ->get($src)
                    ->getBody()
                    ->getContents();

            $oldNode = $node->getNode(0);
            $newNode = $oldNode
                    ->ownerDocument
                    ->createElement('script', htmlspecialchars($newNodeContents));

            $node->parents()
                    ->getNode(0)
                    ->replaceChild($newNode, $oldNode);
        });

        /* something should be done with fonts *//*
          $fonts = $client
          ->get('http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js')
          ->getBody()
          ->getContents();

          $firstScript = $crawler->filter('script')->getNode(0);
          $fontLoader = $crawler->getNode(0)->ownerDocument->createElement('script', $fonts);
          $firstScript->parentNode->insertBefore($fontLoader, $firstScript);
         */

        $crawler->filter('img')->each(function ($node) use ($client) {
            /* @var $node Crawler */

            $src = $node->attr('src');

            $resource = $client->get($src);
            $mime = $resource->getHeader('Content-Type')[0];
            $contents = $resource->getBody()->getContents();

            $node->getNode(0)->setAttribute('src', sprintf('url(data:%s;base64,%s)', $mime, base64_encode($contents)));
        });

        return $crawler->html();
    }
}
