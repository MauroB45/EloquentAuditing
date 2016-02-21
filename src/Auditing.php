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
                $model->audit($event);
            });
        }
    }

    /**
     * Audit model.
     *
     * @var Model $this
     *
     * @return Log
     */
    public function audit($type)
    {
        $logAuditing = [
            'old_value'  => json_encode($this->getDirty()),
            'new_value'  => json_encode($this->getDirty()),
            'owner_type' => get_class($this),
            'owner_id'   => $this->getKey(),
            'user_id'    => $this->getUserId(),
            'type'       => $type,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ];
        return Log::insert($logAuditing);
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