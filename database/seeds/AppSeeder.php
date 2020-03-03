<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AppSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create('es_ES');
        $sectores = array('S-1', 'S-2', 'S-3', 'A-1', 'A-2', 'A-3', 'Z-1', 'Z-2', 'Z-3');
        $etiquetas = array('php', 'java', 'framework', 'python', 'javascript', 'css', 'phpstorm', 'web', 'programacion');

        for ($i = 0; $i < 3; $i++) {

            User::create([
                'nombre' => $faker->firstName,
                'biografia' => $faker->text,
                'email' => 'usuario' . $i . '@usuario' . $i . '.com',
                'password' => Hash::make('123'),
                'sector_donde_trabaja' => $faker->randomElement($sectores),
                'url_foto' => '/img/default.png'
            ]);

            // crearle preguntas de prueba
            $usuario = DB::table('users')
                ->select('*')
                ->orderByDesc('id')
                ->limit(1)
                ->get();
            for ($x = 0; $x < $faker->numberBetween(1, 10); $x++) {
                foreach ($usuario as $user => $value) {
                    $tags = "";
                    //crease los tags
                    foreach ($faker->randomElements($etiquetas, $faker->numberBetween(1, 4), false) as $tag) {
                        if ($tags != "") {
                            $tags = $tags . "," . $tag;
                        } else {
                            $tags = $tag;
                        }
                    }
                    DB::table('preguntas')->insert([
                        'titulo' => $faker->sentence(6, true),
                        'descripcion' => $faker->realText(240),
                        'estado' => false,
                        'visita' => 1,
                        'etiquetas' => $tags,
                        'user_id' => $value->id,
                        'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                        'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                    ]);
                }
            }
        }
    }
}
