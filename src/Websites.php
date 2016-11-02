<?php
namespace Germania\Websites;

class Websites implements WebsitesInterface
{

    /**
     * @var array
     */
    public $websites = array();


    /**
     * @return UserInterface
     * @throws WebsiteNotFoundException
     * @uses   $websites
     */
    public function get( $id )
    {
        if ($this->has( $id )) {
            return $this->websites[ $id ];
        }
        throw new WebsiteNotFoundException("Could not find Website with ID '$id'");
    }


    /**
     * @return boolean
     * @uses   $websites
     */
    public function has ($id )
    {
        return array_key_exists( $id, $this->websites);
    }



    /**
     * @return ArrayIterator
     * @uses   $websites
     */
    public function getIterator()
    {
        return new \ArrayIterator( $this->websites );
    }


    /**
     * @return int
     * @uses   $websites
     */
    public function count()
    {
        return count($this->websites);
    }
}
