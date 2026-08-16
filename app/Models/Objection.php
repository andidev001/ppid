<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Objection extends Model
{
    protected $guarded = [];
    public function request() { return $this->belongsTo(InformationRequest::class, 'information_request_id'); }
    public function user() { return $this->belongsTo(User::class); }
}
