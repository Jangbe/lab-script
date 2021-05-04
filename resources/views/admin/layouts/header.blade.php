<!-- Header -->
<div class="header bg-primary pb-6 pt-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">{{__('Admin')}}</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                @foreach ($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item {{$loop->last?'active':''}}">
                    @if ($loop->last)
                        {{__($breadcrumb)}}
                    @else
                        <a href="#">{{__($breadcrumb)}}</a>
                    @endif
                </li>
                @endforeach
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right">
            {!! $text_right !!}
          </div>
          @if (session()->has('success'))
          <div class="col-12">
              <div class="alert bg-white text-primary alert-dismissible fade show" role="alert">
                {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-primary">&times;</span>
                </button>
              </div>
          </div>
          @endif
        </div>
      </div>
    </div>
</div>
