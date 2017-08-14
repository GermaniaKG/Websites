<?php
namespace Germania\Websites;

class Website extends WebsiteAbstract implements WebsiteInterface
{


    /**
     * Sets the page ID.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Sets the page title.
     *
     * @param mixed $title the title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }


    /**
     * Sets the page route.
     *
     * @param mixed $route the route
     *
     * @return self
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }


    /**
     * Sets the page route name.
     *
     * @param mixed $route_name the route name
     *
     * @return self
     */
    public function setRouteName($route_name)
    {
        $this->route_name = $route_name;

        return $this;
    }


    /**
     * Sets the content file for this page.
     *
     * @param mixed $content_file the php include
     *
     * @return self
     */
    public function setContentFile($content_file)
    {
        $this->content_file = $content_file;

        return $this;
    }


    /**
     * Sets the Controller class for this page.
     *
     * @param mixed $controller the php class
     *
     * @return self
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }


    /**
     * Sets the page template file.
     *
     * @param mixed $template the template
     *
     * @return self
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }


    /**
     * Sets the DOM ID for this page.
     *
     * @param mixed $dom_id the dom id
     *
     * @return self
     */
    public function setDomId($dom_id)
    {
        $this->dom_id = $dom_id;

        return $this;
    }



    /**
     * Sets custom Stylesheets
     *
     * @param array $css
     *
     * @return self
     */
    public function setStylesheets( $css )
    {
        $this->stylesheets = $css;

        return $this;
    }


    /**
     * Sets custom Javascripts
     *
     * @param array $js
     *
     * @return self
     */
    public function setJavascripts( $js )
    {
        $this->javascripts = $js;

        return $this;
    }




    /**
     * Checks if the page is marked 'active'.
     *
     * If no parameter is set, the current active state will be returned.
     *
     * @param mixed $is_active 'active' flag. Defaults to null.
     *
     * @return self|bool The page instance or active state (TRUE id greater than 0, else FALSE)
     */
    public function isActive($is_active = null)
    {
        if (is_null($is_active)) {
            return $this->is_active > 0;
        }
        $this->is_active = $is_active;
        return $this;
    }
}
