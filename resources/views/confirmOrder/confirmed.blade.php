<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    </head>
    <style>
    body{
        height: 100vh;
         }
            .view {
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          background-color: #F4F6F6;
          height: 100vh
        }

        .card {
          display: flex;
          flex-shrink: 1;
          flex-direction: row;
          width: calc(100vh - 2 * 1rem);
          height: calc(55vh - 2 * 1.25rem);
          background-color: #fff;
          box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.2);
          border-radius: 1.5rem;
          padding: 1.25rem 1rem;
        }

        .wraper {
          display: flex;
          flex-direction: row;
          flex: 1
        }

        .left-panel {
          display: flex;
          align-items: center;
          flex-direction: column;
          justify-content: center;
        }

        .media-wrapper {
          display: flex;
          height: 35vh;
          width: 35vh;
        }

        .media {
          display: flex;
          flex: 1;
          flex-direction: column;
          height: 100%
        }

        .figure {
          display: flex;
          flex: 1;
          margin: 0;
          background: no-repeat center/contain
        }

        .right-panel {
          display: flex;
          flex: 1;
          flex-direction: column;
          margin-top: 1.5rem;
          align-items: center;
        }

        .right-panel > p {
          text-align: center;
        }

    /* .card, .card-header, .card-body {
        background: transparent !important;
        font-family: monospace !important;
        font-size: 20px !important;
    }
    .blurred-box{
        position: relative;
        width: 400px;
        height: 350px;
        top: calc(50% - 175px);
        left: calc(50% - 270px);
        background: transparent;
        border-radius: 2px;
        overflow: hidden;
    }

    .blurred-box:after{
        content: '';
        width: 300px;
        height: 300px;
        background: inherit;
        position: absolute;
        left: -25px;
        left: position;
        right: 0;
        top: -25px;
        top :position;
        bottom: 0;
        box-shadow: inset 0 0 0 200px rgba(255,255,255,0.05);
        filter: blur(10px);
    }
    .bulb svg {
        display: block;
        height: 90px;
        transform-origin: center top;
        animation: swing_31 1.3s ease-in-out infinite alternate;
    }

    @keyframes swing_31 {
        0% {
            transform: rotate(18deg);
        }

        100% {
            transform: rotate(-18deg);
        }
    } */
    </style>
    <body class="d-flex justify-content-center align-items-center">
    <div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card blurred-box">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('order confirmed!') }}

                    <div class="bulb mt-5">
                        <svg width="60pt" height="60pt" version="1.1" viewBox="0 0 1200 1200" xmlns="http://www.w3.org/2000/svg">
                            <g>
                            <path d="m930 552.86h-660c-6.9297 0-13.191-4.168-15.836-10.582-2.6602-6.4102-1.1875-13.777 3.7148-18.684l289.72-289.7c4.1367-4.1367 10.078-5.875 15.836-4.6211 5.707 1.2734 10.379 5.375 12.387 10.883 3.7031 10.164 13.43 16.996 24.176 16.996s20.473-6.832 24.191-17.008c2.0078-5.5078 6.6797-9.5938 12.406-10.863 5.6602-1.2539 11.668 0.48437 15.82 4.6211l289.7 289.7c4.9062 4.9062 6.3789 12.27 3.7148 18.684-2.6445 6.4062-8.9062 10.574-15.836 10.574zm-618.62-34.285h577.23l-245.5-245.51c-11.102 11.469-26.586 18.367-43.109 18.367-16.539 0-32.008-6.8984-43.109-18.348z"></path>
                            <path d="m986.48 1028.6h-772.97c-23.203 0-42.086-18.883-42.086-42.086v-425.82c0-23.203 18.883-42.09 42.086-42.09h772.97c23.203 0 42.086 18.887 42.086 42.09v425.82c0 23.203-18.883 42.086-42.086 42.086zm-772.97-475.71c-4.3008 0-7.8008 3.5-7.8008 7.8047v425.82c0 4.3008 3.5 7.8008 7.8008 7.8008h772.97c4.3008 0 7.8008-3.5 7.8008-7.8008v-425.82c0-4.3047-3.5-7.8047-7.8008-7.8047z"></path>
                            <path d="m599.92 935.74c-89.332 0-162-72.758-162-162.17 0-89.414 72.672-162.17 162-162.17 89.414 0 162.17 72.758 162.17 162.17-0.003906 89.414-72.758 162.17-162.17 162.17zm0-290.05c-70.43 0-127.72 57.371-127.72 127.89 0 70.512 57.289 127.89 127.72 127.89 70.512 0 127.89-57.371 127.89-127.89-0.003907-70.516-57.375-127.89-127.89-127.89z"></path>
                            <path d="m576.71 838.07c-4.5547 0-8.9062-1.8086-12.121-5.0234l-48.113-48.129c-6.6953-6.6953-6.6953-17.543 0-24.242 6.6953-6.6953 17.543-6.6953 24.242 0l35.992 36.012 82.582-82.582c6.6953-6.6953 17.543-6.6953 24.242 0 6.6953 6.6953 6.6953 17.543 0 24.242l-94.703 94.703c-3.2148 3.2109-7.5703 5.0195-12.121 5.0195z"></path>
                            <path d="m600 291.43c-25.113 0-47.777-15.887-56.383-39.559-2.3633-6.1445-3.6172-13.125-3.6172-20.441 0-33.082 26.918-60 60-60s60 26.918 60 60c0 7.3477-1.2383 14.312-3.6992 20.727-8.5391 23.387-31.207 39.273-56.301 39.273zm0-85.715c-14.18 0-25.715 11.535-25.715 25.715 0 3.0625 0.50391 5.9766 1.4414 8.4375 3.8008 10.445 13.527 17.277 24.273 17.277s20.473-6.832 24.191-17.008c1.0391-2.6992 1.5234-5.6094 1.5234-8.707 0-14.18-11.535-25.715-25.715-25.715z"></path>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
        <div class='view'>
          <div class='card'>
            <div class='wraper'>
              <div class='left-panel'>
                <div class='media-wrapper'>
                  <div class='media'>
                    <figure class='figure' style='background-image: url("https://js2.pngtree.com/v3/images/home/paradrop.png");'></figure>
                  </div>
                </div>
              </div>
              <div class='right-panel'>
                <h3>Confirmação de email</h3>
                <p>Guilherme Oliveira sua conta foi registrada com sucesso. Para realizar o acesso confirme o email que enviamos para guilhermefos.compras@gmail.com</p>
              </div>
            </div>
          </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
    </body>
</html>
