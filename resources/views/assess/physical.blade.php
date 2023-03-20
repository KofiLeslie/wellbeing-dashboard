@extends('layout.structure')

@section('headerLinks')
    <link href="{{ asset('media/plugins/smart-wizard/css/smart_wizard_all.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<form action="#" method="get" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Physical Health Assessment</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <!-- SmartWizard html -->
                    <div id="smartwizard">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#step-1"> <strong>Step 1</strong>
                                    <br>This is step description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#step-2"> <strong>Step 2</strong>
                                    <br>This is step description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#step-3"> <strong>Step 3</strong>
                                    <br>This is step description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#step-4"> <strong>Step 4</strong>
                                    <br>This is step description</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                <h3>Step 1 Content</h3>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">Question 1</label>
                                        <input type="text" class="form-control" placeholder="Subject/Heading">
                                      </div>

                                      <div class="col-6">
                                        <label class="form-label">Question 2</label>
                                        <input type="text" class="form-control" placeholder="Subject/Heading">
                                      </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">Question 3</label>
                                        <input type="text" class="form-control" placeholder="Subject/Heading">
                                      </div>

                                      <div class="col-6">
                                        <label class="form-label">Question 4</label>
                                        <input type="text" class="form-control" placeholder="Subject/Heading">
                                      </div>
                                </div>
                            </div>
                            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                <h3>Step 2 Content</h3>
                                <div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">Question 3</label>
                                            <input type="text" class="form-control" placeholder="Subject/Heading">
                                          </div>

                                          <div class="col-6">
                                            <label class="form-label">Question 4</label>
                                            <input type="text" class="form-control" placeholder="Subject/Heading">
                                          </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkMe[]" type="checkbox" value="" id="1a">
                                                <label class="form-check-label" for="1a">Check Question</label>
                                            </div>
                                          </div>

                                          <div class="col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkMe[]" type="checkbox" value="" id="2b">
                                                <label class="form-check-label" for="2b">Check Question</label>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">Question 3</label>
                                        <input type="text" class="form-control" placeholder="Subject/Heading">
                                      </div>

                                      <div class="col-6">
                                        <label class="form-label">Question 4</label>
                                        <input type="text" class="form-control" placeholder="Subject/Heading">
                                      </div>
                                </div>
                            </div>
                            <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                <h3>Step 4 Content</h3>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">Question 3</label>
                                        <input type="text" class="form-control" placeholder="Subject/Heading">
                                      </div>

                                      <div class="col-6">
                                        <label class="form-label">Question 4</label>
                                        <input type="text" class="form-control" placeholder="Subject/Heading">
                                      </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">Radio Question</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
