<?php

namespace Watson\Rememberable\Query;

class MongoDBBuilder extends \Jenssegers\Mongodb\Query\Builder
{
    use BuilderTrait;

    /**
     * Generate the unique cache key for the query.
     *
     * @return string
     */
    public function generateCacheKey()
    {
        return parent::generateCacheKey();
    }
}
