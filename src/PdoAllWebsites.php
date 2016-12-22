<?php
namespace Germania\Websites;

class PdoAllWebsites extends Websites implements WebsitesInterface
{

    /**
     * @var string
     */
    public $table = 'pages';

    /**
     * @param PDO             $pdo
     * @param WebsiteAbstract $website  Optional: Website template object
     * @param string          $table    Optional: Websites table name
     */
    public function __construct( \PDO $pdo, WebsiteAbstract $website = null, $table = null  )
    {
        $this->table = $table ?: $this->table;

        // ID is listed twice here in order to use it with FETCH_UNIQUE as array key
        $sql = "SELECT
        id,
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

        WHERE 1";

        $stmt = $pdo->prepare( $sql );

        $stmt->setFetchMode( \PDO::FETCH_CLASS, $website ? get_class($website) : Website::class );

        if (!$stmt->execute()):
            throw new \RuntimeException("Could not retrieve Websites from database");
        endif;

        $this->websites = array_map(function($row) {
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
        }, $stmt->fetchAll(\PDO::FETCH_UNIQUE));
    }

}

