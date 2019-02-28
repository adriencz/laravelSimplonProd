@extends('layouts.master')

@section('title', $post->title)

@section('body')

<div class="ui container grid centered">
  <div class="ui fourteen wide widescreen thirteen wide large screen sixteen wide computer column article-show">
    <div class="article-content">
    <div class="ui grid centered grid-show">
      <div class="ui sixteen wide column img-article-container" @if (isset($post->illustration->filename))style="background-image: url('{{ url('/storage/'.$post->illustration->filename) }}')"@endif>
        <h3><a href=""><mark>{{ $post->title }}</mark></a></h3>
      </div>
      <div class="extra">
      @guest ('admin')
        <i class="facebook f icon"></i>
        <i class="ui twitter icon"></i>
      @endguest
      @auth ('admin')
        <a href="{{ url('/posts/edit/'.$post->id.'') }}">
          <i class="ui edit icon"></i>
        </a>
        <a href="#" class="delete-button" id="delete-show">
          <i class="ui times circle outline icon"></i>
        </a>
      @endauth
      </div>
      <div class="ui sixteen wide column text-article-container">
        <span class="date">{{ date_format($post->created_at,"d/m/Y") }} @if (date_format($post->created_at,"d/m/Y") != date_format($post->updated_at,"d/m/Y")) (modifié le {{ date_format($post->updated_at,"d/m/Y") }}) @endif</span>
        {!! $post->content !!}
      </div>
    </div>
  </div>
  </div>
  </div>

  {{-- DELETE FORM --}}
  <form id="form-delete-show" action="{{ url('/posts/destroy/'.$post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('DELETE') }}
  </form>

  {{-- DELETE MODAL --}}
  <div class="ui mini modal">
    <div class="content">
      <h3>Voulez vraiment supprimer cet article ?</h3>
    </div>
    <div class="actions">
      <div class="ui approve button red approve-delete-show">Supprimer</div>
      <div class="ui cancel button">Annuler</div>
    </div>
  </div>

  <style media="screen">
  .ui.grid.grid-body.container {
    margin-left: 340px;
    padding-top: 55px !important;
  }
  </style>

  <script type="text/javascript">
      $(document).ready(function() {

        // DISPLAY CONFIRMATION MODAL
        $('#delete-show').click(function() {
          $('.mini.modal').modal('show');
        });

        // CONFIRMATION (SUBMIT)
        $('.approve-delete-show').click(function() {
          $('#form-delete-show').submit();
        });

      });
  </script>

@endsection
