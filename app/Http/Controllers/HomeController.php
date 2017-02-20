<?php

namespace App\Http\Controllers;

use App\Models\Authority;
use App\Models\Dataset;
use App\Models\Group;
use App\Models\Source;
use App\Models\State;
use App\Models\Value;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Parse the dataset that has been uploaded and redirect to index.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('dataset'))
        {
          $dataset_file = $request->file('dataset');

          $xml = simplexml_load_file($dataset_file);

          $dataset = Dataset::firstOrNew(['id' => (int)$xml->id]);

          $dataset->id = (int)$xml->id;
          $dataset->url = $xml->url;
          $dataset->name = $xml->nome;
          $dataset->long_name = $xml->nome_estendido;
          $dataset->description = $xml->descricao;

          $dataset->year_start = (int)$xml->inicio;
          $dataset->year_end = (int)$xml->final;
          $dataset->coverage = $xml->base_territorial[0]->base_territorial;
          $dataset->periodicity = $xml->periodicidade[0]->periodicidade;
          $dataset->updated_date = $xml->data_atualizacao;

          $authority = Authority::firstOrNew(['name' => $xml->orgao_primeiro_escalao[0]->nome]);
          $authority->name = $xml->orgao_primeiro_escalao[0]->nome;
          $authority->description = $xml->orgao_primeiro_escalao[0]->descricao;
          $authority->save();
          $dataset->authority_id = $authority->id;

          $group = Group::firstOrNew(['id' => $xml->grupo_informacao[0]->id]);
          $group->id = $xml->grupo_informacao[0]->id;
          $group->name = $xml->grupo_informacao[0]->nome;
          $group->url = $xml->grupo_informacao[0]->url;
          $group->save();
          $dataset->group_id = $group->id;

          $source_manager = Source::firstOrNew(['id' => $xml->fonte_gestora[0]->id]);
          $source_manager->id = $xml->fonte_gestora[0]->id;
          $source_manager->name = $xml->fonte_gestora[0]->nome;
          $source_manager->description = $xml->fonte_gestora[0]->descricao;
          $source_manager->url = $xml->fonte_gestora[0]->url;
          $source_manager->type = $xml->fonte_gestora[0]->tipo;

          $source_manager_authority = Authority::firstOrNew(['name' => $xml->fonte_gestora[0]->orgao_primeiro_escalao[0]->nome]);
          $source_manager_authority->name = $xml->fonte_gestora[0]->orgao_primeiro_escalao[0]->nome;
          $source_manager_authority->description = $xml->fonte_gestora[0]->orgao_primeiro_escalao[0]->descricao;
          $source_manager_authority->save();
          $source_manager->authority_id = $source_manager_authority->id;

          $source_manager->save();
          $dataset->source_manager_id = $source_manager->id;

          $source_provider = Source::firstOrNew(['id' => $xml->fonte_provedora[0]->id]);
          $source_provider->id = $xml->fonte_provedora[0]->id;
          $source_provider->name = $xml->fonte_provedora[0]->nome;
          $source_provider->description = $xml->fonte_provedora[0]->descricao;
          $source_provider->url = $xml->fonte_provedora[0]->url;
          $source_provider->type = $xml->fonte_provedora[0]->tipo;

          $source_provider_authority = Authority::firstOrNew(['name' => $xml->fonte_provedora[0]->orgao_primeiro_escalao[0]->nome]);
          $source_provider_authority->name = $xml->fonte_provedora[0]->orgao_primeiro_escalao[0]->nome;
          $source_provider_authority->description = $xml->fonte_provedora[0]->orgao_primeiro_escalao[0]->descricao;
          $source_provider_authority->save();
          $source_provider->authority_id = $source_provider_authority->id;

          $source_provider->save();
          $dataset->source_provider_id = $source_provider->id;

          $dataset->values()->delete();
          $dataset->save();

          foreach ($xml->valores[0]->entry as $entry) {
            $value = new Value();
            $value->data = $entry->valor;
            $value->state_id = $entry->estado_ibge;
            $value->year = $entry->ano;
            $value->dataset_id = (int)$xml->id;
            $value->save();
          }
        }
        return redirect()->action('HomeController@index');
    }
}
