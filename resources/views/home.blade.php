@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <button id="btnUpload" type="button" class="btn btn-default pull-right">
                    Upload
                  </button>
                  <h4>Dashboard</h4>
                </div>
                <div class="panel-body">
                  @forelse ($datasets as $dataset)
                    <a href="{{ action('VisualizationController@index', ['id' => $dataset->id])}}" title={{ $dataset->description }}>{{$dataset->name}}</a></br>
                  @empty
                    There's no datasets.
                  @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div hidden>
  <form id="frmUpload" action="/upload" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input id="iptUpload" type="file" name="dataset" accept=".xml" />
  </form>
</div>
@endsection

@section('script')
  <script>
    $(function() {
      var $btnUpload = $('#btnUpload');
      var $iptUpload = $('#iptUpload');
      var $frmUpload = $('#frmUpload');

      $btnUpload.click(function() {
        $iptUpload.click();
      });

      $iptUpload.change(function() {
        if ($iptUpload.get(0).files[0]) {
          $frmUpload.submit();
        }
      });
    });
  </script>
@endsection
