<!-- resources/views/image/uploadqr.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo QR từ URL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl mb-4">Tạo QR Code từ URL</h1>

        @if (session('qr_code'))
            <div class="mb-4">
                <h2 class="text-lg">QR Code:</h2>
                <img src="{{ session('qr_code') }}" alt="QR Code" class="w-48 h-48">
            </div>
            <a href="{{ session('image_url') }}" class="bg-blue-500 text-white py-2 px-4 rounded" download>Tải ảnh về</a>
        @endif

        <form action="{{ route('qr.create') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="image_url" class="form-label">Nhập URL ảnh</label>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Tạo QR Code</button>
        </form>
    </div>
</body>
</html>
