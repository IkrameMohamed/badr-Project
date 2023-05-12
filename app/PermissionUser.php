<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PermissionUser extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    protected $table = 'permission_user';
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
