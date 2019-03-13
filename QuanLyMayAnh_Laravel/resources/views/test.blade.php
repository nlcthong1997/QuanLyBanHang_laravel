<form action="{{ route('xuly') }}" method="post">
    {!! csrf_field() !!}
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit">
</form>