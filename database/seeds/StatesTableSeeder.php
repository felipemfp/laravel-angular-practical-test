<?php

use Illuminate\Database\Seeder;
use App\Models\State;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();

        $j = 0;

        $states = [
          'Rondônia',
          'Acre',
          'Amazonas',
          'Roraima',
          'Pará',
          'Amapá',
          'Tocatins',
          'Maranhão',
          'Piauí',
          'Ceará',
          'Rio Grande do Norte',
          'Paraíba',
          'Pernanbuco',
          'Alagoas',
          'Sergipe',
          'Bahia',
          'Minas Gerais',
          'Espírito Santo',
          'Rio de Janeiro',
          'São Paulo',
          'Paraná',
          'Santa Catarina',
          'Rio Grande do Sul',
          'Mato Grosso do Sul',
          'Mato Grosso',
          'Goiás',
          'Distrito Federal'
        ];

        for ($id=11; $id <= 17; $id++, $j++) {
            State::create([
              'id' => $id,
              'description' => $states[$j],
              'region' => State::NORTE
            ]);
        }

        for ($id=21; $id <= 29; $id++, $j++) {
            State::create([
              'id' => $id,
              'description' => $states[$j],
              'region' => State::NORDESTE
            ]);
        }

        for ($id=31; $id <= 33; $id++, $j++) {
            State::create([
              'id' => $id,
              'description' => $states[$j],
              'region' => State::SUDESTE
            ]);
        }

        State::create([
          'id' => 35,
          'description' => $states[$j],
          'region' => State::SUDESTE
        ]);
        $j++;

        for ($id=41; $id <= 43; $id++, $j++) {
            State::create([
              'id' => $id,
              'description' => $states[$j],
              'region' => State::SUL
            ]);
        }

        for ($id=50; $id <= 53; $id++, $j++) {
            State::create([
              'id' => $id,
              'description' => $states[$j],
              'region' => State::CENTRO_OESTE
            ]);
        }
    }
}
