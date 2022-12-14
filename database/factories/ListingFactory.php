<?php

	namespace Database\Factories;

	use Illuminate\Database\Eloquent\Factories\Factory;

	class ListingFactory extends Factory
	{
		/**
		 * Define the model's default state.
		 *
		 * @return array
		 */
		public function definition ()
		{
			return [
				'title'       => $this->faker->text(20),
				'description' => $this->faker->text(200),
				'price'       => $this->faker->numberBetween(100, 1000),
			];
		}
	}
