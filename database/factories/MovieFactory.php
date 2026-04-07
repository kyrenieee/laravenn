<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    private static array $titles = [
        'Inception', 'The Dark Knight', 'Interstellar', 'Avengers: Endgame',
        'The Matrix', 'Parasite', 'Dune', 'Oppenheimer', 'Everything Everywhere All at Once',
        'The Shawshank Redemption', 'The Godfather', 'Pulp Fiction', 'The Notebook',
        'Happy Gilmore', 'The Conjuring', 'Jurassic Park', 'Forrest Gump', 'Titanic',
        'The Lion King', 'Spider-Man: No Way Home',
    ];

    private static int $titleIndex = 0;

    public function definition(): array
    {
        $title = self::$titles[self::$titleIndex % count(self::$titles)];
        self::$titleIndex++;

        return [
            'title'            => $title,
            'description'      => $this->faker->paragraph(3),
            'genre'            => $this->faker->randomElement(['Action', 'Comedy', 'Romance', 'Sci-Fi', 'Horror', 'Drama', 'Thriller']),
            'duration_minutes' => $this->faker->numberBetween(85, 200),
            'poster_url'       => 'https://via.placeholder.com/300x450?text=' . urlencode($title),
            'release_date'     => $this->faker->dateTimeBetween('-20 years', 'now')->format('Y-m-d'),
        ];
    }
}
