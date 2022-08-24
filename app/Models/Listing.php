<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Spatie\MediaLibrary\HasMedia;
	use Spatie\MediaLibrary\InteractsWithMedia;
	use Spatie\MediaLibrary\MediaCollections\Models\Media;

	class Listing extends Model implements HasMedia
	{
		use HasFactory;
		use InteractsWithMedia;

		protected $fillable = [ 'title', 'description', 'price', 'user_id' ];

		public function registerMediaConversions ( Media $media = null )
		: void {
			$this->addMediaConversion('thumb')
				 ->width(200)
				 ->height(200)
			;
		}

		public function user ()
		{
			return $this->belongsTo(User::class);
		}

		public function categories ()
		{
			return $this->belongsToMany(Category::class);
		}
	}
