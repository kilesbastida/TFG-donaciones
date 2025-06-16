<!-- resources/views/admin/showdenuncia.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Resolver Denuncia #{{ $denuncia->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f9f9f9; }
        .container { max-width: 700px; margin: auto; background: #fff; padding: 20px; border-radius: 6px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
        h1 { margin-bottom: 20px; }
        .card { border: 1px solid #ddd; border-radius: 4px; margin-bottom: 20px; }
        .card-header { background: #007bff; color: white; padding: 10px 15px; font-weight: bold; border-radius: 4px 4px 0 0; }
        .card-body { padding: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; resize: vertical; font-size: 1rem;}
        .form-group { margin-bottom: 15px; }
        .btn { padding: 10px 20px; font-size: 1rem; border-radius: 4px; border: none; cursor: pointer; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-secondary { background-color: #6c757d; color: white; text-decoration: none; padding: 10px 20px; border-radius: 4px; display: inline-block; margin-left: 10px; }
        .btn-secondary:hover { background-color: #5a6268; }
        .alert { padding: 10px 15px; border-radius: 4px; margin-bottom: 20px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .invalid-feedback { color: #dc3545; font-size: 0.875rem; margin-top: 5px; }
        textarea.is-invalid { border-color: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Resolver Denuncia #{{ $denuncia->id }}</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header">Detalles de la Denuncia</div>
            <div class="card-body">
                <p><strong>Denunciante:</strong> {{ $denuncia->denunciante->name ?? 'N/A' }}</p>
                <p><strong>Denunciado:</strong> {{ $denuncia->denunciado->name ?? 'N/A' }}</p>
                <p><strong>Razón:</strong> {{ $denuncia->razon ?? 'No especificada' }}</p>
                <p><strong>Descripción:</strong> {{ $denuncia->descripcion ?? 'No hay descripción' }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($denuncia->estado) }}</p>
            </div>
        </div>

        <form action="{{ route('admin.denuncias.resolver', $denuncia->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="resolucion">Resolución <span style="color:red">*</span></label>
                <textarea name="resolucion" id="resolucion" rows="4" required class="@error('resolucion') is-invalid @enderror">{{ old('resolucion') }}</textarea>
                @error('resolucion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Resolver Denuncia</button>
            <a href="{{ route('admin.denuncias.activas') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</body>
</html>
