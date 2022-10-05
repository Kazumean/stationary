@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;">文房具マスター</h2>
            </div>
            <div class="text-right">
            @auth
            <a class="btn btn-success" href="{{ route('stationary.create') }}">新規登録</a>
            @endauth
            </div>
        </div>
    </div>

    <div class="row" style="text-align: right">
        <div class="col-lg-12">
            @auth
                ログイン者：{{ $user_name }}
            @endauth
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
        @if($message = Session::get('success'))
            <div class="alert alert-success mt-1">
                <p>{{ $message }}</p>
            </div>
        @endif
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th></th>
            <th></th>
            <th>編集者</th>
        </tr>

        @foreach($stationaries as $stationary)
        <tr>
            <td style="text-align: right">{{ $stationary->id }}</td>
            <td><a href="{{ route('stationary.show', $stationary->id) }}?page_id={{ $page_id }}">{{ $stationary->name }}</a></td>
            <td style="text-align: right">{{ $stationary->price }}円</td>
            <td style="text-align: left">{{ $stationary->category }}</td>
            <td style="text-align: center">
                @auth
                <a class="btn btn-primary" href="{{ route('stationary.edit', $stationary->id) }}">変更</a>
                @endauth
            </td>
            <td style="text-align: center">
                @auth
                <form action="{{ route('stationary.destroy', $stationary->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？")'>削除</button>
                </form>
                @endauth
            </td>
            <td>{{ $stationary->user_name }}</td>
        </tr>
        @endforeach
    </table>

    {!! $stationaries->links('pagination::bootstrap-5') !!}
@endsection