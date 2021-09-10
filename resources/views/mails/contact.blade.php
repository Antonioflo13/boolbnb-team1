<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <style>
    /* common */

    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    /* body */
    body {
        font-family: 'Ubuntu', sans-serif;
        padding: 20px;
        background-color: #FD395C;
    }

    /* container */
    .container {
        padding: 10px 0;
        border-radius: 10px;
        background-color: white;
    }

    /* header */
    header {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    header h4 {
        color: #FD395C;
    }

    /* nav */
    header nav {
        display: flex;
        justify-content: space-between;
        padding: 20px;
    }

    nav ul li {
        list-style: none;
    }
    nav ul li a {
        padding: 10px;
    }
    nav ul li a:hover {
        color: #FD395C;
    }
    .logo{
        width: 40px;
    }
    .ms-text{
        font-size: 20px;
        color: #FD395C;  
    }

    /* main */
    main {
        background-color: #F8FAFC;
    }

    section {
        padding: 20px;
    }

    .card {
        width: 100%;
        margin: 10px 0px;
        padding: 20px;
        background-color: white;

        display: flex;
        flex-direction: column;
        align-items: flex-start;
        text-align: center;

        
    }
    h3 {
        font-size: 18px;
        color: $primary-color;
        margin: 5px 0;
    }

    h2,
    h4 {
        margin: 10px 0;
    }

    h4 {
        font-size: 16px;
        color: #FD395C;
    }

    a {
        margin: 5px 0;
        text-transform: uppercase;
        color:  $primary-color;
        border: 1px solid $primary-color;
        
    }
    a:hover{
        color: white;
        background-color: $primary-color-hover;
    }





        footer{
        background-color: #FFFFFF;
        border-top: 1px solid rgb(255, 255, 255);
    
    }
    .ms-footer{
        color: white;
    }
    .ms-list-group{
        list-style: none;
        color: #4A4B4B;
    }
    a{
       text-decoration: none; 
       color: #4A4B4B;
       transition: all 0.2s;
    }
    hover{
        text-decoration:underline;
    }
    .ms-social {
        display: none;
    }
    .fab{
       color: #4A4B4B; 
    }
    
    /* //MediaQuery */
    @media screen and (min-width: 576px){
    .ms-social {
        display: block;
    }
    }
    </style>
</head>
<body>

    {{-- container --}}
    <div class="container">
        <header>
            <a href="{{ route('home') }}"><img class="logo" src="https://loghi-famosi.com/wp-content/uploads/2020/07/Logo-della-Airbnb.png" alt="bnblogo"></a>
            <h4>BoolBnB</h4>
            <nav>
                <ul>
                    <li>
                        <a href="http://127.0.0.1:8000/location">Search your Appartment</a>
                        <a href="http://127.0.0.1:8000/location/register">Become a Host</a>
                    </li>
                </ul>
            </nav>
        </header>
        {{-- /header --}}

        {{-- main --}}
        <main>
            <section>
                <article class="card">
                    <h4>{{ $email->appartment->title }}</h4>
                    <h5>{{ $email->name }}</h5>
                    <h5>{{ $email->email }}</h5>
                    <p>{{ $email->message }}</p>
                </article>
            </section>
        </main>
        {{-- /main --}}
    
            <footer>
                <div class="container ms-footer py-3">
                    <div class="row">
                        <div class="col">
                            <ul class="d-flex flex-wrap ms-footer-links align-items-center my-2">
                                <li class="ms-list-group mr-3"> &copy; 2021 Boolbnb, Inc. </li> 
                                <li class="ms-list-group mr-3"><a href="#">Privacy</a> </li>
                                <li class="ms-list-group mr-3"><a href="#">Terms</a></li>
                                <li class="ms-list-group mr-3"><a href="#">Sitemap</a></li>
                            </ul>
                        </div>
                        <div class="col ms-social">
                            <ul class="d-flex flex-row-reverse align-items-center my-2">
                                <li class="ms-list-group mr-3"><a href="#"><i class="fab fa-2x fa-instagram"></i></a></li>
                                <li class="ms-list-group mr-3"><a href="#"><i class="fab  fa-2x fa-twitter"></i></a> </li>
                                <li class="ms-list-group mr-3"> <a href="#"><i class="fab fa-2x fa-facebook-f"></i></a></li>   
                            </ul>
        
                        </div>
                    </div> 
                </div>
            </footer>
    </div>
</body>
</html>


