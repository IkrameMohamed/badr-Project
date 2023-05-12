<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PermissionRole extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    protected $table = 'permission_role';
    //


    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'id'
    ];
}
