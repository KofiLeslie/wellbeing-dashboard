@extends('questions.structure')
@include('layout.components')

@section('headerLinks')
    <link href="{{ asset('media/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('media/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('media/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <form action="#" method="post" enctype="multipart/form-data" id="myform" name="myform">
        @csrf
        <input type="hidden" name="_method">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <h6 class="mb-0 text-uppercase">Psychological Wellbeing Assessment</h6>
                <hr />
                <div class="card">
                    <div class="card-body">
                        @yield('alert')
                        {{-- insert content here --}}
                        <div class="col">
                            <div class="row row-cols-auto g-3 pb-2">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#newSocial">New Question</button>
                                <!-- Modal -->
                                <div class="modal fade" id="newSocial" tabindex="-1" aria-labelledby="newSocialLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="newSocialLabel">New Question</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="form-label" for="question">Question</label>
                                                        <input id="question" name="question" type="text"
                                                            class="form-control" placeholder="QUESTION HERE">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="qstGroup" class="form-label">Question Group</label>
                                                        <select class="form-control" id="qstGroup" name="qstGroup">
                                                            <option selected disabled>--SELECT GROUP--</option>
                                                            <option value="thoughts">Social
                                                                Connectedness/Integration</option>
                                                            <option value="feelings">Feelings
                                                            </option>
                                                            <option value="somatic">Somatic</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button"
                                                    onclick="$('#myform').attr('action','{{ route('mental.save') }}');$('#myform').submit();"
                                                    class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th>Question</th>
                                                <th>Question Group</th>
                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @forelse ($physical as $item)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $item->question }}</td>
                                                    <td>{{ ucwords($item->question_group) }}</td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                            <a href="javascript:;" class="text-warning"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editSocial{{ $item->id }}">
                                                                <i class="bi bi-pencil-fill"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                onclick="$('#myform').attr('action','{{ url('mental/delete', $item->id) }}');$('#myform').submit();"
                                                                class="text-danger" data-bs-toggle="tooltip"
                                                                data-bs-placement="bottom" title="Delete">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </a>
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="editSocial{{ $item->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="editSocial{{ $item->id }}Label"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editSocial{{ $item->id }}Label">
                                                                            Update Question</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <label class="form-label"
                                                                                    for="question{{ $item->id }}">Question</label>
                                                                                <input id="question{{ $item->id }}"
                                                                                    name="question{{ $item->id }}"
                                                                                    type="text" class="form-control"
                                                                                    placeholder="QUESTION HERE"
                                                                                    value="{{ $item->question }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <label for="qstGroup{{ $item->id }}"
                                                                                    class="form-label">Question
                                                                                    Group</label>
                                                                                <select class="form-control"
                                                                                    id="qstGroup{{ $item->id }}"
                                                                                    name="qstGroup{{ $item->id }}">
                                                                                    <option disabled>--SELECT GROUP--
                                                                                    </option>
                                                                                    <option
                                                                                        value="thoughts"
                                                                                        {{ $item->question_group == 'thoughts' ? 'selected' : '' }}>
                                                                                        Thoughts
                                                                                    </option>
                                                                                    <option value="feelings"
                                                                                        {{ $item->question_group == 'feelings' ? 'selected' : '' }}>
                                                                                        Feelings
                                                                                    </option>
                                                                                    <option value="somatic"
                                                                                        {{ $item->question_group == 'somatic' ? 'selected' : '' }}>
                                                                                        Somatic</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="button"
                                                                            onclick="changeMethod();$('#myform').attr('action','{{ url('mental', [$item->id]) }}');$('#myform').submit();"
                                                                            class="btn btn-primary">Save Changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" align="center">No Data Available</td>
                                                </tr>
                                            @endforelse


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Question</th>
                                                <th>Question Group</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
    {{-- select2 --}}
    <script src="{{ asset('media/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('media/js/form-select2.js') }}"></script>
    {{-- select2 --}}
    <script src="{{ asset('media/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('media/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('media/js/table-datatable.js') }}"></script>
    <script>
        function changeMethod() {
            $('input[name="_method"]').val('patch');
        }
    </script>
@endsection
