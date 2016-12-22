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
     * @param WebsiteAbstract $website  Optional: Website template object
     * @param string          $table    Optional: Websites table name
     */
    public function __construct( \PDO $pdo, WebsiteAbstract $website = null, $table = null  )
    {
        $this->table = $table ?: $this->table;

        $sql = "SELECT
        id,
        title,
        route,
        content_file,
        template,
        dom_id,
        javascripts,
        stylesheets,
        is_active

        FROM {$this->table}

        WHERE route = :route
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

        if ($user = $this->stmt->fetch()) {
            return $user;
        }

        throw new WebsiteNotFoundException("Could not find website for route '$route'");
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

