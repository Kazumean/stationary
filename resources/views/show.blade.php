@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">文房具詳細画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/stationaries') }}?page={{ $page_id }}">戻る</a>
        </div>
    </div>
</div>

<div style="text-align: left;">

    <div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                {{ $stationary->name }}
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                {{ $stationary->price }}
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                    @foreach($categories as $category)
                        @if($category->id == $stationary->category) {{ $category->str }} @endif
                    @endforeach
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                {{ $stationary->detail }}
            </div>
        </div>
    </div>
</div>
@endsection