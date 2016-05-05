<?php
/**
 * Created by PhpStorm.
 * User: maurobernal
 * Date: 20/02/2016
 * Time: 6:03 PM
 */

namespace MauricioBernal\EloquentAuditing;

use MauricioBernal\EloquentAuditing\Entities\AuditLog;

trait Auditing
{
    /**
     * @var array
     */
    protected static $defaultAuditEvents = [ 'created', 'updated', 'deleted' ];
    /**
     * @var string
     */
    protected $config = 'audit.app-name';

    /**
     *
     */
    protected static function bootAuditing()
    {
        foreach ( static::getAuditEvents() as $event ) {
            static::$event(function( $model ) use ( $event ) {
                $model->audit($event);
            });
        }
    }

    /**
     * @return mixed
     */
    protected static function getAuditEvents()
    {
        if ( isset( static::$recordEvents ) ) {
            return static::$recordEvents;
        }

        return static::$defaultAuditEvents;
    }

    /**
     * Audit model.
     **
     *
     * @param string $type
     * @return AuditLog
     */
    public function audit( $type )
    {
        $logAuditing = [
            'old_value'   => json_encode(array_intersect_key($this->getOriginal(), $this->getDirty())),
            'new_value'   => json_encode($this->getDirty()),
            'application' => $this->getApplicationName(),
            'owner_type'  => get_class($this),
            'owner_name'  => $this->getTable(),
            'owner_id'    => $this->getKey(),
            'user_id'     => $this->getUserId(),
            'type'        => $type,
            'created_at'  => new \DateTime(),
        ];

        return AuditLog::insert($logAuditing);
    }

    /**
     *
     */
    protected function getApplicationName()
    {
        $config = $this->config;

        try {
            $config = app('audit_settings');
        } catch ( \ReflectionException $e ) {
        }

        return config($config) ? config($config) : 'App';
    }

    /**
     * Get user identifier
     */
    protected function getUserId()
    {
        try {
            if ( \Auth::check() ) {
                return \Auth::user()->getAuthIdentifier();
            }
        } catch ( \Exception $e ) {
            return null;
        }

        return null;
    }

}