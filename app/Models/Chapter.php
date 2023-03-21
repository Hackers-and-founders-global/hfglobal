<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
  use HasFactory;
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'country_id', 'city_id', 'leader_id', 'year', 'website'
  ];

  /**
   * Get the country that owns the chapter.
   */
  public function country()
  {
    return $this->belongsTo(Country::class);
  }

  /**
   * Get the city that owns the chapter.
   */
  public function city()
  {
    return $this->belongsTo(City::class);
  }

  /**
   * Get the leader that owns the chapter.
   */
  public function leader()
  {
    return $this->belongsTo(User::class, 'leader_id');
  }
}
