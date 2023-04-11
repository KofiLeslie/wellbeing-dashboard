@extends('layout.structure')

@section('content')
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">

    <div class="col">
     <div class="card rounded-4 bg-primary">
       <div class="card-body">
        <a href="#" class="text-white">
         <div class="d-flex align-items-center">
           <div class="">
             <p class="mb-1">Physical Health</p>
             <h4 class="mb-0">Assessment</h4>
             <p class="mb-0 mt-2 font-13"><i class="bi bi-clock"></i><span>Last Visit: April 1, 2022</span></p>
           </div>
           <div class="ms-auto widget-icon text-primary">
             <i class="bi bi-activity"></i>
           </div>
         </div>
        </a>
       </div>
     </div>
    </div>

    <div class="col">
     <div class="card rounded-4 bg-success">
       <div class="card-body">
        <a href="#" class="text-white">
         <div class="d-flex align-items-center">
           <div class="">
             <p class="mb-1">Emotional Health</p>
             <h4 class="mb-0">Assessment</h4>
             <p class="mb-0 mt-2 font-13"><i class="bi bi-clock"></i><span>Last Visit: April 1, 2022</span></p>
           </div>
           <div class="ms-auto widget-icon  text-success">
             <i class="bi bi-emoji-heart-eyes-fill"></i>
           </div>
         </div>
        </a>
       </div>
     </div>
    </div>

    <div class="col">
     <div class="card rounded-4 bg-orange">
       <div class="card-body">
        <a href="#" class="text-white">
         <div class="d-flex align-items-center">
           <div class="">
             <p class="mb-1">Mental Health</p>
             <h4 class="mb-0">Assessment</h4>
             <p class="mb-0 mt-2 font-13"><i class="bi bi-clock"></i><span>Last Visit: April 1, 2022</span></p>
           </div>
           <div class="ms-auto widget-icon text-orange">
             <i class="bi bi-activity"></i>
           </div>
         </div>
        </a>
       </div>
     </div>
    </div>

    <div class="col">
     <div class="card rounded-4 bg-info">
       <div class="card-body">
        <a href="#" class="text-white">
         <div class="d-flex align-items-center">
           <div class="">
             <p class="mb-1">Social Wellbeing</p>
             <h4 class="mb-0">Assessment</h4>
             <p class="mb-0 mt-2 font-13"><i class="bi bi-clock"></i><span>Last Visit: April 1, 2022</span></p>
           </div>
           <div class="ms-auto widget-icon  text-info">
             <i class="bi bi-activity"></i>
           </div>
         </div>
        </a>
       </div>
     </div>
    </div>

</div><!--end row-->
    <div class="row">
       <div class="col-12 col-lg-4 col-xl-4 d-flex">
         <div class="card w-100 rounded-4">
           <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <h6 class="mb-0">Task Overview</h6>
              <div class="fs-5 ms-auto dropdown">
                 <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                   <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="#">Action</a></li>
                     <li><a class="dropdown-item" href="#">Another action</a></li>
                     <li><hr class="dropdown-divider"></li>
                     <li><a class="dropdown-item" href="#">Something else here</a></li>
                   </ul>
               </div>
             </div>
              <div id="chart2"></div>
           </div>
           <ul class="list-group list-group-flush mb-0 shadow-none">
             <li class="list-group-item bg-transparent border-top"><i class="bi bi-circle-fill me-2 font-weight-bold text-primary"></i> Complete <span class="float-end">120</span></li>
             <li class="list-group-item bg-transparent"><i class="bi bi-circle-fill me-2 font-weight-bold text-orange"></i> In Progress <span class="float-end">110</span></li>
             <li class="list-group-item bg-transparent"><i class="bi bi-circle-fill me-2 font-weight-bold text-info"></i> Started <span class="float-end">70</span></li>
           </ul>
         </div>
      </div>
    </div>
@endsection

@section('footerLinks')
  <script src="{{ asset('media/plugins/chartjs/js/Chart.min.js') }}"></script>
  <script src="{{ asset('media/plugins/chartjs/js/Chart.extension.js') }}"></script>
  <script src="{{ asset('media/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
  <script src="{{ asset('media/js/index.js') }}"></script>
@endsection
