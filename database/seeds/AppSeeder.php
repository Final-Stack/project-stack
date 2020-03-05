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
        $etiquetas = array('php', 'html', 'laravel', 'java', 'framework', 'python', 'javascript', 'css', 'phpstorm', 'web', 'programacion', 'S-1', 'S-2', 'S-3', 'A-1', 'A-2', 'A-3', 'Z-1', 'Z-2', 'Z-3');
        $numeroDeUsuarios = 21;
        $numeroDePreguntas = 50;
        $usuariosID = [1, 11, 21, 31, 41, 51, 61, 71, 81, 91, 101, 111, 121, 131, 141, 151, 161, 171, 181, 191, 201];

        for ($i = 0; $i < $numeroDeUsuarios; $i++) {

            User::create([
                'nombre' => $faker->firstName,
                'biografia' => $faker->text,
                'email' => 'usuario' . $i . '@usuario' . $i . '.com',
                'password' => Hash::make('123'),
                'sector_donde_trabaja' => $faker->randomElement($sectores),
                'url_foto' => '/img/default.png'
            ]);
        }

        for ($x = 0; $x < $numeroDePreguntas; $x++) {

            // crearle preguntas de prueba a un usuario aleatorio
            // para crear una pregunta por el usuario devuelto
            $tags = "";
            //crease los tags
            foreach ($faker->randomElements($etiquetas, $faker->numberBetween(1, 5), false) as $tag) {
                if ($tags != "") {
                    $tags = $tags . "," . $tag;
                } else {
                    $tags = $tag;
                }
            }
            DB::table('preguntas')->insert([
                'titulo' => $faker->realText(140, 1),
                'descripcion' => $faker->realText(240),
                'estado' => false,
                'visita' => $faker->numberBetween(1, 2310),
                'etiquetas' => $tags,
                'user_id' => $faker->randomElement($usuariosID),
                'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
            ]);

        }

        // crear respuestas  de forma aleatoria sobre 50 posibles preguntas
        for ($x = 0; $x < $numeroDePreguntas * 2; $x++) {

            // crearle respuestas de prueba a un usuario aleatorio
            $pregunta = DB::table('preguntas')
                ->select('*')
                ->where('user_id', '=', $faker->randomElement($usuariosID))
                ->get();

            foreach ($pregunta as $q => $valuePregunta) {
                // para crear una respuesta por el usuario devuelto y pregunt aleatoria devuelta
                DB::table('respuestas')->insert([
                    'descripcion' => $faker->realText(140),
                    'user_id' => $faker->randomElement($usuariosID),
                    'pregunta_id' => $valuePregunta->id,
                    'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                    'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                ]);

                //crear votos aleatorios
                DB::table('votos')->insert([
                    'user_id' => $faker->randomElement($usuariosID),
                    'pregunta_id' => $valuePregunta->id,
                    'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                    'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                ]);
                //crear favoritos aleatorios
                DB::table('favoritos')->insert([
                    'user_id' => $faker->randomElement($usuariosID),
                    'pregunta_id' => $valuePregunta->id,
                    'created_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                    'updated_at' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null),
                ]);
            }


        }
    }
}
