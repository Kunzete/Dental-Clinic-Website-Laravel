<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_id',
        'patient_name',
        'patient_email',
        'patient_number',
        'patient_address',
        'appointment_time',
        'appointment_day',
        'description',
        'status',
    ];

    /**
     * The doctor that owns the appointment.
     *
     * @return BelongsTo
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
