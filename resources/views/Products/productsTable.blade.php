@extends('Layouts.master')

@section('styles')
    <style>
        #myTable thead th,
        #myTable tbody td {
            text-align: center !important;
            vertical-align: middle !important;
        }
    </style>
@endsection



@section('content')
    <div class="container mt-5 mb-5">

        <a href="/addProduct" class="btn btn-primary d-flex align-items-center justify-content-center"
            style="height: 40px; width:150px">
            <i class="fas fa-plus"></i>
            اضافه منتج جديد
        </a>

        <table id="myTable" class="display table ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2 align-items-center">
                                <form action="{{ route('product.remove', $product->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="height: 40px;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>

                                <a href="/editProduct/{{ $product->id }}"
                                    class="btn btn-primary d-flex align-items-center justify-content-center"
                                    style="height: 40px;">
                                    <i class="fas fa-pen"></i>
                                    تعديل
                                </a>
                            </div>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable');
        });
    </script>
@endsection
