@extends('layouts.master')

@section('title', ''.$posts->total().' résultats pour : "'.$word.'"')

@section('body')

  {{-- COUNT FOUNDED POSTS --}}

  <div class="ui sixteen wide column header-search">
    <h2>{{ $posts->total() }} résultats pour : " {{ $word }} "</h2>
  </div>

@foreach ($posts as $post)

    <div class="ui five wide widescreen five wide large screen height wide computer eight wide tablet sixteen wide mobile column articles-home secondaries-articles">
      <div class="article-content">
      <div class="ui grid">
        <div class="ui sixteen wide column img-article-container" @if (isset($post->illustration->filename)) style="background-image: url('{{ url('/storage/'.$post->illustration->filename) }}');" @endif>
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

@endforeach


  {{-- PAGINATION --}}
  <div class="ui sixteen wide column pagination-container">
    {{ $posts->links() }}
  </div>


  {{-- DELETE MODAL --}}
  <div class="ui mini modal">
    <div class="content">
      <h3>Voulez vraiment supprimer cet article ?</h3>
    </div>
    <div class="actions">
      <div class="ui approve button red approve-delete">Supprimer</div>
      <div class="ui cancel button">Annuler</div>
    </div>
  </div>


  <style media="screen">
  .ui.grid.grid-body.container {
    margin-left: 340px;
    padding-top: 110px !important;
  }
  </style>


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
