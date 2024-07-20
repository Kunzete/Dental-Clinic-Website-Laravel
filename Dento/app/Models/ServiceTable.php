<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceTable extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'stage',
        'price',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2', // cast price to a decimal with 2 decimal places
    ];

    /**
     * Get the service name.
     *
     * @return Attribute
     */
    protected function serviceName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value), // capitalize the first letter of the service name
        );
    }

    /**
     * Get the service stage.
     *
     * @return Attribute
     */
    protected function serviceStage(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value), // capitalize the first letter of the service stage
        );
    }
}
