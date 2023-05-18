
<form id="logout-form" action="{{ route('logout') }}" method="POST">
    {{ csrf_field() }}
    <input type="submit" value="Cerrar Sesión" style="width: 150px;"/>
</form>

<h1>redirect 1</h1>

@can('redirect2')
    <a href="{{route('redirect2')}}">redirect2</a>
@endcan