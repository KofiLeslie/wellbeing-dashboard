@extends('layout.structure')
@section('content')
  <div class="row">
    <div class="col-lg-12 mx-auto">
     <div class="card">
       <div class="card-header py-3 bg-transparent">
         <div class="d-sm-flex align-items-center">
           <h5 class="mb-2 mb-sm-0">Feedback</h5>
           <div class="ms-auto">
             <button type="button" class="btn btn-primary">Send</button>
           </div>
         </div>
        </div>
       <div class="card-body">
          <div class="row g-3">
            <div class="col-12 col-lg-12">
               <div class="card shadow-none bg-light border">
                 <div class="card-body">
                   <form class="row g-3" method="post" action="#" enctype="multipart/form-data">
                    @csrf
                     <div class="col-12">
                       <label class="form-label">Subject</label>
                       <input type="text" class="form-control" placeholder="Subject/Heading">
                     </div>

                     <div class="col-12">
                       <label class="form-label">Full description</label>
                       <textarea class="form-control" placeholder="Full description" rows="4" cols="4"></textarea>
                     </div>

                     <div class="col-12">
                       <label class="form-label">Additional Files</label>
                       <input class="form-control" type="file" name="media[]" multiple>
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
