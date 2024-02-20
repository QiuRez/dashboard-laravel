<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{url('css/style.css')}}" />
        <title>@section('title') @show</title>
    </head>
    <body>

            
		<header>
            @section('header')
			<h1><a href="{{route('home')}}">Box Press</a></h1>
			<nav>
				<ul class="menu">
					<li><a href="{{route('home')}}">Home</a></li>
                    <div class="dropdown">
					<a class="dropdown-toggle" id="dropdownMenu1" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-lg-end p-2" aria-labelledby="dropdownMenu1">
                        @if($categories = App\Models\Category::all())
                        @foreach($categories as $category)
                        <li><a class="dropdown-item" href="/category/{{$category->CategoryID}}">{{$category->CategoryName}}</a></li>
                        @endforeach
                        @endif
                    </ul>
                    </div>
                    
                    @if (checkBannedAndAuth())
                        <li><a href="{{route('ad.create')}}">Добавить объявление</a></li>
                    @endif
				</ul>
			</nav>
            <div class="user-block">
                @if ($user = Auth::user())
                <img src="{{url($user->UserPhoto)}}" alt="Аватар">
                <div class="user-block__action">
                    <p>{{$user->Username}}</p>
                    <a href="{{route('logOut')}}">LogOut</a>
                </div>
                @if ($user->Role == 'Администратор')
                <a href="{{route('admin')}}" class="url-admin-panel">Админ-панель</a>
                @endif
                @else
                <div class="auth_or_register">
                    <a href="{{route('register')}}">Зарегистрироваться</a>
                    <a href="{{route('auth')}}">Войти</a>
                </div>
                @endif
            </div>
            @show
		</header>
        <div class="container-fluid">
            @yield('content')
        </div>

        @section('footer')
		<footer>
			<p>Copyright &copy 2024 BoxPress by Vasiluk Egor. All Rights Reserved.</p>
            @show
		</footer>
        <script src="{{url('js/jquery-3.7.1.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{url('js/app.js')}}"></script>
	</body>
</html>
		
		
			
    
    