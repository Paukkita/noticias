<div class="p-8">
    
<form method="POST" 
@if (Route::is('auth.register.get'))
    action="{{ route('auth.register.post') }}"
@else
    action="{{ route('auth.login.post') }}"
@endif
class="space-y-4"
>
@csrf   
@if ($errors->any())
<div class="p-4 bg-red-100 text-red-700 rounded">
    <h2 class="font-bold">Errores</h2>
    <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (Route::is('auth.register.get'))
<div>
    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
    <input type="text" id="name" value="{{old('name')}}" name="name"  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
</div>
@endif
<div>
    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
    <input type="email" id="email" value="{{old('email')}}" name="email"  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
</div>

<div>
    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
    <input type="password" id="password" name="password"  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
</div>

<div class="flex items-center justify-between">
    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">Iniciar Sesión</button>
</div>
</form>

</div>