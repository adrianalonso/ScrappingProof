<?php

abstract class Scrapping
{
    protected $url;
    protected $dom;

    public function __construct($url)
    {
        $this->url = $url;
        $this->scrapUrl();
    }

    private function scrapUrl()
    {
        $this->dom = file_get_html($this->getUrl());

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getDom()
    {
        return $this->dom;
    }

    abstract public function extract();
}
