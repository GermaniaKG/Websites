<?php
namespace Germania\Websites;

use Psr\Container\ContainerInterface;

class PdoRouteWebsiteFactory implements ContainerInterface
{

    /**
     * @var string
     */
    public $table = 'pages';

    /**
     * @var \PDOStatement
     */
    public $stmt;

    /**
     * @param PDO             $pdo
     * @param string          $table    Websites table name
     * @param WebsiteAbstract $website  Optional: Website template object
     */
    public function __construct( \PDO $pdo, $table, WebsiteAbstract $website = null  )
    {
        $this->table = $table;

        $sql = "SELECT
        id,
        title,
        via,
        route,
        route_name,
        content_file,
        controller,
        template,
        dom_id,
        javascripts,
        stylesheets,
        is_active
        FROM {$this->table}

        WHERE route_name = :route_name
        LIMIT 1";

        $this->stmt = $pdo->prepare( $sql );
        $this->stmt->setFetchMode( \PDO::FETCH_CLASS, $website ? get_class($website) : Website::class );

    }


    public function __invoke( $route_name )
    {
        return $this->get( $route_name );
    }



    public function has ($route_name) {
        $this->executeStatement( $route_name );
        return (bool) $this->stmt->fetch();
    }


    public function get ($route_name) {
        $this->executeStatement( $route_name );

        if ($row = $this->stmt->fetch()) {

            // Cast numeric is_active field to integer
            $row->is_active = (int) $row->is_active;

            // Split into array
            if (isset($row->javascripts)):
                $row->javascripts = preg_split("/[\s,]+/", trim($row->javascripts));
            endif;
            if (isset($row->stylesheets)):
                $row->stylesheets = preg_split("/[\s,]+/", trim($row->stylesheets));
            endif;
            if (isset($row->via)):
                $row->via = preg_split("/[\s,]+/", trim($row->via));
            endif;

            return $row;
        }

        $msg = sprintf("Could not find website for route name '%s'", $route_name);
        throw new WebsiteNotFoundException( $msg );
    }


    protected function executeStatement ($route_name) {
        if (!$this->stmt->execute([
            ':route_name' => $route_name
        ])):
            throw new \RuntimeException("Could not execute PDOStatement", [
                'table' => $this->table,
                'route_name' => $route_name
            ]);
        endif;

        return true;
    }

}

