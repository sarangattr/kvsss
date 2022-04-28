<?php

namespace Modules\Application\Traits;

trait ModelQueryHelpers {

    public function added_by()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function scopeCreatedBy($query)
    {
        $query->with([
            'added_by' => function ($q) {
                $q->select('id', 'name');
            }
        ]);
    }

    public function getCreatedAtFormatAttribute()
    {
        return dateFormat($this->created_at);
    }

    public function getEncryptIdAttribute()
    {
        return crypt_encrypt($this->id);
    }
}
