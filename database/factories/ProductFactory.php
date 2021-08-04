<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_barang' => 'Product ' . $this->faker->numberBetween(rand(10, 200)),
            'kode_barang' => 'ABC' . $this->faker->numberBetween(1, 100),
            'jumlah_barang' => $this->faker->numberBetween(1, 200),
            'tanggal' => $this->faker->date('2021-08-04'),
        ];
    }
}
