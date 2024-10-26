<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tables</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      
    </script>
</head>
<body class="bg-gray-200">
    <header class="fixed flex flex-col items-start bg-white p-6 w-[200px] top-0 bottom-0 rounded-[30px]">
        <section class="flex items-center border-b-[1px] border-gray-500 pb-3 ">
            <div class="h-10 w-12 overflow-hidden rounded-full bg-black">
            </div>
            <div class="ml-3 bg">
                <p class="uppercase text-gray-700 text-xs">Admin</p>
                <p class="font-light tracking-wider text-lg">John Castino</p>
            </div>
        </section>

        <section class="">
            <p class="text-gray-700 text-sm font-semibold mt-5">main</p>
            <ul class="flex flex-col gap-1">
                <li class="hover:bg-slate-200 flex gap-2 pl-2 pr-20 py-2 rounded-lg">
                    <img class="w-6 " src="https://img.icons8.com/?size=100&id=ZMovPhcxNhyI&format=png&color=000000" alt="">
                    <a href="" class="text-gray-800">Dashboard</a>
                </li>
                <li class="hover:bg-slate-200 flex gap-2 pl-2 pr-20 py-2 rounded-lg">
                    <img class="w-6 " src="https://img.icons8.com/?size=100&id=85058&format=png&color=000000" alt="">
                    <a href="{{ url('admin/products') }}"  class="text-gray-800">Products</a>
                </li>
                <li class="hover:bg-slate-200 flex gap-2 pl-2 pl-2 pr-20 py-2 rounded-lg">
                    <img class="w-6" src="https://img.icons8.com/?size=100&id=cykh8BZMTKkb&format=png&color=000000" alt="">
                    <a  href="{{ url('admin/users') }}" class="text-gray-800">Users</a>
                </li>
                <li class="hover:bg-slate-200 flex gap-2 pl-2 pl-2 pr-20 py-2 rounded-lg">
                    <a  href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    {{ __('Logout') }} class="text-gray-800">Log out</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </section>
        
    </header>
   
    <div class="p-6 h-screen ml-[200px]">
        @yield('content')
    </div>
</body>

{{-- <script>
    const products = [
        {
            id: 1000,
            name: "CBR650r",
            stock: "low",
            date: "221",
            price: "4"
        },
        {
            id: 1001,
            name: "Spoon",
            stock: "out",
            date: "232",
            price: "12"
        },
        {
            id: 1002,
            name: "Phone",
            stock: "low",
            date: "53",
            price: "6"
        },
    ];

    const productTableBody = document.getElementById('product-table-body'); // Ensure your tbody has this ID

    // Function to render products in the table
    function renderProducts() {
        productTableBody.innerHTML = ''; // Clear existing rows
        products.forEach((product) => {
            const row = document.createElement('tr');
            row.className = 'odd:bg-white even:bg-slate-100';

            row.innerHTML = `
                <td class="p-2 text-sm text-gray-700">
                    <a href="#" class="font-bold text-blue-700 hover:underline tracking-wider">${product.id}</a>
                </td>
                <td class="p-2 text-sm text-gray-700 text-left">${product.name}</td>
                <td class="p-2 text-sm text-gray-700">
                    <span class="p-1.5 whitespace-nowrap tracking-wider rounded-lg ${getStatusClass(product.stock)}">${product.stock} of Stock</span></td>   
                </td>
                <td class="p-2 text-sm text-gray-700">${product.date}</td>
                <td class="p-2 text-sm text-gray-700">${product.price}</td>
                <td class="p-2 inline-block text-sm text-gray-700 whitespace-nowrap">
                    <button class="p-1.5 uppercase  rounded-lg bg-red-500 text-white">delete</button>
                    <button class="p-1.5 uppercase  rounded-lg bg-yellow-400 text-white">edit</button>
                </td>
            `;

            productTableBody.appendChild(row);
        });
    }

    // Function to get status class based on stock status
    function getStatusClass(status) {
        switch (status) {
            case 'hello':
                return 'bg-green-200 text-green-800 bg-opacity-60';
            case 'low':
                return 'bg-yellow-200 text-yellow-800 bg-opacity-60';
            case 'out':
                return 'bg-red-200 text-red-800 bg-opacity-60';
            default:
                return '';
        }
    }

    // Call the function to render products when the page loads
    renderProducts();
    </script> --}}
</html>