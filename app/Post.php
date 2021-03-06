<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	use Sluggable;

	protected $fillable = ['user_id', 'photo_id', 'category_id', 'title', 'body', 'slug'];
	/**
	 * Sluggable configuration.
	 *
	 * @var array
	 */
	public function sluggable() {
		return [
			'slug' => [
				'source' => 'title',
				'separator' => '-',
				'includeTrashed' => true,
				'onUpdate' => true,
			],
		];
	}

	public function user() {
		return $this->belongsTo('App\User');
	}
	public function photo() {
		return $this->belongsTo('App\Photo');
	}
	public function category() {
		return $this->belongsTo('App\Category');
	}
	public function comments() {
		return $this->hasMany('App\Comment');
	}
}
