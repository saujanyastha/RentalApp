<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment Method</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 4px; cursor: pointer; }
        .btn-primary { background-color: #007bff; color: white; border: none; }
        .btn-secondary { background-color: #6c757d; color: white; border: none; margin-left: 10px; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Payment Method: {{ $paymentMethod->method_name }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payment_methods.update', $paymentMethod->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="method_name">Method Name:</label>
                <input type="text" id="method_name" name="method_name" value="{{ old('method_name', $paymentMethod->method_name) }}" required>
                @error('method_name') <p class="error-message">{{ $message }}</p> @enderror
            </div>
            <div class="form-group">
                <label for="description">Description (Optional):</label>
                <textarea id="description" name="description" rows="4">{{ old('description', $paymentMethod->description) }}</textarea>
                @error('description') <p class="error-message">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Method</button>
            <a href="{{ route('payment_methods.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>