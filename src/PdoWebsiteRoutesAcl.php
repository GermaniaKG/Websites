<?php
namespace Germania\Websites;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Psr\Log\LoggerAwareTrait;

/**
 * Reads an ACL list for route URL paths.
 *
 *   Array
 *   (
 *       [/] => Array
 *           (
 *               [0] => 2
 *           )
 *
 *       [/some/route] => Array
 *           (
 *               [0] => 4
 *               [1] => 5
 *               [2] => 4
 *               [3] => 5
 *           )
 *   )
 *
 */
class PdoWebsiteRoutesAcl
{

    use LoggerAwareTrait;


    /**
     * @var \PDOStatement
     */
    public $stmt;


    /**
     * @var string
     */
    public $pages_table = "pages";

    /**
     * @var string
     */
    public $pages_roles_table   = "pages_roles";

    /**
     * @var string
     */
    public $separator   = ",";

    /**
     * @var string
     */
    public $route_field_name   = "route";


    /**
     * @param \PDO                 $pdo                 PDO instance
     * @param string               $pages_table         Pages table name
     * @param string               $pages_roles_table   Pages and roles assignments table name
     * @param LoggerInterface|null $logger              Optional: PSR-3 Logger
     */
    public function __construct( \PDO $pdo, $pages_table, $pages_roles_table, LoggerInterface $logger = null )
    {
        // Prerequisites
        $this->pages_table       = $pages_table ?: $this->pages_table;
        $this->pages_roles_table = $pages_roles_table   ?: $this->pages_roles_table;
        $this->setLogger( $logger ?: new NullLogger );

        // Read pages and allowed roles
        $sql =  "SELECT
        Page.{$this->route_field_name},
        GROUP_CONCAT(Page_Roles.role_id SEPARATOR '{$this->separator}') AS roles

        FROM      {$this->pages_table} Page
        LEFT JOIN {$this->pages_roles_table}   Page_Roles
        ON Page.id = Page_Roles.page_id

        WHERE Page_Roles.role_id IS NOT NULL
        GROUP BY Page.route";

        // Prepare business
        $this->stmt = $pdo->prepare( $sql );
    }


    /**
     * @return array
     */
    public function __invoke( )
    {
        $this->stmt->execute();

        // Fetch results; explode arrays
        $acl = array_map(function( $roles ) {
            return array_filter(explode($this->separator, $roles));
        }, $this->stmt->fetchAll( \PDO::FETCH_UNIQUE | \PDO::FETCH_OBJ | \PDO::FETCH_COLUMN));

        return $acl;
    }
}
