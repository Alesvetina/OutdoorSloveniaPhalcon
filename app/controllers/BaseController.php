<?php
use \Phalcon\Tag;

class BaseController extends \Phalcon\Mvc\Controller
{
    public function initialize() {
        Tag::prependTitle("OutdoorSlovenia - ");

        $this->assets
            ->collection('style')
            ->addCss('third-party/css/bootstrap.min.css', false, false)
            ->addCss('css/style.css')
            ->addCss('http://code.cloudcms.com/alpaca/1.5.17/bootstrap/alpaca.min.css', false)
            ->setTargetPath('css/production.css')
            ->setTargetUri('css/production.css')
            ->join(true)
            ->addFilter(new \Phalcon\Assets\Filters\Cssmin());

        $this->assets
            ->collection('js')
            ->addJs('third-party/js/jquery-1.12.4.min.js', false, false)
            ->addJs('third-party/js/bootstrap.min.js', false, false)
            ->addJs('http://code.cloudcms.com/alpaca/1.5.17/bootstrap/alpaca.min.js', false)
            ->setTargetPath('js/production.js')
            ->setTargetUri('js/production.js')
            ->join(true)
            ->addFilter(new \Phalcon\Assets\Filters\Jsmin());
    }
}