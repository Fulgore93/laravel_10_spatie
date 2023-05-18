
<form id="logout-form" action="{{ route('logout') }}" method="POST">
    {{ csrf_field() }}
    <input type="submit" value="Cerrar Sesión" style="width: 150px;"/>
</form>

<h1>redirect 2</h1>