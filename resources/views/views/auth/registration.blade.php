<form method="POST" action="{{route('custom.registration')}}">
    @csrf
    Name <input type="text" name="name"><br>
    Email <input type="text" name="email"><br>
    Password <input type="password" name="password"><br>
    Role <input type="text" name="role"><br>
    <button type="submit">Masuk</button>
</form>