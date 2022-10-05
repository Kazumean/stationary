@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size: 1rem;">受注確認画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/orders') }}">戻る</a>
        </div>
    </div>
</div>

<div style="text-align: left;">
    <form action="{{ route('order.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-12 mb-2 mt-2 mb-2">
                <div class="form-group">
                    <select name="customer_id" class="form-select">
                        <option>客先を選択してください</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name}}</option>
                        @endforeach
                    </select>
                    @error('customer_id')
                    <span style="color: red;">客先を選択してください</span>
                    @enderror
                </div>
            </div>

            <div class="col-12 mb-2 mt-2 mb-2">
                <div class="form-group">
                    <select name="stationary_id" class="form-select">
                        <option>文房具を選択してください</option>
                        @foreach($stationaries as $stationary)
                        <option value="{{ $stationary->id }}">{{ $stationary->name }}</option>
                        @endforeach
                    </select>
                    @error('stationary_id')
                    <span style="color: red;">文房具を選択してください</span>
                    @enderror
                </div>
            </div>

            <div class="col-12 mb-2 mt-2">
                <div class="form-group">
                    <input type="text" name="quantity" class="form-control" placeholder="個数">
                    @error('quantity')
                    <span style="color: red;">個数を1〜12までの数値で入力してください</span>
                    @enderror
                </div>
            </div>

            <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">登録</button>
            </div>
        </div>
    </form>
</div>
@endsection