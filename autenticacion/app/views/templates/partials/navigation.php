{% if auth %}
   <p>Hola, {{ auth.getFullNameOrUsername }}!</p>
{% endif %}

<ul>
    <li><a href="{{ urlFor('home') }}">Home</a> </li>

    {% if auth %}
    <li><a href="{{ urlFor('logout') }}">Salir</a></li>

    {% else %}
       <li><a href="{{ urlFor('register') }}">Registrar</a> </li>
       <li><a href="{{ urlFor('login') }}">Ingresar</a> </li>
    {% endif %}
</ul>