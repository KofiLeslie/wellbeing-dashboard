@extends('layout.structure')

@section('headerLinks')
    <link href="{{ asset('media/plugins/smart-wizard/css/smart_wizard_all.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<form action="#" method="get" enctype="multipart/form-data">
    @csrf
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
                    <!-- SmartWizard html -->
                    <div id="smartwizard">
                        <ul class="nav">
                            @php
                                $i=1;
                            @endphp
                            @forelse ($physical as $key => $item)

                            <li class="nav-item">
                                <a class="nav-link" href="#step-{{ $i }}">
                                    <strong>Step {{ $i++ }}</strong>
                                    <br>{{ ucwords($key) }}
                                </a>
                            </li>
                            @empty

                            @endforelse
                        </ul>
                        <div class="tab-content">
                            @php
                                $inc=0;

                            @endphp
                            @forelse ($physical as $k => $v)
                            @php
                                $inc+=1;
                            @endphp
                            <div id="step-{{ $inc }}" class="tab-pane" role="tabpanel" aria-labelledby="step-{{ $inc }}">
                                @php
                                    $num =0;
                                @endphp
                                <table class="table mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Question</th>
                                            <th>Scale</th>
                                        </tr>
                                    </thead>
                                    @foreach ($v as $value)
                                    @php
                                    $num+=1;
                                    @endphp
                                    <tr>
                                        <td>{{ strtoupper(Str::substr($k, 0,1)).$num.') ' }}</td>
                                        <td>{{ ucfirst($value->question) }}</td>
                                        <td>
                                            @for ($c = 1; $c < 11; $c++)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input  {{ $k.$inc }}" type="radio" name="{{ $k.$value->id }}" id="{{ $k.$value->id.$c }}" value="{{ $value->id.'@@'.$c }}">
                                                <label class="form-check-label" for="{{ $k.$value->id.$c }}">
                                                    {{ $c }}
                                                </label>
                                            </div>
                                            @endfor
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                                @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footerLinks')
    <script src="{{ asset('media/plugins/smart-wizard/js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('media/js/customjs/physical.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Toolbar extra buttons
            var btnFinish = $('<button type="submit"></button>').text('Finish').attr('id', 'finish-btn').addClass('btn btn-info').on('click', function() {
                alert('Finish Clicked');
            });
            var btnCancel = $('<button></button>').text('Reset').addClass('btn btn-danger').on('click',
        function() {
                $('#smartwizard').smartWizard("reset");
            });
            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {

                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
                if (stepPosition === 'first') {
                    $("#prev-btn").addClass('disabled');
                    $("#finish-btn").addClass('disabled');
                } else if (stepPosition === 'last') {
                    $("#next-btn").addClass('disabled');
                    $("#finish-btn").removeClass('disabled');
                } else {
                    $("#prev-btn").removeClass('disabled');
                    $("#next-btn").removeClass('disabled');
                }
            });
            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                transition: {
                    animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                },
                toolbarSettings: {
                    toolbarPosition: 'bottom', // both bottom top
                    toolbarExtraButtons: [btnFinish, btnCancel]
                }
            });
            $("#prev-btn").on("click", function() {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                return true;
            });
            $("#next-btn").on("click", function() {
                // Navigate next
                $('#smartwizard').smartWizard("next");
                return true;
            });
        });
    </script>
@endsection
