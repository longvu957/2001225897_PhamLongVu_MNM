@extends('layouts.app')
@section('content')
    <h2>Danh sách sản phẩm</h2>
    <table>
        <tr><th>Tên</th><th>Giá</th><th>Danh mục</th></tr>
        @foreach($products as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ number_format($p->price, 0, ',', '.') }} đ</td>
                <td>{{ $p->category->name }}</td>
            </tr>
        @endforeach
    </table>
    {{ $products->links() }}
@endsection