<?php
namespace Germania\Websites;

interface WebsiteInterface
{

    /**
     * Gets the page ID.
     *
     * @return int
     */
    public function getId();


    /**
     * Gets the page title.
     *
     * @return string
     */
    public function getTitle();


    /**
     * Gets the page route.
     *
     * @return string
     */
    public function getRoute();


    /**
     * Gets the page route name.
     *
     * @return string
     */
    public function getRouteName();


    /**
     * Gets the content file for this page.
     *
     * @return string
     */
    public function getContentFile();


    /**
     * Gets the Controller class name for this page
     *
     * @return string
     */
    public function getController();


    /**
     * Gets the page template file.
     *
     * @return string
     */
    public function getTemplate();


    /**
     * Gets the DOM ID for this page.
     *
     * @return string
     */
    public function getDomId();

    /**
     * Gets an array with custom Javascripts
     *
     * @return array
     */
    public function getJavascripts();

    /**
     * Gets an array with custom Stylesheets
     *
     * @return array
     */
    public function getStylesheets();


    /**
     * Checks if the page is marked 'active'.
     *
     * @return mixed
     */
    public function isActive();

}
