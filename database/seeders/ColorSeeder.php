<?php

	namespace Database\Seeders;

	use App\Models\Color;
	use Illuminate\Database\Seeder;

	class ColorSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run ()
		{
			Color::create([ 'name' => "Red" ]);
			Color::create([ 'name' => "Blue" ]);
			Color::create([ 'name' => "Green" ]);
			Color::create([ 'name' => "Yellow" ]);
			Color::create([ 'name' => "Black" ]);
			Color::create([ 'name' => "White" ]);
			Color::create([ 'name' => "Orange" ]);
			Color::create([ 'name' => "Pink" ]);
			Color::create([ 'name' => "Purple" ]);
		}
	}
