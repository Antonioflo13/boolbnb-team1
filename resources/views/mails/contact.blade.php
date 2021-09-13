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
        border-bottom: 1px solid #cbcbcb;
    }

    header h4 {
        color: #FD395C;
    }

    header h2 {
        color: #FD395C;
    }

    /* nav */
    header nav {
        display: flex;
        justify-content: space-between;
        padding: 20px;
    }

    header a {
        margin: 5px 0;
    }
    header a:hover{
        color: #FD395C;
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
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
        margin: 10px 0px;
        padding: 20px;
        border-radius: 10px;
        background-color: white;
        box-shadow: 7px 5px 58px 0px rgb(0, 0, 0, 0.3);
    }
    .card * {
        margin-bottom: 10px;
    }

    .card .msg-box {
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        background-color: #F8FAFC;
    }

    .reply {
        align-self: center;
        padding: 10px;
        border-radius: 10px;
        text-transform: uppercase;
        border: 1px solid #FD395C;
        color:  #FD395C !important;
        background-color: transparent;
    }

    .reply:hover {
        color: white !important;
        background-color: #FD395C;
    }
    h2,
    h4 {
        margin: 10px 0;
    }

    h4 {
        font-size: 16px;
        color: #FD395C;
    }

    /* footer */
    footer{
        padding: 10px;
        background-color: #FFFFFF;
        border-top: 1px solid #cbcbcb;
    
    }
    .ms-footer-links {
        display: flex;
        justify-content: center;
        align-items: center;
        list-style: none;
    }

    .ms-footer-links li {
        padding: 10px;
    }
    a{
       text-decoration: none; 
       color: #4A4B4B;
       transition: all 0.2s;
    }
    footer a:hover{
        text-decoration:underline;
    }

    @media and screen (min-width: 576px) {
        header nav {
            text-align: center;
        }
        .ms-footer-links li {
        padding: 5px;
        font-size: 14px;
        }
    }

    </style>
</head>
<body>

    {{-- container --}}
    <div class="container">

        {{-- header --}}
        <header>
            <a href="{{ route('home') }}"><img class="logo" src="https://loghi-famosi.com/wp-content/uploads/2020/07/Logo-della-Airbnb.png" alt="bnblogo"></a>
            <h2>BoolBnB</h2>
            <nav>
                <ul>
                    <li>
                        <a href="http://127.0.0.1:8000/locations">Search your Appartment</a>
                        <a href="http://127.0.0.1:8000/register">Become a Host</a>
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
                    <p>{{ $email->email }}</p>
                    <h5>Message</h5>
                    <div class="msg-box">
                        <p>{{ $email->message }}</p>
                    </div>
                    <a class="reply" href="mailto:{{ $email->email }}">Reply</a>
                </article>
            </section>
        </main>
        {{-- /main --}}
        
        {{-- footer --}}
        <footer>
            <div>
                <ul class="ms-footer-links">
                    <li> &copy; 2021 Boolbnb, Inc. </li> 
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Sitemap</a></li>
                </ul>
            </div>
        </footer>
        {{-- /footer --}}

    </div>
</body>
</html>


