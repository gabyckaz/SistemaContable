{% extends 'templates/default.php' %}

{% block title %}Ingresar{% endblock %}

{% block content %}
    <form ation="{{ urlFor('login.post') }}" method="post" autocomplete="off">
        <div>
            <label for="identifier">Usuario/email</label>
            <input type="text" name="identifier" id="identifier">
            {% if errors.first('identifier') %} {{ errors.first('identifier') }} {% endif %}
        </div>

        <div>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
            {% if errors.first('password') %} {{ errors.first('password') }} {% endif %}

        </div>

        <div>
            <input type="submit" value="Entrar">
        </div>

    </form>
{% endblock %}