<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    {{-- <link
            rel="apple-touch-icon"
            sizes="76x76"
            href="../assets/img/apple-icon.png"
        /> --}}
    {{-- <link rel="icon" type="image/png" href="../assets/img/icons/logoImg.png" /> --}}
    <title>Material Dashboard 2 by Creative Tim</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    {{-- <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="assets/css/nucleo-svg.css" rel="stylesheet" /> --}}
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{URL::asset('css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="{{asset('css/DarkToggleStyle.css')}}">
    <link rel="stylesheet" href="{{asset('css/logo.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- DataTables CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" /> -->


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body class="g-sidenav-show bg-gray-200">
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" {{route('dashboard.index')}}" target="_parent" target="_blank">
                <div class="logo-container" style="display:flex;">
                    <svg width="100" height="100" style="background:transparent;" viewBox="120 140 790 700">
                        <defs id="defs6">
                            <clipPath id="clipPath18" clipPathUnits="userSpaceOnUse">
                                <path id="path20"
                                    d="m 0,0 c 1336.44,0 2672.87,0 4009.3,0 1330.23,0 2660.47,0 3990.7,0 0,1330.23 0,2660.47 0,3990.7 0,1336.43 0,2672.86 0,4009.3 -1330.23,0 -2660.47,0 -3990.7,0 -1336.43,0 -2672.86,0 -4009.3,0 C 0,6663.56 0,5327.13 0,3990.7 0,2660.47 0,1330.23 0,0 Z" />
                            </clipPath>
                            <clipPath id="clipPath24" clipPathUnits="userSpaceOnUse">
                                <path id="path26"
                                    d="m 0,0 c 1336.44,0 2672.87,0 4009.3,0 1330.23,0 2660.47,0 3990.7,0 0,1330.23 0,2660.47 0,3990.7 0,1336.43 0,2672.86 0,4009.3 -1330.23,0 -2660.47,0 -3990.7,0 -1336.43,0 -2672.86,0 -4009.3,0 C 0,6663.56 0,5327.13 0,3990.7 0,2660.47 0,1330.23 0,0" />
                            </clipPath>
                        </defs>

                        <g xmlns="http://www.w3.org/2000/svg" transform="matrix(1.25,0,0,-1.25,0,1000)" id="g10">
                            <g transform="scale(0.1,0.1)" id="g12">
                                <g id="g14">
                                    <g clip-path="url(#clipPath18)" id="g16">
                                        <g clip-path="url(#clipPath24)" id="g22">
                                            <g transform="matrix(10,0,0,-10,-77910.7,85910.7)" id="g28"> </g>
                                        </g>
                                    </g>
                                </g>
                                <!-- wings -->
                                <path id="path258"
                                    d="m 3871.78,5899.22 c -68.11,1.71 -142.08,7.96 -162.24,26.28 -39.78,36.17 -68.72,112.13 -75.96,206.17 -7.23,94.05 -10.85,426.82 -343.62,455.76 -332.76,28.93 -524.47,-159.15 -817.45,-307.45 -292.99,-148.31 -907.89,-444.9 -1284.06,-524.48 -301.177,-63.71 183.61,-71.77 439.01,-57.6 159.91,74.15 1122.39,519.97 1303.58,592.32 0,0 -851.74,-429.25 -1292.55,-653.83 -57.77,-40.19 -110,-85.29 -88.33,-105.14 32.18,-29.51 299,-49.02 514.45,-23.24 136.75,58.14 642.35,275.45 905.61,420.81 0,0 -528.41,-309.24 -837.59,-439.87 -84.22,-47.53 -173.89,-110.59 -141.19,-149.41 44.99,-53.42 336.89,-30.33 512.25,23.37 120.69,73.06 421.65,256.64 506.02,321.18 7.13,5.65 11.15,8.86 11.15,8.86 -3.08,-2.6 -6.94,-5.63 -11.15,-8.86 -51.59,-40.82 -275.42,-216.35 -465.25,-341.16 -47.07,-53.93 -91.88,-123.96 -46.64,-158.93 69.22,-53.48 299.87,32.6 446.84,110.67 70.24,57.95 189.42,160.04 235.35,222.1 0,0 -86.95,-123.83 -215.13,-240.76 -44.62,-64.15 -105.81,-168.76 -61.94,-207.75 54.31,-48.27 226.82,9.15 330.86,79.91 38.66,45.16 102.18,123.5 132.49,184.13 0,0 -35.72,-114.2 -105.85,-204.37 -11.29,-41.62 -12.5,-92.25 36.76,-113.93 79.14,-34.82 166.6,13.48 245.4,91.55 24.62,35.7 58.48,87.13 82.31,132.71 0,0 -34.05,-89.48 -68.45,-157.98 -4.99,-30.49 -1.79,-63.9 30.1,-77.77 44.15,-19.18 199.54,33.56 296.26,204.36 l -11.04,692.35" />
                                <path id="path260"
                                    d="m 3887.77,5838.12 c -0.01,0.18 -26.08,0.38 -28.56,0.43 -34.58,0.8 -69.29,2.42 -103.58,7.11 -10.51,1.45 -21.01,3.22 -31.36,5.58 -34.86,7.93 -45.45,19.94 -55.09,30.74 -38.85,43.54 -64.73,118.5 -71.7,209.13 -0.39,5.02 -0.76,10.7 -1.18,16.99 -7.1,107.48 -25.97,393 -322.69,418.81 -22.07,1.91 -44.14,2.89 -65.56,2.89 -23.66,0 -47.31,-1.2 -70.83,-3.67 -166.39,-17.47 -300.9,-104.78 -446.11,-178.22 -8.58,-4.33 -17.17,-8.62 -25.77,-12.91 -23.14,-11.56 -46.32,-23.06 -69.49,-34.54 -35.93,-17.78 -71.65,-36.23 -108.12,-52.91 -61.47,-28.15 -113.11,-51.17 -113.12,-51.38 -0.03,-0.62 50.84,20.06 112.45,46.28 35.65,15.17 70.5,32.5 105.54,49 79.31,37.35 156.12,78.77 234.69,117.59 72.67,35.91 148.32,66.38 227.83,83.23 50.25,10.64 101.56,15.83 152.93,15.83 20.77,0 42.2,-0.95 63.7,-2.81 278.16,-24.19 295.5,-286.58 302.9,-398.62 0.46,-6.98 0.82,-12.42 1.19,-17.23 5.16,-66.98 19.71,-147.13 58.72,-202.83 40.54,-57.88 78.35,-57.24 145.47,-65.52 10.66,-1.31 108.73,-5.71 108.69,-4.67 -0.23,7.23 -0.55,14.46 -0.95,21.7" />
                                <path id="path262"
                                    d="m 6811.55,5753.25 c -376.18,79.57 -991.08,376.17 -1284.06,524.47 -292.99,148.3 -484.69,336.39 -817.46,307.45 -332.76,-28.93 -336.39,-361.7 -343.62,-455.75 -7.23,-94.04 -36.17,-170 -75.96,-206.17 -20.62,-18.74 -97.5,-24.85 -166.87,-26.38 l -15.4,-675.65 c 95.78,-183.98 259.7,-240.76 305.26,-220.96 31.89,13.87 35.09,47.28 30.1,77.77 -34.4,68.5 -68.45,157.98 -68.45,157.98 23.82,-45.59 57.7,-97.02 82.31,-132.71 78.8,-78.07 166.26,-126.37 245.4,-91.55 49.25,21.67 48.05,72.3 36.76,113.93 -70.12,90.16 -105.85,204.37 -105.85,204.37 30.31,-60.63 93.84,-138.97 132.5,-184.13 104.04,-70.76 276.55,-128.19 330.85,-79.91 43.87,38.99 -17.32,143.59 -61.94,207.74 -128.19,116.93 -215.13,240.77 -215.13,240.77 45.93,-62.06 165.11,-164.15 235.36,-222.1 146.97,-78.07 377.62,-164.15 446.82,-110.67 45.25,34.97 0.46,105 -46.62,158.93 -189.85,124.8 -413.66,300.34 -465.25,341.16 -4.22,3.23 -8.08,6.26 -11.16,8.86 0,0 4.03,-3.21 11.16,-8.86 84.35,-64.55 385.33,-248.12 506.02,-321.19 175.34,-53.69 467.25,-76.79 512.24,-23.36 32.7,38.82 -56.97,101.88 -141.18,149.4 -309.18,130.63 -837.6,439.87 -837.6,439.87 263.27,-145.36 768.87,-362.66 905.62,-420.81 215.44,-25.77 482.26,-6.26 514.44,23.24 21.67,19.86 -30.56,64.95 -88.32,105.14 -440.82,224.59 -1292.55,653.83 -1292.55,653.83 181.18,-72.35 1143.68,-518.17 1303.57,-592.32 255.42,-14.16 740.18,-6.1 439.01,57.61" />
                                <path id="path264"
                                    d="m 4112.23,5835.87 c 0.02,0.17 26.08,0.37 28.57,0.43 34.57,0.79 69.29,2.42 103.57,7.11 10.52,1.44 21.02,3.22 31.36,5.57 34.86,7.94 45.45,19.94 55.09,30.75 38.86,43.53 64.73,118.5 71.71,209.13 0.39,5.01 0.76,10.7 1.18,16.98 7.09,107.49 25.96,393.01 322.69,418.82 22.07,1.91 44.14,2.89 65.55,2.89 23.66,0 47.31,-1.2 70.83,-3.68 166.4,-17.47 300.91,-104.77 446.11,-178.22 8.58,-4.32 17.17,-8.61 25.77,-12.9 23.14,-11.56 46.31,-23.06 69.5,-34.54 35.93,-17.78 71.64,-36.24 108.1,-52.91 61.49,-28.15 113.12,-51.17 113.13,-51.38 0.03,-0.62 -50.84,20.05 -112.45,46.28 -35.65,15.16 -70.49,32.49 -105.54,48.99 -79.3,37.35 -156.12,78.78 -234.68,117.59 -72.66,35.92 -148.32,66.38 -227.84,83.23 -50.25,10.64 -101.55,15.83 -152.93,15.83 -20.77,0 -42.2,-0.94 -63.69,-2.81 -278.17,-24.19 -295.5,-286.57 -302.9,-398.62 -0.46,-6.97 -0.82,-12.41 -1.19,-17.23 -5.17,-66.97 -19.71,-147.13 -58.72,-202.83 -40.55,-57.87 -78.36,-57.23 -145.47,-65.52 -10.67,-1.31 -108.74,-5.71 -108.7,-4.66 0.24,7.22 0.56,14.46 0.95,21.7" />
                                <!-- white bta3 -->
                                <path id="path266"
                                    d="m 3846.7,6197.07 c -8.69,-6.55 -14.61,-18.73 -14.61,-32.84 0,-20.97 12.92,-37.98 28.88,-37.98 l 112.34,0 c -50.93,6.59 -95.77,32.74 -126.61,70.82" />
                                <path id="path268"
                                    d="m 4150.24,6197.07 c -30.84,-38.08 -75.68,-64.23 -126.61,-70.82 l 112.35,0 c 15.95,0 28.88,17.01 28.88,37.98 0,14.11 -5.92,26.29 -14.62,32.84" />
                                <path id="path270"
                                    d="m 4172.09,6319.76 c 0,-95.88 -77.73,-173.62 -173.62,-173.62 -95.88,0 -173.62,77.74 -173.62,173.62 0,95.89 77.74,173.62 173.62,173.62 95.89,0 173.62,-77.73 173.62,-173.62" />
                                <path id="path272"
                                    d="m 3931.43,3564.95 c 31.05,22.12 63.13,44.78 94.82,67.14 7.78,5.48 15.59,11 23.4,16.5 l 8.62,378.27 c -37.39,15.47 -83.62,32.9 -135.05,51.81 l 8.21,-513.72" />
                                <path id="path274"
                                    d="m 4024.77,2557.44 c -23.98,24.4 -50.9,50.54 -78.49,76.46 l 8.99,-564.43 c 19.2,27.64 39.74,54.19 60.2,79.97 l 9.3,408" />
                                <path id="path276"
                                    d="m 4030.1,2790.69 13.77,604.3 c -41.09,-27.26 -77.34,-52.18 -108.54,-75.39 l 7.05,-441.29 c 28.5,-29.28 58.41,-58.82 87.72,-87.62" />
                                <path id="path278"
                                    d="m 3990.32,4303.89 c 23.88,-11.08 48.52,-22.53 73.49,-34.24 l 43.02,1887.73 c -31.03,-20.78 -68.29,-32.94 -108.36,-32.94 -40.08,0 -77.37,12.18 -108.41,32.97 l 29.04,-1820.33 c 22.84,-10.73 46.64,-21.78 71.22,-33.19" />
                                <path id="path280"
                                    d="m 4005.76,1946.68 c -19.35,-25.41 -34.93,-50.98 -47.31,-75.96 l 6.46,-405.06 16.96,-56.06 18.01,56.06 11.12,487.64 c -1.73,-2.2 -3.56,-4.42 -5.24,-6.62" />

                                <!-- snaks -->
                                <path id="path282"
                                    d="m 3955.21,2069.37 c 5.17,7.46 10.51,14.8 15.85,22.1 -15.54,20.69 -31.54,41.03 -47.71,61.2 -18.11,22.57 -36.45,45.02 -53.58,68.36 -92.96,126.59 -52.9,179.04 -33.67,236.91 9.72,29.24 67.34,91.72 132.28,155.01 -26.87,25.7 -54.96,51.66 -82.07,75.92 -26.2,-26.29 -51.37,-52.19 -74.25,-77.2 -157.06,-171.82 -113.79,-256.82 -81.74,-340.01 25.1,-65.12 121.81,-149.1 202.99,-235.45 6.94,10.96 14.13,21.97 21.9,33.16" />
                                <path id="path284"
                                    d="m 3833.86,3494.32 c 39.05,28.93 84.01,61.09 130.2,93.81 -87.58,61.85 -178.73,125.76 -249.76,179.19 -125.01,94.04 36.86,206.17 126.61,255 24.68,13.43 62.14,29.35 107.47,47.06 -30.64,11.37 -63.39,23.32 -97.56,35.76 -37.48,13.66 -77.12,28.13 -117.06,42.98 -20.81,-11.04 -41.31,-22.22 -61.13,-33.56 -116.3,-66.62 -246.29,-178.36 -187.22,-326.74 45.87,-115.23 165.15,-179.32 265.14,-241.42 27.82,-17.29 55.59,-34.63 83.31,-52.08" />
                                <path id="path286"
                                    d="m 4052.29,1966.19 c -3.87,7.41 -8.04,14.65 -12.19,21.89 -11.76,-13.3 -22.89,-26.56 -32.99,-39.69 25.6,-35.42 48.54,-74.45 57.15,-117.37 10.39,-51.84 -8.61,-108.47 -26.82,-156.6 3.89,2.16 10.03,7.87 12.58,10.61 4.57,4.95 8.22,10.6 11.45,16.47 32.33,58.74 41.62,116.22 24.42,180.77 -7.77,29.17 -19.61,57.18 -33.6,83.92" />
                                <path id="path288"
                                    d="m 4306.12,4869.32 c -18.63,0 -33.76,8.1 -33.76,18.09 0,9.98 15.13,18.08 33.76,18.08 18.64,0 33.75,-8.1 33.75,-18.08 0,-9.99 -15.11,-18.09 -33.75,-18.09 z M 4708,4590.2 c -12.81,117.55 -96.16,200.74 -118.61,215.24 -22.43,14.5 -8,34.34 -43.27,74.13 -35.25,39.78 -128.22,83.18 -245.21,81.38 -117,-1.81 -150.67,-106.71 -138.98,-112.13 11.67,-5.43 13.26,-16.12 13.26,-16.12 -28.44,4.52 -20.14,-30.9 37.56,-74.31 57.7,-43.4 161.89,-94.04 192.33,-85 21.75,6.46 44.51,-5.06 58.84,-23.99 6.12,-8.07 10.68,-17.5 12.98,-27.45 1.95,-8.44 2.26,-17.26 0.8,-25.83 -7.17,-41.66 -47.11,-70.71 -76.18,-92 -42.61,-31.2 -88.05,-57.11 -131.07,-87.54 -51.57,-36.48 -142.76,-79.66 -246.98,-128.08 72.57,-33.76 149.91,-70.3 223.08,-108.72 49.05,18.33 97.94,37.08 144.1,55.95 203.55,83.19 330.18,236.91 317.35,354.47" />
                                <path id="path290"
                                    d="m 4147.04,3456.25 c -1.29,0.97 -2.65,1.98 -3.97,2.97 -14.43,-9.04 -28.81,-18.1 -42.86,-27.23 -30.93,-20.09 -59.22,-38.76 -85.5,-56.51 134.76,-94.01 208.67,-166.89 212.47,-261.04 3.04,-75.45 -100.95,-187.81 -217.51,-303.64 10.72,-10.58 21.42,-21.09 32.01,-31.49 17.13,-16.83 34.36,-33.82 51.47,-50.83 18.86,16.64 35.78,31.22 49.09,42.34 80.12,66.91 222.77,220.64 233.99,341.81 11.22,121.17 -108.99,253.2 -229.19,343.62" />
                                <path id="path292"
                                    d="m 3671.93,4905.49 c 18.64,0 33.75,-8.1 33.75,-18.08 0,-9.99 -15.11,-18.09 -33.75,-18.09 -18.64,0 -33.76,8.1 -33.76,18.09 0,9.98 15.12,18.08 33.76,18.08 z m 633.69,-790.93 c -211.57,121.17 -490.44,226.06 -597.83,302.02 -43.02,30.43 -88.46,56.34 -131.07,87.54 -29.06,21.29 -69.01,50.34 -76.17,92 -1.48,8.57 -1.17,17.39 0.79,25.83 2.3,9.95 6.86,19.38 12.98,27.45 14.33,18.93 37.09,30.45 58.83,23.99 30.45,-9.04 134.64,41.6 192.33,85 57.7,43.41 66.01,78.83 37.57,74.31 0,0 1.58,10.69 13.25,16.12 11.69,5.42 -21.96,110.32 -138.98,112.13 -116.98,1.8 -209.95,-41.6 -245.2,-81.38 -35.26,-39.79 -20.84,-59.63 -43.28,-74.13 -22.43,-14.5 -105.78,-97.69 -118.6,-215.24 -12.83,-117.56 113.79,-271.28 317.34,-354.47 203.54,-83.2 459.99,-164.58 549.74,-213.41 89.75,-48.83 251.64,-160.96 126.63,-255 -125.01,-94.05 -312.54,-220.64 -432.76,-311.07 C 3711,3365.83 3590.79,3233.8 3602,3112.63 c 11.22,-121.17 153.87,-274.9 234,-341.81 80.14,-66.91 286.91,-255.01 306.13,-312.88 19.24,-57.87 59.31,-110.32 -33.66,-236.91 -6.42,-8.74 -13.01,-17.33 -19.68,-25.86 -36.93,-47.21 -75.61,-93.03 -109.82,-142.31 -38.76,-55.88 -72.34,-116.01 -92.54,-181.21 -10.7,-34.5 -17.54,-70.19 -19.78,-106.26 -1.18,-19.06 -1.1,-38.19 0.23,-57.25 2.56,-36.19 12.29,-74.73 29.69,-106.68 10.6,-19.47 21.94,-39.45 23.13,-38.15 2.69,2.93 -24.44,83.13 -29.2,118.77 -7.94,59.35 8.19,171.81 92.24,282.13 84.07,110.32 233.11,224.26 265.18,307.45 32.05,83.19 75.31,168.19 -81.75,340.01 -157.06,171.81 -419.92,383.41 -415.12,502.77 4.82,119.36 121.83,204.36 333.38,341.81 86.07,55.91 175.82,106.56 259.89,165.48 87.72,61.5 169.67,142.07 164.36,257.59 -5.14,111.67 -116.03,185.38 -203.06,235.24" />
                            </g>
                            <!-- </g> -->
                            <animate attributeName="d" dur="12.8s" begin="0s" repeatCount="indefinite"
                                xlink:href="#path258" />
                    </svg>

                    <div style="font-size:20px; color:whitesmoke;" class="my-auto"> DrugRadar</div>
                </div>
            </a>
        </div>
        <hr class="horizontal light mt-5 mb-2" />
        <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('pharmacy.index')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class='bx bx-user-pin' style="font-size: 25px;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Admin</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('pharmacy.index')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class='bx bx-user' style="font-size: 25px;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pharmacy Owner</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('doctor.index')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class='bx bx-group' style="font-size: 25px;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pharmacists</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pages/tables.html">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class='bx bxs-group' style="font-size: 25px;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('area.index')}}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class='bx bx-map-pin' style="font-size: 25px;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Areas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pages/tables.html">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class='bx bxs-capsule' style="font-size: 25px;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Medicines</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pages/tables.html">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class='bx bx-cycling' style="font-size: 25px;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Orders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pages/tables.html">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class='bx bx-dollar' style="font-size: 25px;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Revenue</span>
                    </a>
                </li>
            </ul>
        </div>
        {{-- <div class="sidenav-footer position-absolute w-100 bottom-0">
                <div class="mx-3">
                    <a
                        class="btn bg-gradient-primary mt-4 w-100"
                        href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree"
                        type="button"
                        >New Article <i class='bx bx-plus'></i></a
                    >
                </div>

            </div> --}}
    </aside>

    {{-- nav --}}

    <main class=" main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                            Template
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Template</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <!-- <div
                            class="ms-md-auto pe-md-3 d-flex align-items-center"
                        >
                            <div class="input-group input-group-outline">
                                <label class="form-label">Type here...</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div> -->
                    <div class="DarkbtnContainer ms-md-auto pe-md-3 d-flex align-items-center">
                        <input type="checkbox" id="dark-mode">
                        <label for="dark-mode" class="Dark-btn"></label>
                    </div>
                </div>
            </div>
        </nav>


        <div class="container" style="min-height: 71vh">
            @yield('content')
        </div>

        {{-- footer --}}
        <footer class="text-center text-white mt-auto me-3 bg-gradient-dark footer">
            <!-- Grid container -->
            {{-- <div class="container p-4 pb-0">
                <!-- Section: CTA -->
                <section class="">
                    <p class="d-flex justify-content-center align-items-center">
                        <span class="me-3">Register for free</span>
                        <button type="button" class="btn btn-outline-light btn-rounded">
                            Sign up!
                        </button>
                    </p>
                </section>
                <!-- Section: CTA -->
            </div> --}}
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2023 Copyright:
                <a class="text-white text-decoration-none" href="{{route('dashboard.index')}}"
                    target="_parent">DrugRadar</a>
                <svg width="50" height="50" style="background:transparent;" viewBox="120 140 790 700">
                        <defs id="defs6">
                            <clipPath id="clipPath18" clipPathUnits="userSpaceOnUse">
                                <path id="path20" d="m 0,0 c 1336.44,0 2672.87,0 4009.3,0 1330.23,0 2660.47,0 3990.7,0 0,1330.23 0,2660.47 0,3990.7 0,1336.43 0,2672.86 0,4009.3 -1330.23,0 -2660.47,0 -3990.7,0 -1336.43,0 -2672.86,0 -4009.3,0 C 0,6663.56 0,5327.13 0,3990.7 0,2660.47 0,1330.23 0,0 Z"/>
                            </clipPath>
                            <clipPath id="clipPath24" clipPathUnits="userSpaceOnUse">
                                <path id="path26" d="m 0,0 c 1336.44,0 2672.87,0 4009.3,0 1330.23,0 2660.47,0 3990.7,0 0,1330.23 0,2660.47 0,3990.7 0,1336.43 0,2672.86 0,4009.3 -1330.23,0 -2660.47,0 -3990.7,0 -1336.43,0 -2672.86,0 -4009.3,0 C 0,6663.56 0,5327.13 0,3990.7 0,2660.47 0,1330.23 0,0"/>
                            </clipPath>
                        </defs>


                    <g xmlns="http://www.w3.org/2000/svg" transform="matrix(1.25,0,0,-1.25,0,1000)" id="g10">
                        <g transform="scale(0.1,0.1)" id="g12">
                            <g id="g14">
                                <g clip-path="url(#clipPath18)" id="g16">
                                    <g clip-path="url(#clipPath24)" id="g22">
                                        <g transform="matrix(10,0,0,-10,-77910.7,85910.7)" id="g28"> </g>
                                    </g>
                                </g>
                            </g>
                            <!-- wings -->
                            <path id="path258"
                                d="m 3871.78,5899.22 c -68.11,1.71 -142.08,7.96 -162.24,26.28 -39.78,36.17 -68.72,112.13 -75.96,206.17 -7.23,94.05 -10.85,426.82 -343.62,455.76 -332.76,28.93 -524.47,-159.15 -817.45,-307.45 -292.99,-148.31 -907.89,-444.9 -1284.06,-524.48 -301.177,-63.71 183.61,-71.77 439.01,-57.6 159.91,74.15 1122.39,519.97 1303.58,592.32 0,0 -851.74,-429.25 -1292.55,-653.83 -57.77,-40.19 -110,-85.29 -88.33,-105.14 32.18,-29.51 299,-49.02 514.45,-23.24 136.75,58.14 642.35,275.45 905.61,420.81 0,0 -528.41,-309.24 -837.59,-439.87 -84.22,-47.53 -173.89,-110.59 -141.19,-149.41 44.99,-53.42 336.89,-30.33 512.25,23.37 120.69,73.06 421.65,256.64 506.02,321.18 7.13,5.65 11.15,8.86 11.15,8.86 -3.08,-2.6 -6.94,-5.63 -11.15,-8.86 -51.59,-40.82 -275.42,-216.35 -465.25,-341.16 -47.07,-53.93 -91.88,-123.96 -46.64,-158.93 69.22,-53.48 299.87,32.6 446.84,110.67 70.24,57.95 189.42,160.04 235.35,222.1 0,0 -86.95,-123.83 -215.13,-240.76 -44.62,-64.15 -105.81,-168.76 -61.94,-207.75 54.31,-48.27 226.82,9.15 330.86,79.91 38.66,45.16 102.18,123.5 132.49,184.13 0,0 -35.72,-114.2 -105.85,-204.37 -11.29,-41.62 -12.5,-92.25 36.76,-113.93 79.14,-34.82 166.6,13.48 245.4,91.55 24.62,35.7 58.48,87.13 82.31,132.71 0,0 -34.05,-89.48 -68.45,-157.98 -4.99,-30.49 -1.79,-63.9 30.1,-77.77 44.15,-19.18 199.54,33.56 296.26,204.36 l -11.04,692.35" />
                            <path id="path260"
                                d="m 3887.77,5838.12 c -0.01,0.18 -26.08,0.38 -28.56,0.43 -34.58,0.8 -69.29,2.42 -103.58,7.11 -10.51,1.45 -21.01,3.22 -31.36,5.58 -34.86,7.93 -45.45,19.94 -55.09,30.74 -38.85,43.54 -64.73,118.5 -71.7,209.13 -0.39,5.02 -0.76,10.7 -1.18,16.99 -7.1,107.48 -25.97,393 -322.69,418.81 -22.07,1.91 -44.14,2.89 -65.56,2.89 -23.66,0 -47.31,-1.2 -70.83,-3.67 -166.39,-17.47 -300.9,-104.78 -446.11,-178.22 -8.58,-4.33 -17.17,-8.62 -25.77,-12.91 -23.14,-11.56 -46.32,-23.06 -69.49,-34.54 -35.93,-17.78 -71.65,-36.23 -108.12,-52.91 -61.47,-28.15 -113.11,-51.17 -113.12,-51.38 -0.03,-0.62 50.84,20.06 112.45,46.28 35.65,15.17 70.5,32.5 105.54,49 79.31,37.35 156.12,78.77 234.69,117.59 72.67,35.91 148.32,66.38 227.83,83.23 50.25,10.64 101.56,15.83 152.93,15.83 20.77,0 42.2,-0.95 63.7,-2.81 278.16,-24.19 295.5,-286.58 302.9,-398.62 0.46,-6.98 0.82,-12.42 1.19,-17.23 5.16,-66.98 19.71,-147.13 58.72,-202.83 40.54,-57.88 78.35,-57.24 145.47,-65.52 10.66,-1.31 108.73,-5.71 108.69,-4.67 -0.23,7.23 -0.55,14.46 -0.95,21.7" />
                            <path id="path262"
                                d="m 6811.55,5753.25 c -376.18,79.57 -991.08,376.17 -1284.06,524.47 -292.99,148.3 -484.69,336.39 -817.46,307.45 -332.76,-28.93 -336.39,-361.7 -343.62,-455.75 -7.23,-94.04 -36.17,-170 -75.96,-206.17 -20.62,-18.74 -97.5,-24.85 -166.87,-26.38 l -15.4,-675.65 c 95.78,-183.98 259.7,-240.76 305.26,-220.96 31.89,13.87 35.09,47.28 30.1,77.77 -34.4,68.5 -68.45,157.98 -68.45,157.98 23.82,-45.59 57.7,-97.02 82.31,-132.71 78.8,-78.07 166.26,-126.37 245.4,-91.55 49.25,21.67 48.05,72.3 36.76,113.93 -70.12,90.16 -105.85,204.37 -105.85,204.37 30.31,-60.63 93.84,-138.97 132.5,-184.13 104.04,-70.76 276.55,-128.19 330.85,-79.91 43.87,38.99 -17.32,143.59 -61.94,207.74 -128.19,116.93 -215.13,240.77 -215.13,240.77 45.93,-62.06 165.11,-164.15 235.36,-222.1 146.97,-78.07 377.62,-164.15 446.82,-110.67 45.25,34.97 0.46,105 -46.62,158.93 -189.85,124.8 -413.66,300.34 -465.25,341.16 -4.22,3.23 -8.08,6.26 -11.16,8.86 0,0 4.03,-3.21 11.16,-8.86 84.35,-64.55 385.33,-248.12 506.02,-321.19 175.34,-53.69 467.25,-76.79 512.24,-23.36 32.7,38.82 -56.97,101.88 -141.18,149.4 -309.18,130.63 -837.6,439.87 -837.6,439.87 263.27,-145.36 768.87,-362.66 905.62,-420.81 215.44,-25.77 482.26,-6.26 514.44,23.24 21.67,19.86 -30.56,64.95 -88.32,105.14 -440.82,224.59 -1292.55,653.83 -1292.55,653.83 181.18,-72.35 1143.68,-518.17 1303.57,-592.32 255.42,-14.16 740.18,-6.1 439.01,57.61" />
                            <path id="path264"
                                d="m 4112.23,5835.87 c 0.02,0.17 26.08,0.37 28.57,0.43 34.57,0.79 69.29,2.42 103.57,7.11 10.52,1.44 21.02,3.22 31.36,5.57 34.86,7.94 45.45,19.94 55.09,30.75 38.86,43.53 64.73,118.5 71.71,209.13 0.39,5.01 0.76,10.7 1.18,16.98 7.09,107.49 25.96,393.01 322.69,418.82 22.07,1.91 44.14,2.89 65.55,2.89 23.66,0 47.31,-1.2 70.83,-3.68 166.4,-17.47 300.91,-104.77 446.11,-178.22 8.58,-4.32 17.17,-8.61 25.77,-12.9 23.14,-11.56 46.31,-23.06 69.5,-34.54 35.93,-17.78 71.64,-36.24 108.1,-52.91 61.49,-28.15 113.12,-51.17 113.13,-51.38 0.03,-0.62 -50.84,20.05 -112.45,46.28 -35.65,15.16 -70.49,32.49 -105.54,48.99 -79.3,37.35 -156.12,78.78 -234.68,117.59 -72.66,35.92 -148.32,66.38 -227.84,83.23 -50.25,10.64 -101.55,15.83 -152.93,15.83 -20.77,0 -42.2,-0.94 -63.69,-2.81 -278.17,-24.19 -295.5,-286.57 -302.9,-398.62 -0.46,-6.97 -0.82,-12.41 -1.19,-17.23 -5.17,-66.97 -19.71,-147.13 -58.72,-202.83 -40.55,-57.87 -78.36,-57.23 -145.47,-65.52 -10.67,-1.31 -108.74,-5.71 -108.7,-4.66 0.24,7.22 0.56,14.46 0.95,21.7" />
                            <!-- white bta3 -->
                            <path id="path266"
                                d="m 3846.7,6197.07 c -8.69,-6.55 -14.61,-18.73 -14.61,-32.84 0,-20.97 12.92,-37.98 28.88,-37.98 l 112.34,0 c -50.93,6.59 -95.77,32.74 -126.61,70.82" />
                            <path id="path268"
                                d="m 4150.24,6197.07 c -30.84,-38.08 -75.68,-64.23 -126.61,-70.82 l 112.35,0 c 15.95,0 28.88,17.01 28.88,37.98 0,14.11 -5.92,26.29 -14.62,32.84" />
                            <path id="path270"
                                d="m 4172.09,6319.76 c 0,-95.88 -77.73,-173.62 -173.62,-173.62 -95.88,0 -173.62,77.74 -173.62,173.62 0,95.89 77.74,173.62 173.62,173.62 95.89,0 173.62,-77.73 173.62,-173.62" />
                            <path id="path272"
                                d="m 3931.43,3564.95 c 31.05,22.12 63.13,44.78 94.82,67.14 7.78,5.48 15.59,11 23.4,16.5 l 8.62,378.27 c -37.39,15.47 -83.62,32.9 -135.05,51.81 l 8.21,-513.72" />
                            <path id="path274"
                                d="m 4024.77,2557.44 c -23.98,24.4 -50.9,50.54 -78.49,76.46 l 8.99,-564.43 c 19.2,27.64 39.74,54.19 60.2,79.97 l 9.3,408" />
                            <path id="path276"
                                d="m 4030.1,2790.69 13.77,604.3 c -41.09,-27.26 -77.34,-52.18 -108.54,-75.39 l 7.05,-441.29 c 28.5,-29.28 58.41,-58.82 87.72,-87.62" />
                            <path id="path278"
                                d="m 3990.32,4303.89 c 23.88,-11.08 48.52,-22.53 73.49,-34.24 l 43.02,1887.73 c -31.03,-20.78 -68.29,-32.94 -108.36,-32.94 -40.08,0 -77.37,12.18 -108.41,32.97 l 29.04,-1820.33 c 22.84,-10.73 46.64,-21.78 71.22,-33.19" />
                            <path id="path280"
                                d="m 4005.76,1946.68 c -19.35,-25.41 -34.93,-50.98 -47.31,-75.96 l 6.46,-405.06 16.96,-56.06 18.01,56.06 11.12,487.64 c -1.73,-2.2 -3.56,-4.42 -5.24,-6.62" />

                            <!-- snaks -->
                            <path id="path282"
                                d="m 3955.21,2069.37 c 5.17,7.46 10.51,14.8 15.85,22.1 -15.54,20.69 -31.54,41.03 -47.71,61.2 -18.11,22.57 -36.45,45.02 -53.58,68.36 -92.96,126.59 -52.9,179.04 -33.67,236.91 9.72,29.24 67.34,91.72 132.28,155.01 -26.87,25.7 -54.96,51.66 -82.07,75.92 -26.2,-26.29 -51.37,-52.19 -74.25,-77.2 -157.06,-171.82 -113.79,-256.82 -81.74,-340.01 25.1,-65.12 121.81,-149.1 202.99,-235.45 6.94,10.96 14.13,21.97 21.9,33.16" />
                            <path id="path284"
                                d="m 3833.86,3494.32 c 39.05,28.93 84.01,61.09 130.2,93.81 -87.58,61.85 -178.73,125.76 -249.76,179.19 -125.01,94.04 36.86,206.17 126.61,255 24.68,13.43 62.14,29.35 107.47,47.06 -30.64,11.37 -63.39,23.32 -97.56,35.76 -37.48,13.66 -77.12,28.13 -117.06,42.98 -20.81,-11.04 -41.31,-22.22 -61.13,-33.56 -116.3,-66.62 -246.29,-178.36 -187.22,-326.74 45.87,-115.23 165.15,-179.32 265.14,-241.42 27.82,-17.29 55.59,-34.63 83.31,-52.08" />
                            <path id="path286"
                                d="m 4052.29,1966.19 c -3.87,7.41 -8.04,14.65 -12.19,21.89 -11.76,-13.3 -22.89,-26.56 -32.99,-39.69 25.6,-35.42 48.54,-74.45 57.15,-117.37 10.39,-51.84 -8.61,-108.47 -26.82,-156.6 3.89,2.16 10.03,7.87 12.58,10.61 4.57,4.95 8.22,10.6 11.45,16.47 32.33,58.74 41.62,116.22 24.42,180.77 -7.77,29.17 -19.61,57.18 -33.6,83.92" />
                            <path id="path288"
                                d="m 4306.12,4869.32 c -18.63,0 -33.76,8.1 -33.76,18.09 0,9.98 15.13,18.08 33.76,18.08 18.64,0 33.75,-8.1 33.75,-18.08 0,-9.99 -15.11,-18.09 -33.75,-18.09 z M 4708,4590.2 c -12.81,117.55 -96.16,200.74 -118.61,215.24 -22.43,14.5 -8,34.34 -43.27,74.13 -35.25,39.78 -128.22,83.18 -245.21,81.38 -117,-1.81 -150.67,-106.71 -138.98,-112.13 11.67,-5.43 13.26,-16.12 13.26,-16.12 -28.44,4.52 -20.14,-30.9 37.56,-74.31 57.7,-43.4 161.89,-94.04 192.33,-85 21.75,6.46 44.51,-5.06 58.84,-23.99 6.12,-8.07 10.68,-17.5 12.98,-27.45 1.95,-8.44 2.26,-17.26 0.8,-25.83 -7.17,-41.66 -47.11,-70.71 -76.18,-92 -42.61,-31.2 -88.05,-57.11 -131.07,-87.54 -51.57,-36.48 -142.76,-79.66 -246.98,-128.08 72.57,-33.76 149.91,-70.3 223.08,-108.72 49.05,18.33 97.94,37.08 144.1,55.95 203.55,83.19 330.18,236.91 317.35,354.47" />
                            <path id="path290"
                                d="m 4147.04,3456.25 c -1.29,0.97 -2.65,1.98 -3.97,2.97 -14.43,-9.04 -28.81,-18.1 -42.86,-27.23 -30.93,-20.09 -59.22,-38.76 -85.5,-56.51 134.76,-94.01 208.67,-166.89 212.47,-261.04 3.04,-75.45 -100.95,-187.81 -217.51,-303.64 10.72,-10.58 21.42,-21.09 32.01,-31.49 17.13,-16.83 34.36,-33.82 51.47,-50.83 18.86,16.64 35.78,31.22 49.09,42.34 80.12,66.91 222.77,220.64 233.99,341.81 11.22,121.17 -108.99,253.2 -229.19,343.62" />
                            <path id="path292"
                                d="m 3671.93,4905.49 c 18.64,0 33.75,-8.1 33.75,-18.08 0,-9.99 -15.11,-18.09 -33.75,-18.09 -18.64,0 -33.76,8.1 -33.76,18.09 0,9.98 15.12,18.08 33.76,18.08 z m 633.69,-790.93 c -211.57,121.17 -490.44,226.06 -597.83,302.02 -43.02,30.43 -88.46,56.34 -131.07,87.54 -29.06,21.29 -69.01,50.34 -76.17,92 -1.48,8.57 -1.17,17.39 0.79,25.83 2.3,9.95 6.86,19.38 12.98,27.45 14.33,18.93 37.09,30.45 58.83,23.99 30.45,-9.04 134.64,41.6 192.33,85 57.7,43.41 66.01,78.83 37.57,74.31 0,0 1.58,10.69 13.25,16.12 11.69,5.42 -21.96,110.32 -138.98,112.13 -116.98,1.8 -209.95,-41.6 -245.2,-81.38 -35.26,-39.79 -20.84,-59.63 -43.28,-74.13 -22.43,-14.5 -105.78,-97.69 -118.6,-215.24 -12.83,-117.56 113.79,-271.28 317.34,-354.47 203.54,-83.2 459.99,-164.58 549.74,-213.41 89.75,-48.83 251.64,-160.96 126.63,-255 -125.01,-94.05 -312.54,-220.64 -432.76,-311.07 C 3711,3365.83 3590.79,3233.8 3602,3112.63 c 11.22,-121.17 153.87,-274.9 234,-341.81 80.14,-66.91 286.91,-255.01 306.13,-312.88 19.24,-57.87 59.31,-110.32 -33.66,-236.91 -6.42,-8.74 -13.01,-17.33 -19.68,-25.86 -36.93,-47.21 -75.61,-93.03 -109.82,-142.31 -38.76,-55.88 -72.34,-116.01 -92.54,-181.21 -10.7,-34.5 -17.54,-70.19 -19.78,-106.26 -1.18,-19.06 -1.1,-38.19 0.23,-57.25 2.56,-36.19 12.29,-74.73 29.69,-106.68 10.6,-19.47 21.94,-39.45 23.13,-38.15 2.69,2.93 -24.44,83.13 -29.2,118.77 -7.94,59.35 8.19,171.81 92.24,282.13 84.07,110.32 233.11,224.26 265.18,307.45 32.05,83.19 75.31,168.19 -81.75,340.01 -157.06,171.81 -419.92,383.41 -415.12,502.77 4.82,119.36 121.83,204.36 333.38,341.81 86.07,55.91 175.82,106.56 259.89,165.48 87.72,61.5 169.67,142.07 164.36,257.59 -5.14,111.67 -116.03,185.38 -203.06,235.24" />
                        </g>
                        <!-- </g> -->
                        <animate attributeName="d" dur="12.8s" begin="0s" repeatCount="indefinite"
                            xlink:href="#path258" />
                </svg>
            </div>
            <!-- Copyright -->
        </footer>
    </main>

    <!--   Core JS Files   -->
    <!-- <script src="assets/js/core/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>

    @yield('modal')
</body>
</html>