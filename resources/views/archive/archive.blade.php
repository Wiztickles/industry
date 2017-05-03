@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 flex-row flex-a-center flex-j-between head_btn">
            <h1 class="head_white">Archive</h1>
            @if(Auth::check())
                <a href="{{ url('/archive/create')}}" class="btn btn-default">Create a Post</a>
            @endif
        </div>
    </div>

    <div class="grid row gutter-20">
        <div class="grid-sizer col-lg-6 col-md-6 col-sm-6 col-xs-6 "></div>
            @foreach($archive as $item)
            <div class="grid-item col-lg-6 col-sm-6 col-xs-12 lg_top_mar">
                <div class="shad_tile grid-item-content">
                    <div class="row notice">
                        <div class="col-lg-12 col-sm-12 notice ">
                            <div class="notice_user flex-row flex-a-center">
                                <a href="{{ url('/profile')}}/{{$item->user->id}}" class="notice_user_link">
                                     <img src="/uploads/avatars/{{ $item->user->avatar }}" style="width:50px; height:50px;" class="img-circle">
                                </a>
                                <div>
                                    <a href="{{ url('/profile')}}/{{$item->user->id}}" class="notice_user_link">
                                        <h3>{{$item->user->first_name}} {{$item->user->last_name}}</h3>
                                    </a>
                                </div>
                            </div>
                            <div class=" notice_info">
                                
                                <a href="{{ url('/archive')}}/{{$item->id}}">
                                    <div class="notice_link">
                                        <h3>{{$item->title}}</h3>
                                        <p>{!! nl2br($item->description) !!}</p>
                                    </div>
                                    <div class="row lg_top_mar">
                                        <div class="col-lg-12 flex-row">
                                            @if(!empty($item->img_1) )
                                                <div class="sq_img">
                                                    <img src="/uploads/archive/{{ $item->img_1 }}" style="" class="img-responsive">
                                                </div>
                                            @endif
                                            @if(!empty($item->img_2) )
                                                <div class=" sq_img">
                                                    <img src="/uploads/archive/{{ $item->img_2 }}" style="" class="img-responsive">
                                                </div>
                                            @endif
                                            @if(!empty($item->img_3) )
                                                <div class=" sq_img">
                                                    <img src="/uploads/archive/{{ $item->img_3 }}" style="" class="img-responsive">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                                <div class="text-right">
                                    <p>{{$item->created_at->format('d/m/Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="flex-row flex-j-end paginate">
            {{ $archive->links() }}
        </div>
    </div> 
</div>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>

<script type="text/javascript">

var $grid = $('.grid').imagesLoaded(function() {
    $grid.masonry({
      itemSelector: '.grid-item', // use a separate class for itemSelector, other than .col-
      columnWidth: '.grid-sizer',
      percentPosition: true
    });

})



</script>


@endsection
