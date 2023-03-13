<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SocialMediaUser extends Pivot
{
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = true;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'social_media_id', 'user_id', 'url'
  ];
}
