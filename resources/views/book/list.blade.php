@extends('layout.structure')
@section('headerLinks')
<link rel="stylesheet" href="{{ asset('media/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="{{ asset('media/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('media/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endsection
@section('content')

  {{-- put conteant here --}}
  <div class="row">
    <div class="col-xl-9 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0">FIll Form</h5>
                    </div>
                    <hr/>
                    <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">
                            <select class="single-select">
                                <option selected disabled>--SELECT DEPARTMENT--</option>
                                <option value="s">Social Wellbeing</option>
                                <option value="p">Physical Health</option>
                                <option value="e">Emotional Health</option>
                                <option value="m">Mental Health</option>
                              </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Doctors</label>
                        <div class="col-sm-9">
                            <select class="single-select">
                                <option selected disabled>--AVAILABLE DOCTORS--</option>
                                <option value="s">Dr. Konadu Agyeman</option>
                                <option value="p">Nrs. Gifty Osei</option>
                                <option value="e">Dr. Buju Boadi</option>
                                <option value="m">Dr. Aboagye Mantey</option>
                              </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="date" class="col-sm-3 col-form-label">Preferred Date</label>
                        <div class="col-sm-9">
                            <input class="result form-control" type="text" id="date" placeholder="Date Picker...">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="date" class="col-sm-3 col-form-label">Preferred Time</label>
                        <div class="col-sm-9">
                            <input class="result form-control" type="text" id="time" placeholder="Time Picker...">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="button" class="btn btn-primary px-5">Submit</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
  {{-- here --}}
@endsection

@section('footerLinks')
{{-- select2 --}}
<script src="{{ asset('media/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('media/js/form-select2.js') }}"></script>
{{-- select2 --}}
<script src="{{ asset('media/plugins/datetimepicker/js/legacy.js') }}"></script>
<script src="{{ asset('media/plugins/datetimepicker/js/picker.js') }}"></script>
<script src="{{ asset('media/plugins/datetimepicker/js/picker.time.js') }}"></script>
<script src="{{ asset('media/plugins/datetimepicker/js/picker.date.js') }}"></script>
<script src="{{ asset('media/plugins/bootstrap-material-datetimepicker/js/moment.min.js') }}"></script>
<script src="{{ asset('media/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js') }}"></script>
<script src="{{ asset('media/js/form-date-time-pickes.js') }}"></script>
@endsection
