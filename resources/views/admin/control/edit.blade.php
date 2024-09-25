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
    <h1>Edit User</h1>
    
    <form action="{{ url('admin/'. $user->id.'/edit') }}" method="post">
        @csrf
        @method('PUT')
        
        <input name="name" value="{{ $user->name }}" placeholder="Name">
        @error('name') 
            <p>{{ $message }}</p>
        @enderror
        
        <input name="email" value="{{ $user->email }}" placeholder="Email">
        @error('password') 
            <p>{{ $message }}</p>
        @enderror

        <input name="password"  placeholder="Change password?">
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