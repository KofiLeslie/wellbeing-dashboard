@extends('layout.structure')
@include('layout.components')

@section('headerLinks')
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Physical Health Assessment
                <small class="text-primary">Scale
                    1 (Strongly Agree) –
                    10 (Strongly Disagree) </small>
            </h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    @yield('alert')
                    @if (count($physical) > 0)
                        <div class="row">
                            <div class="col">
                                <h5>{{ $title }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('physical.answer') }}" id="myform" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="datax" id="datax">
                                    <input type="hidden" name="title" id="title" value="{{ $title }}">
                                    <div class="row">
                                        <table class="table mb-0 table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Question</th>
                                                    <th>Scale</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $inc = 0;
                                                    $num = 0;
                                                @endphp
                                                @foreach ($physical as $k => $question)
                                                    {{-- check if user is old or young --}}
                                                    {{-- @if (Auth::user()->age_group == $question->age_group) --}}
                                                        @php
                                                            $num += 1;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ strtoupper(Str::substr($title, 0, 1)) . $num . ') ' }}
                                                            </td>
                                                            <td>{{ ucfirst($question->question) }}</td>
                                                            <td>
                                                                @for ($c = 1; $c < 11; $c++)
                                                                    <div class="form-check form-check-inline">
                                                                        <input
                                                                            class="sol{{ $inc }} form-check-input  {{ $title . $inc }}"
                                                                            type="radio"
                                                                            name="{{ strtoupper(Str::substr($title, 0, 1)) . $question->id }}"
                                                                            id="{{ $title . $question->id . $c }}" required
                                                                            value="{{ $question->id . '@@' . $c }}">
                                                                        <label class="form-check-label"
                                                                            for="{{ $title . $question->id . $c }}">
                                                                            {{ $c }}
                                                                        </label>
                                                                    </div>
                                                                @endfor

                                                            </td>
                                                        </tr>
                                                    {{-- @endif --}}
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--  --}}
                                    <div class="row row-cols-auto g-3 pb-2">
                                        <button type="button" onclick="saveProgress({{ $inc }})"
                                            class="btn btn-success">Next <i class="bi bi-arrow-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        @if (isset($score))
                            <div class="row">
                                <div class="col">
                                    <h5 class="text-left">
                                        <span>Overall Score:</span>
                                        <strong>{{ $score }}</strong>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h5 class="text-left">
                                        <span>Message: </span>
                                        <strong>{{ $msg }}</strong>
                                    </h5>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col">
                                    <h5 class="text-center">No Assessment available</h5>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerLinks')
    <script src="{{ asset('media/js/customjs/physical.js') }}"></script>
@endsection
