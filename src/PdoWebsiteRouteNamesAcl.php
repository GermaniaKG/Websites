<?php
namespace Germania\Websites;

/**
 * Reads an ACL list for route names.
 *
 *   Array
 *   (
 *       [StartPage] => Array
 *           (
 *               [0] => 2
 *           )
 *
 *       [RouteName] => Array
 *           (
 *               [0] => 4
 *           )
 *
 *       [OtherRouteName] => Array
 *           (
 *               [0] => 4
 *               [1] => 5
 *               [2] => 4
 *               [3] => 5
 *           )
 *   )
 *
 */
class PdoWebsiteRouteNamesAcl extends PdoWebsiteRoutesAcl
{

    /**
     * @var string
     */
    public $route_field_name   = "route_name";

}
