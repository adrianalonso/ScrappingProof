<?php

/**
 * Class Scrapping
 */
abstract class Scrapping
{

    /**
     * @var string
     */
    protected $url;

    /**
     * @var mixed
     */
    protected $dom;

    /**
     * Scrapping constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->scrapUrl();
    }

    /**
     * @return $this
     */
    private function scrapUrl()
    {
        $this->dom = file_get_html($this->getUrl());

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDom()
    {
        return $this->dom;
    }

    /**
     * @return mixed
     */
    abstract public function extract();
}
