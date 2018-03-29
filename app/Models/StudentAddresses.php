<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAddresses extends Model
{
    /**
     * @var string
     */
    protected $table = 'student_address';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Students::class);
    }
}
