<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<style>
    .pin-code {
        padding: 0;
        margin: 0 auto;
        display: flex;
        justify-content: center;

    }
    .pin-code input {
        border: none;
        text-align: center;
        width: 48px;
        height: 48px;
        font-size: 36px;
        background-color: #F3F3F3;
        margin-right: 5px;
    }

    .pin-code input:focus {
        border: 1px solid #573D8B;
        outline: none;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

@yield('content')
</body>
</html>
@yield('script')
