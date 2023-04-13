@extends('layout.structure')

@section('headerLinks')
    <link href="{{ asset('media/plugins/smart-wizard/css/smart_wizard_all.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    {{-- <form action="#" method="get" enctype="multipart/form-data" >
        @csrf --}}
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
                                    $i = 1;
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
                                    $inc = 0;

                                @endphp
                                @forelse ($physical as $k => $v)
                                    @php
                                        $inc += 1;
                                    @endphp
                                    <div id="step-{{ $inc }}" class="tab-pane" role="tabpanel"
                                        aria-labelledby="step-{{ $inc }}">
                                        @php
                                            $num = 0;
                                        @endphp
                                        <table class="table mb-0 table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Question</th>
                                                    <th>Scale</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($v as $value)
                                                {{-- check if user is old or young --}}
                                                @if (Auth::user()->age_group == $value->age_group)
                                                @php
                                                        $num += 1;
                                                        @endphp
                                                        <form id="form-{{ $num }}" action="#" method="post" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                                    <tr>
                                                        <td>{{ strtoupper(Str::substr($k, 0, 1)) . $num . ') ' }}</td>
                                                        <td>{{ ucfirst($value->question) }}</td>
                                                        <td>
                                                            @for ($c = 1; $c < 11; $c++)
                                                                <div class="form-check form-check-inline">
                                                                    <input class="sol{{ $inc }} form-check-input  {{ $k . $inc }}"
                                                                        type="radio" name="{{ strtoupper(Str::substr($k, 0, 1)) . $value->id }}"
                                                                        id="{{ $k . $value->id . $c }}"
                                                                        required
                                                                        value="{{ Auth::id() . '@@' . $value->id . '@@' . $c }}">
                                                                    <label class="form-check-label"
                                                                        for="{{ $k . $value->id . $c }}">
                                                                        {{ $c }}
                                                                    </label>
                                                                </div>
                                                            @endfor
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                              </div>
                                                              <div class="invalid-feedback">
                                                                Please provide first name.
                                                              </div>
                                                        </td>
                                                    </tr>
                                                </form>
                                                @endif
                                            @endforeach
                                        </tbody>
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
    {{-- </form> --}}
@endsection

@section('footerLinks')
    <script src="{{ asset('media/plugins/smart-wizard/js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('media/plugins/smart-wizard/js/demo.js') }}"></script>
    <script src="{{ asset('media/js/customjs/physical.js') }}"></script>
    <script>
        $(function() {
            // Leave step event is used for validating the forms
            $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
                // Validate only on forward movement
                if (stepDirection == 'forward') {
                  let form = document.getElementById('form-' + (currentStepIdx + 1));
                  if (form) {
                    alert('solo');
                    return false;
                    // if (!form.checkValidity()) {
                    //   form.classList.add('was-validated');
                    //   $('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                    //   $("#smartwizard").smartWizard('fixHeight');
                    //   return false;
                    // }
                    // $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                  }
                }
            });

            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
                $("#prev-btn").removeClass('disabled').prop('disabled', false);
                $("#next-btn").removeClass('disabled').prop('disabled', false);
                if(stepPosition === 'first') {
                    $("#prev-btn").addClass('disabled').prop('disabled', true);
                } else if(stepPosition === 'last') {
                    $("#next-btn").addClass('disabled').prop('disabled', true);
                } else {
                    $("#prev-btn").removeClass('disabled').prop('disabled', false);
                    $("#next-btn").removeClass('disabled').prop('disabled', false);
                }

                // Get step info from Smart Wizard
                let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
                $("#sw-current-step").text(stepInfo.currentStep + 1);
                $("#sw-total-step").text(stepInfo.totalSteps);

                if (stepPosition == 'last') {
                //   showConfirm();
                  $("#btnFinish").prop('disabled', false);
                } else {
                  $("#btnFinish").prop('disabled', true);
                }

                // Focus first name
                if (stepIndex == 1) {
                  setTimeout(() => {
                    $('#first-name').focus();
                  }, 0);
                }
            });

            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                // autoAdjustHeight: false,
                theme: 'arrows', // basic, arrows, square, round, dots
                transition: {
                  animation:'none'
                },
                toolbar: {
                  showNextButton: true, // show/hide a Next button
                  showPreviousButton: true, // show/hide a Previous button
                  position: 'bottom', // none/ top/ both bottom
                  extraHtml: `<button class="btn btn-success" id="btnFinish" disabled onclick="onConfirm()">Complete Order</button>
                              <button class="btn btn-danger" id="btnCancel" onclick="onCancel()">Cancel</button>`
                },
                anchor: {
                    enableNavigation: true, // Enable/Disable anchor navigation
                    enableNavigationAlways: false, // Activates all anchors clickable always
                    enableDoneState: true, // Add done state on visited steps
                    markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
                    enableDoneStateNavigation: true // Enable/Disable the done state navigation
                },
            });

            $("#state_selector").on("change", function() {
                $('#smartwizard').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
                return true;
            });

            $("#style_selector").on("change", function() {
                $('#smartwizard').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
                return true;
            });

        });

        // $(document).ready(function() {

        //     // Leave step event is used for validating the forms
        //     $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
        //         // Validate only on forward movement
        //         if (stepDirection == 'forward') {
        //           let form = document.getElementById('form-' + (currentStepIdx + 1));
        //           if (form) {
        //             if (!form.checkValidity()) {
        //               form.classList.add('was-validated');
        //               $('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
        //               $("#smartwizard").smartWizard('fixHeight');
        //               return false;
        //             }
        //             $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
        //           }
        //         }
        //     });

        //     // Toolbar extra buttons
        //     var btnFinish = $('<button type="submit"></button>').text('Finish').attr('id', 'finish-btn').addClass(
        //         'btn btn-info').on('click', function() {
        //         alert('Finish Clicked');
        //     });
        //     var btnCancel = $('<button></button>').text('Reset').addClass('btn btn-danger').on('click',
        //         function() {
        //             $('#smartwizard').smartWizard("reset");
        //         });

        //     // Step show event
        //     $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
        //         var index = stepNumber+1
        //         saveProgress(index);

        //         $("#prev-btn").removeClass('disabled');
        //         $("#next-btn").removeClass('disabled');
        //         if (stepPosition === 'first') {
        //             $("#prev-btn").addClass('disabled');
        //             $("#finish-btn").addClass('disabled');
        //         } else if (stepPosition === 'last') {
        //             $("#next-btn").addClass('disabled');
        //             $("#finish-btn").removeClass('disabled');
        //         } else {
        //             $("#prev-btn").removeClass('disabled');
        //             $("#next-btn").removeClass('disabled');
        //         }
        //     });
        //     // Smart Wizard
        //     $('#smartwizard').smartWizard({
        //         selected: 0,
        //         theme: 'dots',
        //         transition: {
        //             animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
        //         },
        //         toolbarSettings: {
        //             toolbarPosition: 'bottom', // both bottom top
        //             toolbarExtraButtons: [btnFinish, btnCancel]
        //         }
        //     });

        //     // $("#prev-btn").on("click", function() {
        //     //     // Navigate previous
        //     //     $('#smartwizard').smartWizard("prev");
        //     //     return true;
        //     // });

        //     // $("#next-btn").on("click", function() {
        //     //     $('#smartwizard').smartWizard("next");
        //     //     return true;
        //     // });

        // });
    </script>
@endsection
