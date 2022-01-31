<?php

namespace App\Models;

use App\Models\User;
use App\Notifications\ExamResultNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'type' //NULL marcado - (-1) waiting - 0 não reagente - 1 covid - 2 delta
    ];

    protected $appends = ['date_formatted'];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public function getDateFormattedAttribute()
    {
        return Carbon::parse($this->date)->format('d/m/Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setDateAttribute($value)
    {
        if ($value) {
            $data = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            $this->attributes['date'] = $data;
        }
    }

}
