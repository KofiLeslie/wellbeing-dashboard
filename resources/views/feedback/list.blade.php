@extends('layout.structure')
@include('layout.components')

@section('content')
  <div class="row">
    <div class="col-lg-12 mx-auto">
     <div class="card">
       <div class="card-header py-3 bg-transparent">
         <div class="d-sm-flex align-items-center">
           <h5 class="mb-2 mb-sm-0">Feedback</h5>

         </div>
        </div>
       <div class="card-body">
        @yield('alert')
          <div class="row g-3">
            <div class="col-12 col-lg-12">
               <div class="card shadow-none bg-light border">
                 <div class="card-body">
                   <form class="row g-3" method="post" action="{{ route('feedback.store') }}" enctype="multipart/form-data">
                    @csrf
                     <div class="col-12">
                       <label class="form-label">Subject</label>
                       <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject/Heading">
                     </div>

                     <div class="col-12">
                       <label class="form-label">Full description</label>
                       <textarea class="form-control" id="desc" name="desc" placeholder="Full description" rows="4" cols="4"></textarea>
                     </div>

                     <div class="col-12">
                       <label class="form-label">Additional File <small class="text-primary">Upload only images</small></label>
                       <input class="form-control" type="file" name="media">
                     </div>
                     <div class="ms-auto">
                        <button type="submit" class="btn btn-primary">Send</button>
                      </div>
                   </form>
                 </div>
               </div>
            </div>

          </div><!--end row-->
        </div>
       </div>
    </div>
 </div><!--end row-->
@endsection
