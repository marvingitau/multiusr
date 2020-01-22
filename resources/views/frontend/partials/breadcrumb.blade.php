<section class="inner-page-banner-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-page-banner-content text-center">
                    <h2 class="title"> {{__(ucfirst($title))}}</h2>
                </div>
                <nav aria-label="breadcrumb" class="page-header-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        @foreach($item as $key=>$value)
                            @if($value !== null)
                                <li class="breadcrumb-item" aria-current="page"><a href="{{$value}}">{{__(ucfirst($key))}}</a></li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{__(ucfirst($key))}}</li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>