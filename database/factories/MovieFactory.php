<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MovieFactory extends Factory
{
    private static int $index = 0;

    /**
     * Curated Anime List (50 Entries)
     */
    private static array $animes = [
        ['title' => 'Death Note', 'director' => 'Tetsuro Araki', 'genre' => 'Mystery', 'duration' => 24, 'year' => '2006', 'image' => 'https://cdn.myanimelist.net/images/anime/9/9453.jpg'],
        ['title' => 'Fullmetal Alchemist: Brotherhood', 'director' => 'Yasuhiro Irie', 'genre' => 'Action', 'duration' => 24, 'year' => '2009', 'image' => 'https://cdn.myanimelist.net/images/anime/1223/96541.jpg'],
        ['title' => 'Spirited Away', 'director' => 'Hayao Miyazaki', 'genre' => 'Adventure', 'duration' => 125, 'year' => '2001', 'image' => 'https://cdn.myanimelist.net/images/anime/6/79597.jpg'],
        ['title' => 'Your Name', 'director' => 'Makoto Shinkai', 'genre' => 'Romance', 'duration' => 106, 'year' => '2016', 'image' => 'https://cdn.myanimelist.net/images/anime/5/87048.jpg'],
        ['title' => 'Attack on Titan', 'director' => 'Tetsuro Araki', 'genre' => 'Action', 'duration' => 24, 'year' => '2013', 'image' => 'https://cdn.myanimelist.net/images/anime/10/47347.jpg'],
        ['title' => 'Demon Slayer', 'director' => 'Haruo Sotozaki', 'genre' => 'Action', 'duration' => 24, 'year' => '2019', 'image' => 'https://cdn.myanimelist.net/images/anime/1286/99889.jpg'],
        ['title' => 'Hunter x Hunter', 'director' => 'Hiroshi Kojina', 'genre' => 'Adventure', 'duration' => 24, 'year' => '2011', 'image' => 'https://cdn.myanimelist.net/images/anime/1337/99013.jpg'],
        ['title' => 'One Punch Man', 'director' => 'Shingo Natsume', 'genre' => 'Comedy', 'duration' => 24, 'year' => '2015', 'image' => 'https://cdn.myanimelist.net/images/anime/12/76049.jpg'],
        ['title' => 'Cowboy Bebop', 'director' => 'Shinichiro Watanabe', 'genre' => 'Sci-Fi', 'duration' => 24, 'year' => '1998', 'image' => 'https://cdn.myanimelist.net/images/anime/4/19644.jpg'],
        ['title' => 'Princess Mononoke', 'director' => 'Hayao Miyazaki', 'genre' => 'Action', 'duration' => 133, 'year' => '1997', 'image' => 'https://cdn.myanimelist.net/images/anime/7/75919.jpg'],
        ['title' => 'Steins;Gate', 'director' => 'Hiroshi Hamasaki', 'genre' => 'Sci-Fi', 'duration' => 24, 'year' => '2011', 'image' => 'https://cdn.myanimelist.net/images/anime/1935/127974.jpg'],
        ['title' => 'Naruto', 'director' => 'Hayato Date', 'genre' => 'Adventure', 'duration' => 24, 'year' => '2002', 'image' => 'https://cdn.myanimelist.net/images/anime/13/17405.jpg'],
        ['title' => 'Code Geass', 'director' => 'Goro Taniguchi', 'genre' => 'Action', 'duration' => 24, 'year' => '2006', 'image' => 'https://cdn.myanimelist.net/images/anime/1032/135088.jpg'],
        ['title' => 'Jujutsu Kaisen', 'director' => 'Sunghoo Park', 'genre' => 'Action', 'duration' => 24, 'year' => '2020', 'image' => 'https://cdn.myanimelist.net/images/anime/1127/112640.jpg'],
        ['title' => 'Vinland Saga', 'director' => 'Shuhei Yabuta', 'genre' => 'Drama', 'duration' => 24, 'year' => '2019', 'image' => 'https://cdn.myanimelist.net/images/anime/1500/103005.jpg'],
        ['title' => 'Neon Genesis Evangelion', 'director' => 'Hideaki Anno', 'genre' => 'Sci-Fi', 'duration' => 24, 'year' => '1995', 'image' => 'https://cdn.myanimelist.net/images/anime/1404/119185.jpg'],
        ['title' => 'Cyberpunk: Edgerunners', 'director' => 'Hiroyuki Imaishi', 'genre' => 'Sci-Fi', 'duration' => 25, 'year' => '2022', 'image' => 'https://cdn.myanimelist.net/images/anime/1818/126435.jpg'],
        ['title' => 'Mob Psycho 100', 'director' => 'Yuzuru Tachikawa', 'genre' => 'Comedy', 'duration' => 24, 'year' => '2016', 'image' => 'https://cdn.myanimelist.net/images/anime/8/80356.jpg'],
        ['title' => 'Chainsaw Man', 'director' => 'Ryu Nakayama', 'genre' => 'Action', 'duration' => 24, 'year' => '2022', 'image' => 'https://cdn.myanimelist.net/images/anime/1806/126216.jpg'],
        ['title' => 'Perfect Blue', 'director' => 'Satoshi Kon', 'genre' => 'Psychological', 'duration' => 81, 'year' => '1998', 'image' => 'https://cdn.myanimelist.net/images/anime/1233/112004.jpg'],
        ['title' => 'Violet Evergarden', 'director' => 'Taichi Ishidate', 'genre' => 'Drama', 'duration' => 24, 'year' => '2018', 'image' => 'https://cdn.myanimelist.net/images/anime/1795/95088.jpg'],
        ['title' => 'Tokyo Ghoul', 'director' => 'Shuhei Morita', 'genre' => 'Horror', 'duration' => 24, 'year' => '2014', 'image' => 'https://cdn.myanimelist.net/images/anime/10/67221.jpg'],
        ['title' => 'Haikyuu!!', 'director' => 'Susumu Mitsunaka', 'genre' => 'Sports', 'duration' => 24, 'year' => '2014', 'image' => 'https://cdn.myanimelist.net/images/anime/7/76014.jpg'],
        ['title' => 'My Hero Academia', 'director' => 'Kenji Nagasaki', 'genre' => 'Action', 'duration' => 24, 'year' => '2016', 'image' => 'https://cdn.myanimelist.net/images/anime/10/78745.jpg'],
        ['title' => 'Parasyte', 'director' => 'Kenichi Shimizu', 'genre' => 'Horror', 'duration' => 24, 'year' => '2014', 'image' => 'https://cdn.myanimelist.net/images/anime/3/73178.jpg'],
        ['title' => 'Bleach', 'director' => 'Noriyuki Abe', 'genre' => 'Action', 'duration' => 24, 'year' => '2004', 'image' => 'https://cdn.myanimelist.net/images/anime/3/40451.jpg'],
        ['title' => 'One Piece', 'director' => 'Konosuke Uda', 'genre' => 'Adventure', 'duration' => 24, 'year' => '1999', 'image' => 'https://cdn.myanimelist.net/images/anime/6/73245.jpg'],
        ['title' => 'Dragon Ball Z', 'director' => 'Daisuke Nishio', 'genre' => 'Action', 'duration' => 24, 'year' => '1989', 'image' => 'https://cdn.myanimelist.net/images/anime/6/20936.jpg'],
        ['title' => 'A Silent Voice', 'director' => 'Naoko Yamada', 'genre' => 'Drama', 'duration' => 130, 'year' => '2016', 'image' => 'https://cdn.myanimelist.net/images/anime/1122/96435.jpg'],
        ['title' => 'Akira', 'director' => 'Katsuhiro Otomo', 'genre' => 'Sci-Fi', 'duration' => 124, 'year' => '1988', 'image' => 'https://cdn.myanimelist.net/images/anime/10/73274.jpg'],
        ['title' => 'Psycho-Pass', 'director' => 'Naoyoshi Shiotani', 'genre' => 'Thriller', 'duration' => 24, 'year' => '2012', 'image' => 'https://cdn.myanimelist.net/images/anime/11/41839.jpg'],
        ['title' => 'Black Clover', 'director' => 'Tatsuya Yoshihara', 'genre' => 'Fantasy', 'duration' => 24, 'year' => '2017', 'image' => 'https://cdn.myanimelist.net/images/anime/2/88336.jpg'],
        ['title' => 'Blue Lock', 'director' => 'Tetsuaki Watanabe', 'genre' => 'Sports', 'duration' => 24, 'year' => '2022', 'image' => 'https://cdn.myanimelist.net/images/anime/1258/126920.jpg'],
        ['title' => 'Ranking of Kings', 'director' => 'Yousuke Hatta', 'genre' => 'Adventure', 'duration' => 23, 'year' => '2021', 'image' => 'https://cdn.myanimelist.net/images/anime/1347/117616.jpg'],
        ['title' => 'Monster', 'director' => 'Masayuki Kojima', 'genre' => 'Thriller', 'duration' => 24, 'year' => '2004', 'image' => 'https://cdn.myanimelist.net/images/anime/10/18793.jpg'],
        ['title' => 'Re:Zero', 'director' => 'Masaharu Watanabe', 'genre' => 'Drama', 'duration' => 25, 'year' => '2016', 'image' => 'https://cdn.myanimelist.net/images/anime/11/79410.jpg'],
        ['title' => 'No Game No Life', 'director' => 'Atsuko Ishizuka', 'genre' => 'Fantasy', 'duration' => 24, 'year' => '2014', 'image' => 'https://cdn.myanimelist.net/images/anime/5/65187.jpg'],
        ['title' => 'Fate/Zero', 'director' => 'Ei Aoki', 'genre' => 'Action', 'duration' => 24, 'year' => '2011', 'image' => 'https://cdn.myanimelist.net/images/anime/2/52739.jpg'],
        ['title' => 'Erased', 'director' => 'Tomohiko Ito', 'genre' => 'Mystery', 'duration' => 23, 'year' => '2016', 'image' => 'https://cdn.myanimelist.net/images/anime/10/77957.jpg'],
        ['title' => 'Clannad', 'director' => 'Tatsuya Ishihara', 'genre' => 'Romance', 'duration' => 24, 'year' => '2007', 'image' => 'https://cdn.myanimelist.net/images/anime/1804/113012.jpg'],
        ['title' => 'Great Teacher Onizuka', 'director' => 'Noriyuki Abe', 'genre' => 'Comedy', 'duration' => 24, 'year' => '1999', 'image' => 'https://cdn.myanimelist.net/images/anime/13/11460.jpg'],
        ['title' => 'Samurai Champloo', 'director' => 'Shinichiro Watanabe', 'genre' => 'Adventure', 'duration' => 24, 'year' => '2004', 'image' => 'https://cdn.myanimelist.net/images/anime/1373/92331.jpg'],
        ['title' => 'Hellsing Ultimate', 'director' => 'Tomokazu Tokoro', 'genre' => 'Action', 'duration' => 50, 'year' => '2006', 'image' => 'https://cdn.myanimelist.net/images/anime/6/20334.jpg'],
        ['title' => 'Kill la Kill', 'director' => 'Hiroyuki Imaishi', 'genre' => 'Action', 'duration' => 24, 'year' => '2013', 'image' => 'https://cdn.myanimelist.net/images/anime/8/55515.jpg'],
        ['title' => 'Gurren Lagann', 'director' => 'Hiroyuki Imaishi', 'genre' => 'Sci-Fi', 'duration' => 24, 'year' => '2007', 'image' => 'https://cdn.myanimelist.net/images/anime/4/5123.jpg'],
        ['title' => 'Made in Abyss', 'director' => 'Masayuki Kojima', 'genre' => 'Adventure', 'duration' => 25, 'year' => '2017', 'image' => 'https://cdn.myanimelist.net/images/anime/1630/103473.jpg'],
        ['title' => 'Durarara!!', 'director' => 'Takahiro Omori', 'genre' => 'Action', 'duration' => 24, 'year' => '2010', 'image' => 'https://cdn.myanimelist.net/images/anime/10/21535.jpg'],
        ['title' => 'Black Lagoon', 'director' => 'Sunao Katabuchi', 'genre' => 'Action', 'duration' => 24, 'year' => '2006', 'image' => 'https://cdn.myanimelist.net/images/anime/12/32461.jpg'],
        ['title' => 'Dr. Stone', 'director' => 'Shinya Iino', 'genre' => 'Sci-Fi', 'duration' => 24, 'year' => '2019', 'image' => 'https://cdn.myanimelist.net/images/anime/1613/102576.jpg'],
        ['title' => 'Blue Exorcist', 'director' => 'Tensai Okamura', 'genre' => 'Fantasy', 'duration' => 24, 'year' => '2011', 'image' => 'https://cdn.myanimelist.net/images/anime/10/75195.jpg'],
    ];

    public function definition(): array
    {
        if (self::$index < count(self::$animes)) {
            $anime = self::$animes[self::$index];
            $title = $anime['title'];
            $director = $anime['director'];
            $genre = $anime['genre'];
            $duration = $anime['duration'];
            $date = $anime['year'] . '-01-01';
            $image = $anime['image'];
        } else {
            // Fallback if you call for more than 50
            $title = rtrim($this->faker->words(3, true), '.');
            $director = $this->faker->name();
            $genre = $this->faker->randomElement(['Action', 'Adventure', 'Fantasy', 'Romance', 'Sci-Fi']);
            $duration = $this->faker->numberBetween(20, 150);
            $date = $this->faker->date();
            $image = "https://cdn.myanimelist.net/images/anime/10/73274.jpg"; // Default to Akira image
        }

        self::$index++;

        return [
            // Matches your migration fields exactly
            'title'        => $title,
            'description'  => $this->faker->paragraph(2),
            'director'     => $director,
            'duration'     => $duration,
            'release_date' => $date,
            'genre'        => $genre,
            'poster_url'   => $image,
        ];
    }
}
