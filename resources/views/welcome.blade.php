<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet"
          href="https://phonebook.cern.ch/phonebook/css/application.css?_debugResources=y&n=1539290187826">
    <style>

    </style>
</head>
<body>


<div id="app">
    <app></app>
</div>

<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>