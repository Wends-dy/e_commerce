@extends('admin.app')

@section('content')
    <h1 class="font-xl mb-2">Your Orders</h1>

    <div class="overflow-auto ">  
        <table class="w-full">
            <thead class="bg-gray-50 border-gray-200 border-b-2">
                <tr >
                    <th class="p-2 font-semibold tracking-wide text-left">ID</th>
                    <th class="p-2 font-semibold tracking-wide text-left">Name</th>
                    <th class="p-2 font-semibold tracking-wide text-left">Status</th>
                    <th class="p-2 font-semibold tracking-wide text-left">Price</th>
                    <th class="p-2 font-semibold tracking-wide text-left">Orders</th>
                    <th class="w-32 p-2 font-semibold tracking-wide text-left">Action</th>
                </tr>
            </thead>
            @foreach ($products as $product)
                <tbody id="product-table-body" class="divide-y divide-gray-300  odd:bg-white even:bg-slate-100">
                    <td class="p-2 text-sm text-gray-700">
                        <a href="#" class="font-bold text-blue-700 hover:underline tracking-wider">{{ $product->id }}</a>
                    </td>
                    <td class="p-2 text-sm text-gray-700 text-left">{{ $product->product_name }}</td>
                    <td class="p-2 text-sm text-gray-700">
                        <span class="p-1.5 whitespace-nowrap tracking-wider rounded-lg"> of Stock</span></td>   
                    </td>
                    <td class="p-2 text-sm text-gray-700">{{ $product->price }}</td>
                    <td class="p-2 text-sm text-gray-700">$12</td>
                    <td class="p-2 inline-block text-sm text-gray-700 whitespace-nowrap">
                        <button class="p-1.5 uppercase  rounded-lg bg-red-500 text-white">delete</button>
                        <button class="p-1.5 uppercase  rounded-lg bg-yellow-400 text-white">edit</button>
                    </td>
                </tbody>
            @endforeach
        </table>
    </div>
@endsection