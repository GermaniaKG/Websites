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
     * Gets the content file for this page.
     *
     * @return string
     */
    public function getContentFile();


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
     * Checks if the page is marked 'active'.
     *
     * @return mixed
     */
    public function isActive();

}
