<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Yuborish</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">SMS Yuborish</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('send-sms') }}">
            @csrf
            <div class="mb-3">
                <label for="phone" class="form-label">Telefon raqami</label>
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="+998XXXXXXXXX"
                    required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Xabar</label>
                <textarea name="message" id="message" class="form-control" rows="5" placeholder="Xabar matnini kiriting..."
                    required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Yuborish</button>
        </form>
        @if (isset($response))
            @if ($response['status'] === 'waiting')
                <div style="color: blue;">📩 SMS jo‘natildi, provayder tasdiqlashini kuting...</div>
            @elseif($response['status'] === 'error')
                <div style="color: red;">❌ Xatolik: {{ $response['message'] }}</div>
            @else
                <div style="color: green;">✅ SMS muvaffaqiyatli jo‘natildi!</div>
            @endif
        @endif

    </div>
</body>

</html>
