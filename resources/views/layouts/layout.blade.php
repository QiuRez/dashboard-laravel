<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{url('css/style.css')}}" />
        <title>@section('title') @show</title>
    </head>
    <body>

            
		<header>
            @section('header')
			<h1><a href="{{route('home')}}">Box Press</a></h1>
			<nav>
				<ul class="menu">
					<li><a href="{{route('home')}}" class="current">Home</a></li>
					<li class="dropdown-toggle" >Categories</li>
                    <ul class="dropdown-menu">
                        @if($categories = App\Models\Category::all())
                        @foreach($categories as $category)
                        <li><a href="/category/{{$category->CategoryID}}">{{$category->CategoryName}}</a></li>
                        @endforeach
                        @endif
                    </ul>
				</ul>
			</nav>
            <div class="user-block">
                @if ($user = Auth::user())
                <img src="{{url($user->UserPhoto)}}" alt="Аватар">
                <div class="user-block__action">
                    <p>{{$user->Username}}</p>
                    <a href="{{route('logOut')}}">LogOut</a>
                </div>
                @else
                <div class="auth_or_register">
                    <a href="{{route('register')}}">Зарегистрироваться</a>
                    <a href="{{route('auth')}}">Войти</a>
                </div>
                @endif
            </div>
            @show
		</header>
		<div id="secwrapper">
            <div class="content">
                @yield('content')
            </div>
		</div>

        @section('footer')
		<footer>
			<p>Copyright &copy 2024 BoxPress by Vasiluk Egor. All Rights Reserved.</p>
            @show
		</footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{url('js/jquery-3.7.1.js')}}"></script>
        <script src="{{url('js/app.js')}}"></script>
	</body>
</html>
		
		
			
    
    