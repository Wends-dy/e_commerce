<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        
        $users = User::with('roles')->get();
        $products = Product::all();

        return view('admin.user.table', compact('users','products'));
    }

    public function create(){
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        // Define validation rules
        $request->validate([
            'name' => 'required|string|min:3|unique:products,product_name',
            'email' => 'nullable|string',
            'password' =>'required', 'string', 'min:8', 'confirmed',
        ]);
    
        // Create a new product with validated data
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
    
        $user->save();
    
        return redirect('admin.user.create')->with('success', 'User created successfully.');
    }

    public function edit(int $id){
        $user = User::find($id);
        return view('admin.control.edit', compact('user'));
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|min:3|unique:products,product_name',
            'email' => 'nullable|string',
            'password' =>'nullable', 'string', 'min:8', 'confirmed',
        ]);

        $user = User::findOrFail($id);

       
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'price' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success','Product updated');
    }

    public function destroy(int $id)
    {
        // Attempt to find the product by ID
        $user = User::findOrFail($id);

        // Delete the product
        $user->delete();

        // Redirect back with a success message
        return redirect('admin')->with('status', 'Product deleted successfully!');
    }
}
