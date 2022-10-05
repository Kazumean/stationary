@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size: 1rem;">受注入力更新画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/orders') }}">戻る</a>
        </div>
    </div>
</div>

<div style="text-align: left;">
    <form action="{{ route('order.update', $order->id) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-12 mb-2 mt-2 mb-2">
                <div class="form-group">
                    <select name="customer_id" class="form-select">
                        <option>客先を選択してください</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @if($customer->id == $order->customer_id)selected @endif>{{ $customer->name }}</option>
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
                        <option value="{{ $stationary->id }}" @if($stationary->id == $order->stationary_id) selected @endif>{{ $stationary->name }}</option>
                        @endforeach
                    </select>
                    @error('stationary_id')
                    <span style="color: red">文房具を選択してください</span>
                    @enderror
                </div>
            </div>

            <div class="col-12 mb-2 mt-2 mb-2">
                <div class="form-group">
                    <input type="text" name="quantity" value="{{ $order->quantity }}" class="form-control" placeholder="個数">
                    @error('quantity')
                    <span style="color: red;">個数を1〜12までの数値で入力してください</span>
                    @enderror
                </div>
            </div>

            <div class="col-12 mb-2 mt-2 mb-2">
                <div class="form-group">
                    <select name="status_id" class="form-select">
                        <option>状態を選択してください</option>
                        @foreach($statuses as $status)
                        <option value="{{ $status->id }}" @if($status->id == $order->status) selected @endif>{{ $status->name }}</option>
                        @endforeach
                    </select>
                    @error('status_id')
                    <span style="color: red">状態を選択してください</span>
                    @enderror
                </div>
            </div>

            <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">変更</button>
            </div>
        </div>
    </form>
</div>
@endsection