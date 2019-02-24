<div class="ui top fixed menu header-app">
  <div class="ui container">



  <div class="item item-logo">
    <h1>techno<span>blog</span></h1>
  </div>

  <div class="menu-container pusher">
    <i class="bars icon"></i>
  </div>

  <a class="item active" href="{{ url('/') }}">Accueil</a>
  @guest ('admin')
    <a class="item" href="{{ url('/admin/login') }}">Administration</a>
  @endguest
  @auth ('admin')
    <a class="item" href="{{ url('/admin/logout') }}">Deconnexion</a>
  @endauth


  <div class="right item">
    <form class="ui action input" action="{{ url('/posts/search') }}" method="GET" enctype="multipart/form-data">
      @csrf
      {{ method_field('GET') }}
      <input type="text" name="title" placeholder="Rechercher un article">
      <button class="ui button" type="submit"><i class="ui search icon"></i></button>
    </form>
  </div>
</div>
</div>

<div class="ui sidebar vertical menu overlay">
  <a class="item active" href="{{ url('/') }}">Accueil</a>
  @guest ('admin')
  <a class="item" href="{{ url('/admin/login') }}">Administration</a>
  @endguest
  @auth ('admin')
  <a class="item" href="{{ url('/admin/logout') }}">Deconnexion</a>
  @endauth
  <div class="item item-form">
    <form class="ui action input" action="{{ url('/posts/search') }}" method="GET" enctype="multipart/form-data">
      @csrf
      {{ method_field('GET') }}
      <input type="text" name="title" placeholder="Rechercher un article">
      <button class="ui button" type="submit"><i class="ui search icon"></i></button>
    </form>
  </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      $('.pusher').click(function() {
        $('.ui.sidebar').sidebar('toggle');
      });
    });
  </script>
