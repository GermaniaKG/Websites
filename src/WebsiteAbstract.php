<?php
namespace Germania\Websites;

abstract class WebsiteAbstract implements WebsiteInterface
{

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $route;

    /**
     * @var string
     */
    public $content_file;

    /**
     * @var string
     */
    public $template;

    /**
     * @var string
     */
    public $dom_id;

    /**
     * @var mixed
     */
    public $is_active;

    /**
     * @var array
     */
    public $javascripts;

    /**
     * @var array
     */
    public $stylesheets;


    /**
     * Gets the page ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the page title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Gets the page route.
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }


    /**
     * Gets the content file for this page.
     *
     * @return string
     */
    public function getContentFile()
    {
        return $this->content_file;
    }


    /**
     * Gets the page template file.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }


    /**
     * Gets the DOM ID for this page.
     *
     * @return string
     */
    public function getDomId()
    {
        return $this->dom_id;
    }


    /**
     * Gets an array with custom Javascripts
     *
     * @return array
     */
    public function getJavascripts()
    {
        return $this->javascripts;
    }


    /**
     * Gets an array with custom Stylesheets
     *
     * @return array
     */
    public function getStylesheets()
    {
        return $this->stylesheets;
    }


    /**
     * Checks if the page is marked 'active'.
     *
     * @return mixed
     */
    public function isActive()
    {
        return $this->is_active;
    }
}
