@extends('layout.structure')

@section('headerLinks')

@endsection

@section('content')
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="card-title d-flex align-items-center">
                <h5 class="mb-0">Physical Health Assessment</h5>
            </div>
            <hr/>
          <div id="chart12"></div>
        </div>
      </div>
</div>
@endsection

@section('footerLinks')
<script src="{{ asset('media/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('media/plugins/apexcharts-bundle/js/apex-custom.js') }}"></script>
@endsection

