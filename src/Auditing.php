<?php
/**
 * Created by PhpStorm.
 * User: maurobernal
 * Date: 20/02/2016
 * Time: 6:03 PM
 */

namespace MauricioBernal\EloquentAuditing;


trait Auditing
{
    protected static $defaultAuditEvents = [ 'created', 'updated', 'deleted' ];

    protected static function bootAuditing()
    {
        foreach (static::getAuditEvents() as $event) {
            static::$event(function ( $model ) use ( $event ) {
                $model->recordEvent();
            });
        }
    }

    public function recordEvent( $event )
    {

    }

    /**
     * @return mixed
     */
    protected static function getAuditEvents()
    {
        if (isset( static::$recordEvents )) {
            return static::$recordEvents;
        }

        return static::$defaultAuditEvents;
    }

}