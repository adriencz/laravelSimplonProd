@extends('layouts.master')

@section('title', 'Accueil')

@section('body')

  {{-- COUNT POST + CREATE POST LINK --}}

  @auth ('admin')
    <div class="ui sixteen wide column grid stat-container">
      <div class="ui horizontal statistic stat-article">
        <div class="value">{{ $posts->total() }}</div>
        <div class="ui eight wide column text value">Articles</div>
      </div>
    </div>
    <div class="ui sixteen wide column grid stat-container">
        <div class="text value">
          <a href="{{ url('/posts/create') }}"><span><i class="ui plus circle icon"></i>NOUVEL ARTICLE</span></a>
        </div>
    </div>
  @endauth

@foreach ($posts as $post)

  @if($loop->first)

    {{-- LAST POST (DESIGN) --}}

    <div class="ui sixteen wide computer only column articles-home first-article">
      <div class="article-content">
      <div class="ui grid">
        <div class="ui nine wide widescreen eight wide computer nine wide large screen column img-article-container">
          <img src="{{ url('/storage/'.$post->illustration->filename) }}" alt="">
        </div>
        <div class="ui seven wide widescreen eight wide computer seven wide large screen column text-article-container">
          <h3><a href="{{ url('/posts/'.$post->id.'') }}"><mark>{!! substr(strip_tags($post->title), 0, 70) !!} ...</mark></a></h3>
          <span class="date">{{ date_format($post->created_at,"d/m/Y") }}</span><br>
          <div class="text-article">
            <p>
            <strong>
              {!! substr(strip_tags($post->content), 0, 220) !!} ...
            </strong>
            <p>.. {!! substr(strip_tags($post->content), 350, 140) !!} ...</p>
          </p>
          </div>
          @guest ('admin')
            {{-- <span class="suspension">...</span> --}}
          @endguest
        <div class="extra">
        @auth ('admin')
          <a href="{{ url('/posts/edit/'.$post->id.'') }}">
            <i class="ui edit icon"></i>
          </a>
          <a href="#" class="delete-button" id="{{ $post->id }}">
            <i class="ui times circle outline icon"></i>
          </a>
        @endauth
        </div>
      </div>
      </div>
    </div>
    @auth ('admin')
      <form id="form-delete-{{ $post->id }}" action="{{ url('/posts/destroy/'.$post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('DELETE') }}
      </form>
    @endauth
    </div>



    {{-- LAST POST (RESPONSIVE) --}}

    <div class="ui sixteen wide mobile eight wide tablet only column articles-home secondaries-articles">
      <div class="article-content">
      <div class="ui grid">
        <div class="ui sixteen wide column img-article-container" style="background-image: url('{{ url('/storage/'.$post->illustration->filename) }}');">
          <h3><a href="{{ url('/posts/'.$post->id.'') }}"><mark class="mark2">{{ $post->title }}</mark></a></h3>
        </div>
        <div class="ui sixteen wide column text-article-container">
          <span class="date">{{ date_format($post->created_at,"d/m/Y") }}</span><br>
          <p>
            {!! substr(strip_tags($post->content), 0, 105) !!} ...
          </p>
        </div>
        <div class="extra">
        @guest ('admin')
          <i class="ui facebook icon"></i>
          <i class="ui twitter icon"></i>
        @endguest
        @auth ('admin')
          <a href="{{ url('/posts/'.$post->id) }}">
            <div class="read-button">
              <img src="/img/eye.png" alt="">
            </div>
          </a>
          <a href="{{ url('/posts/edit/'.$post->id.'') }}">
            <div class="read-button edit-button">
              <img src="/img/edit.png" alt="">
            </div>
          </a>
          <div class="read-button delete-button" id="{{ $post->id }}">
            <img src="/img/delete.png" alt="">
          </div>
        @endauth
        </div>
      </div>
    </div>
    @auth ('admin')
      <form id="form-delete-{{ $post->id }}" action="{{ url('/posts/destroy/'.$post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('DELETE') }}
      </form>
    @endauth
    </div>

  @else

    {{-- REGULAR POSTS --}}

    <div class="ui sixteen wide mobile eight wide tablet eight wide computer column articles-home secondaries-articles">
      <div class="article-content">
      <div class="ui grid">
        <div class="ui sixteen wide column img-article-container" style="background-image: url('{{ url('/storage/'.$post->illustration->filename) }}');">
          <h3><a href="{{ url('/posts/'.$post->id.'') }}"><mark class="mark2">{{ $post->title }}</mark></a></h3>
        </div>
        <div class="ui sixteen wide column text-article-container">
          <span class="date">{{ date_format($post->created_at,"d/m/Y") }}</span><br>
          <p>
            {!! substr(strip_tags($post->content), 0, 105) !!} ...
          </p>
        </div>
        <div class="extra">
        @guest ('admin')
          <i class="ui facebook icon"></i>
          <i class="ui twitter icon"></i>
        @endguest
        @auth ('admin')
          <a href="{{ url('/posts/'.$post->id) }}">
            <div class="read-button">
              <img src="/img/eye.png" alt="">
            </div>
          </a>
          <a href="{{ url('/posts/edit/'.$post->id.'') }}">
            <div class="read-button edit-button">
              <img src="/img/edit.png" alt="">
            </div>
          </a>
          <div class="read-button delete-button" id="{{ $post->id }}">
            <img src="/img/delete.png" alt="">
          </div>
        @endauth
        </div>
      </div>
    </div>
    {{-- DELETE FORM --}}
    @auth ('admin')
      <form id="form-delete-{{ $post->id }}" action="{{ url('/posts/destroy/'.$post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('DELETE') }}
      </form>
    @endauth
    </div>

  @endif
@endforeach

  {{-- PAGINATION --}}
  <div class="ui sixteen wide column pagination-container">
    {{ $posts->links() }}
  </div>


{{-- MODAL DELETE --}}
<div class="ui mini modal">
  <div class="content">
    <h3>Voulez vraiment supprimer cet article ?</h3>
  </div>
  <div class="actions">
    <div class="ui approve button red approve-delete">Supprimer</div>
    <div class="ui cancel button">Annuler</div>
  </div>
</div>

  <script type="text/javascript">
    $(document).ready(function() {
      $('.delete-button').click(function() {
        var id = $(this).attr("id");
        $('.mini.modal').modal('show');
        $('.approve-delete').click(function() {
          $('#form-delete-'+id).submit();
        });
      });
    });
  </script>

@endsection
