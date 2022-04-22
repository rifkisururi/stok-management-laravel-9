<form method="POST" action="{{route('custom.login')}}">
    @csrf
    Email <input type="text" name="email"><br>
    Password <input type="password" name="password"><br>
    <button type="submit">Masuk</button>
</form>