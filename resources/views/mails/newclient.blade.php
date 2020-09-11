Sereno moreno,<br><br>

Se ha registrado un nuevo usuario: <br>
Nombre: {{ $client->name }} {{ $client->last_name }} <br>
Correo electrónico: {{ $client->email }} <br>
Telefono: {{ $client->phone }} <br>
Modo de preparación: {{ $client->grain_type }}<br>
Dirección: {{ $client->address }} {{ $client->pc }}<br>
Paquete: {{ \App\Models\Plan::find($client->plan_id)->name }}<br>
Favor de contactar a la brevedad, <br>

Saludos
