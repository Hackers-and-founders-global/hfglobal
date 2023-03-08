<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
  use HasFactory;
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'state_id', 'state_code', 'country_id', 'country_code', 'latitude', 'longitude', 'flag', 'wikiDataId'
  ];

  /**
   * Get the country that owns the state.
   */
  public function country()
  {
    return $this->belongsTo(Country::class);
  }

  /**
   * Get the state that owns the state.
   */
  public function state()
  {
    return $this->belongsTo(State::class);
  }
}
