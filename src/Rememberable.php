<?php

namespace Watson\Rememberable;

use Illuminate\Database\Connection as BaseConnection;
use InvalidArgumentException;
use Jenssegers\Mongodb\Connection;
use Watson\Rememberable\Query\Builder;
use Watson\Rememberable\Query\MongoDBBuilder;

/**
 * Trait Rememberable
 * @package Watson\Rememberable
 *
 * @method static $this remember($time)
 * @method $this remember($time)
 */
trait Rememberable
{
    /**
     * Get a new query builder instance for the connection.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function newBaseQueryBuilder()
    {
        $conn    = $this->getConnection();
        $grammar = $conn->getQueryGrammar();

        if ($conn instanceof Connection) {
            $builder = new MongoDBBuilder($conn, $conn->getPostProcessor());
        } elseif ($conn instanceof BaseConnection) {
            $builder = new Builder($conn, $grammar, $conn->getPostProcessor());
        } else {
            throw new InvalidArgumentException(sprintf('[$conn is not Connection class instance.]'));
        }

        if (isset($this->rememberFor)) {
            $builder->remember($this->rememberFor);
        }

        if (isset($this->rememberCacheTag)) {
            $builder->cacheTags($this->rememberCacheTag);
        }

        if (isset($this->rememberCachePrefix)) {
            $builder->prefix($this->rememberCachePrefix);
        }

        return $builder;
    }
}
