<?php
/**
 * Created by PhpStorm.
 * User: maurobernal
 * Date: 21/02/2016
 * Time: 10:02 PM
 */

namespace MauricioBernal\EloquentAuditing\Entities;


class AuditLog extends \Eloquent
{
    /**
     * @var string
     */
    public $table = 'audit_logs';

    /**
     * Cast values.
     *
     * @var array
     */
    protected $casts = [ 'old_value' => 'json', 'new_value' => 'json' ];
//
//    /**
//     * Added attribute.
//     *
//     * @var array
//     */
//    protected $appends = [ 'custom_message', 'custom_fields', 'elapsed_time' ];

//    /**
//     * The relations to eager load on every query.
//     *
//     * @var array
//     */
//    protected $with = [ 'user', 'owner' ];


}