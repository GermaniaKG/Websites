<?php
namespace Germania\Websites;

use Interop\Container\ContainerInterface;

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
        route,
        route_name,
        content_file,
        template,
        dom_id,
        javascripts,
        stylesheets,
        is_active

        FROM {$this->table}

        WHERE route_name = :route
        OR route = :route
        LIMIT 1";

        $this->stmt = $pdo->prepare( $sql );
        $this->stmt->setFetchMode( \PDO::FETCH_CLASS, $website ? get_class($website) : Website::class );

    }


    public function __invoke( $route )
    {
        return $this->get( $route );
    }



    public function has ($route) {
        $this->executeStatement( $route );
        return (bool) $this->stmt->fetch();
    }


    public function get ($route) {
        $this->executeStatement( $route );

        if ($row = $this->stmt->fetch()) {
            // Cast numeric is_active field to integer
            $row->is_active = (int) $row->is_active;
            // Split into array
            if (isset($row->javascripts)):
                $row->javascripts = explode(",", $row->javascripts);
            endif;
            if (isset($row->stylesheets)):
                $row->stylesheets = explode(",", $row->stylesheets);
            endif;

            return $row;
        }

        throw new WebsiteNotFoundException("Could not find website for route or route name '$route'");
    }


    protected function executeStatement ($route) {
        if (!$this->stmt->execute([
            ':route' => $route
        ])):
            throw new \RuntimeException("Could not execute PDOStatement", [
                'table' => $this->table,
                'route' => $route
            ]);
        endif;

        return true;
    }

}

