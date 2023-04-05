@extends('layout.structure')
@include('layout.components')

@section('headerLinks')
    <link rel="stylesheet"
        href="{{ asset('media/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css') }}">
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
                    @yield('alert')
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0">Update Bio</h5>
                        </div>
                        <hr />
                        <form action="{{ route('update') }}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="row mb-3">
                                <label for="date" class="col-sm-3 col-form-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input class="result form-control" type="text" id="date" name="dob"
                                        placeholder="Date Picker...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="sex" class="col-sm-3 col-form-label">Sex</label>
                                <div class="col-sm-9">
                                    <select class="single-select" id="sex" name="sex">
                                        <option selected disabled>--SELECT SEX--</option>
                                        <option value="m">Male</option>
                                        <option value="f">Femail</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="loc" class="col-sm-3 col-form-label">Location</label>
                                <div class="col-sm-9">
                                    <input class="result form-control" type="text" id="loc" name="loc"
                                        placeholder="Location">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary px-5">Submit</button>
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
    <script
        src="{{ asset('media/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js') }}">
    </script>
    <script src="{{ asset('media/js/form-date-time-pickes.js') }}"></script>
@endsection
