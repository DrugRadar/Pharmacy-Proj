<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('css/landingpage.css')}}">
    <script src="{{asset('js/script.js')}}"></script>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>DrugRadar <i class='bx bxs-capsule capsule'></i></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <a href="{{route('dashboard.index')}}" data-text="Awesome" class="button" style="margin-top: 50px; cursor: pointer;">
                <span class="actual-text">&nbsp;Dashboard&nbsp;</span>
                <span class="hover-text" aria-hidden="true">&nbsp;Dashboard&nbsp;</span>
                <i class='bx bxs-chevrons-right' style="margin-left: -25px;"></i>
            </a>

        </div>
    </div>

</body>
</html>