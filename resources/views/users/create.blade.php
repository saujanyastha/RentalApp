<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="email"], input[type="password"], input[type="url"], textarea, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Include padding in width */
        }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 4px; cursor: pointer; }
        .btn-primary { background-color: #007bff; color: white; border: none; }
        .btn-secondary { background-color: #6c757d; color: white; border: none; margin-left: 10px; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
        .form-row { display: flex; flex-wrap: wrap; gap: 15px; }
        .form-row > div { flex: 1 1 calc(50% - 15px); } /* Two columns */
    </style>
</head>
<body>
    <div class="container">
        <h1>Create New User</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    @error('password') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <label for="type_id">User Type:</label>
                <select id="type_id" name="type_id" required>
                    <option value="">Select User Type</option>
                    @foreach ($userTypes as $type)
                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->type_name }}
                        </option>
                    @endforeach
                </select>
                @error('type_id') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="personal_contactphone_number">Personal Phone:</label>
                    <input type="text" id="personal_contactphone_number" name="personal_contactphone_number" value="{{ old('personal_contactphone_number') }}">
                    @error('personal_contactphone_number') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="business_contactphone_number">Business Phone:</label>
                    <input type="text" id="business_contactphone_number" name="business_contactphone_number" value="{{ old('business_contactphone_number') }}">
                    @error('business_contactphone_number') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="altextra_phone_number">Alternative Phone:</label>
                <input type="text" id="altextra_phone_number" name="altextra_phone_number" value="{{ old('altextra_phone_number') }}">
                @error('altextra_phone_number') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="temporary_address">Temporary Address:</label>
                <input type="text" id="temporary_address" name="temporary_address" value="{{ old('temporary_address') }}">
                @error('temporary_address') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="permanent_address">Permanent Address:</label>
                <input type="text" id="permanent_address" name="permanent_address" value="{{ old('permanent_address') }}">
                @error('permanent_address') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="google_map_location">Google Map Link:</label>
                <input type="url" id="google_map_location" name="google_map_location" value="{{ old('google_map_location') }}">
                @error('google_map_location') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="facebook_link">Facebook Link:</label>
                <input type="url" id="facebook_link" name="facebook_link" value="{{ old('facebook_link') }}">
                @error('facebook_link') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="tiktok_link">TikTok Link:</label>
                <input type="url" id="tiktok_link" name="tiktok_link" value="{{ old('tiktok_link') }}">
                @error('tiktok_link') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="instagram_link">Instagram Link:</label>
                <input type="url" id="instagram_link" name="instagram_link" value="{{ old('instagram_link') }}">
                @error('instagram_link') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="note">Note:</label>
                <textarea id="note" name="note" rows="4">{{ old('note') }}</textarea>
                @error('note') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/*">
                @error('photo') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>