<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto py-12 px-6 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Bienvenido al Panel de Administración</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <!-- Gestión de usuarios -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Gestión de Usuarios</h3>
                <a href="{{ route('admin.manageUsers') }}" class="block bg-blue-500 text-white py-2 px-4 rounded-lg">Ir a usuarios</a>
            </div>

            <!-- Gestión de productos -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Gestión de Productos</h3>
                <a href="{{ route('admin.manageProducts') }}" class="block bg-green-500 text-white py-2 px-4 rounded-lg">Ir a productos</a>
            </div>

            <!-- Gestión de denuncias -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Gestión de Denuncias</h3>
                <a href="{{ route('admin.manageReports') }}" class="block bg-red-500 text-white py-2 px-4 rounded-lg">Ir a denuncias</a>
            </div>
        </div>
    </div>

</body>
</html>
