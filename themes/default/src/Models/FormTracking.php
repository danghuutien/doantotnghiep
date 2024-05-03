<?php

namespace Sudo\Theme\Models;

use Illuminate\Database\Eloquent\Model;

class FormTracking extends Model
{
    protected $fillable = ['type'];

    public static function add($data) {
        $created_at = $updated_at = date('Y-m-d H:i:s');
    	if (session('form_tracking') == 'direct') {
            $source = 'direct';
            $source_link = 'direct';
        } else {
            $source = getDomain(session('form_tracking'))??session('form_tracking');
            $source_link = config('app.utm_source')[session('form_tracking')]??session('form_tracking');
        }
        FormTracking::insert([
            'source' => $source??'direct',
            'source_link' => $source_link??'direct',
            'type' => $data['type'],
            'type_id' => $data['type_id'],
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ]);
    }
}