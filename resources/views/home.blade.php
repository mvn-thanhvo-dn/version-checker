@extends('layouts.app')

@section('content')
<div class="main-container">
    <section class="main-top">
        <h1 class="heading-page-first">Phim Đang Chiếu</h1>
        <h3 class="heading-page-second"><a href="{{route('movie-coming')}}">PHIM SẮP CHIẾU</a></h3>
    </section>
    <section class="main-content">
        @if (isset($movies) && (count($movies) > 0))
            <ul class="movie-list">
            @for ($i = 0; $i < count($movies); $i++)
                <li class="movie-list-item">
                    <div class="movie-info">
                        <a href="/movie-detail/{{$movies[$i]->id}}">
                            <img src="{{asset('storage/'.$movies[$i]->images[0]->path)}}" class="movie-image">
                        </a>
                        <p class="movie-name">{{$movies[$i]->name}}</p>
                        <p class="movie-category"><b>Thể loại:</b>
                            @for ($j = 0; $j < min(count($movies[$i]->categories),3); $j++)
                                {{$movies[$i]->categories[$j]->name}},
                            @endfor 
                        </p>
                        <p class="movie-length"><b>Thời lượng:</b> {{$movies[$i]->length}} phút</p>
                        <p class="movie-release"><b>Khởi chiếu:</b> {{date('d-m-Y', strtotime($movies[$i]->release_at))}}</p>
                    </div>
                    <div class="movie-action">
                        <button class="btn-like">Like</button>
                        @isset(Auth::user()->role_id)
                        @if(Auth::user()->role_id == \App\Models\User::ROLE_CUSTOMER)
                            <button class="btn btn-buy" onclick="buyTicket()">MUA VÉ</button>
                        @elseif(Auth::user()->role_id == \App\Models\User::ROLE_ADMIN)
                            <button class="btn btn-buy"><a href="{{route('movie.edit',[$movies[$i]->id])}}">Sửa thông tin phim</a></button>
                        @endif
                            
                        @endisset
                    </div>
                </li>
            @endfor
            </ul>            
        @else
            <h3>Hiện không có phim nào đang chiếu</h3>
        @endif
    </section>
</div>
@endsection
<script>
    function buyTicket(){
        alert('Vui lòng chọn địa điểm Rạp bạn muốn!');
        window.location.href = '/cinema';    
    }
</script>
