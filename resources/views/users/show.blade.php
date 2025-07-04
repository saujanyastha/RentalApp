<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
        h1 { margin-bottom: 20px; }
        .detail-row { margin-bottom: 10px; }
        .detail-row strong { display: inline-block; width: 150px; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .user-photo { max-width: 200px; height: auto; border-radius: 8px; margin-top: 10px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Details: {{ $user->name }}</h1>

        <div class="detail-row">
            <strong>ID:</strong> {{ $user->id }}
        </div>
        <div class="detail-row">
            <strong>Name:</strong> {{ $user->name }}
        </div>
        <div class="detail-row">
            <strong>Email:</strong> {{ $user->email }}
        </div>
        <div class="detail-row">
            <strong>User Type:</strong> {{ $user->userType ? $user->userType->type_name : 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Personal Phone:</strong> {{ $user->personal_contactphone_number ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Business Phone:</strong> {{ $user->business_contactphone_number ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Alternative Phone:</strong> {{ $user->altextra_phone_number ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Temporary Address:</strong> {{ $user->temporary_address ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Permanent Address:</strong> {{ $user->permanent_address ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Google Map Link:</strong>
            @if ($user->google_map_location)
                <a href="{{ $user->google_map_location }}" target="_blank">{{ $user->google_map_location }}</a>
            @else
                N/A
            @endif
        </div>
        <div class="detail-row">
            <strong>Facebook Link:</strong>
            @if ($user->facebook_link)
                <a href="{{ $user->facebook_link }}" target="_blank">{{ $user->facebook_link }}</a>
            @else
                N/A
            @endif
        </div>
        <div class="detail-row">
            <strong>TikTok Link:</strong>
            @if ($user->tiktok_link)
                <a href="{{ $user->tiktok_link }}" target="_blank">{{ $user->tiktok_link }}</a>
            @else
                N/A
            @endif
        </div>
        <div class="detail-row">
            <strong>Instagram Link:</strong>
            @if ($user->instagram_link)
                <a href="{{ $user->instagram_link }}" target="_blank">{{ $user->instagram_link }}</a>
            @else
                N/A
            @endif
        </div>
        <div class="detail-row">
            <strong>Note:</strong> {{ $user->note ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Photo:</strong>
            @if ($user->photo)
                <br><img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo" class="user-photo">
            @else
                N/A
            @endif
        </div>

        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit User</a>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users List</a>
    </div>
</body>
</html>