<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="/css/app.css">
    <title>{{ $title ?? 'Welcome' }}</title>
    <style>
        body {
            background: rgb(56, 128, 99);
        }

        td,
        th {
            overflow: hidden;
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>

<body>
    {{ $slot }}

    <script>
        $(document).ready(function() {
            $(".search-input").on('keyup', function() {
                var _q = $(this).val(); // Inputdan qiymat olish

                if (_q.length >= 3) { // Faqat 3 ta harfdan keyin izlash
                    $.ajax({
                        url: "{{ route('search') }}",
                        type: "GET",
                        data: {
                            q: _q
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('.search-result tbody').html(
                                '<tr><td colspan="6">Loading...</td></tr>');
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                var tableRows = '';
                                $.each(response, function(index, post) {
                                    tableRows += `<tr>
                                        <td>${post.user_name}</td>
                                        <td>${post.title}</td>
                                        <td>${post.short_content}</td>
                                        <td><img src="${post.image_url}" style="width: 50px;"></td>
                                        <td>${post.created_at}</td>
                                        <td><a href="/posts/${post.slug}" class="btn btn-secondary">📖</a></td>
                                    </tr>`;
                                });
                                $('.search-result tbody').html(tableRows);
                            } else {
                                $('.search-result tbody').html(
                                    '<tr><td colspan="6">No results found</td></tr>');
                            }
                        },
                        error: function() {
                            $('.search-result tbody').html(
                                '<tr><td colspan="6">Error while searching</td></tr>');
                        }
                    });
                } else {
                    $('.search-result tbody').html(''); // 3 ta harfdan kam bo‘lsa, natijani tozalash
                }
            });
        });
    </script>


</body>

</html>
