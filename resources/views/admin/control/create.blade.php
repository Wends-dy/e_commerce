<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        form{
            display: flex;
            flex-direction: column;
        }
        form button {
            width: 10%;
            padding: 10 15px;
            margin-top: 3px;
        }
        input ,
        textarea{
            width: 25%;
            margin-top: 5px;
            padding: 10px 15px
        }
    </style>
</head>
<body>
    <h1>Create New User</h1>
    
    <form action="{{ url('admin/create') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method()
        <input name="name" value="{{ old('name') }}" placeholder="Name">
        @error('name') 
            <p>{{ $message }}</p>
        @enderror
        
        <input name="email" value="{{ old('email') }}" placeholder="Email">
        @error('password') 
            <p>{{ $message }}</p>
        @enderror

        <input name="password" value="{{ old('password') }}" placeholder="Password">
        @error('password') 
            <p>{{ $message }}</p>
        @enderror

        <button type="submit" name="submit">Save</button>
        <a href="{{ url('admin') }}"class="btn">Back</a>
    </form>
    @if(session('success'))
    <div class="message success">
        {{ session('success') }}
    </div>
    @endif
</body>
</html>