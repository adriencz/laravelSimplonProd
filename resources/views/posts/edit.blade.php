@extends('layouts.master')

@section('body')

  <div class="ui sixteen wide column">
    <div class="ui grid centered">
      {{-- FORM --}}
      <form class="ui sixteen wide mobile sixteen wide tablet thirteen wide column computer form-create" action="{{ url('/posts/update/'.$post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}

        <h2><i class="edit icon"></i> Modifier l'article : {{ $post->id }}</h2>

        @if ($errors->any())
          <div class="ui negative message">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="ui field sixteen wide">
          <label for="title">Titre de l'article :</label>
          <input class="title-create" type="text" name="title" value="{{ $post->title }}" id="title">
        </div>

        <label for="file">Illustration de l'article :</label>
        <div class="ui field ten wide file-button-container">
          @if (isset($post->illustration->filename))
            <img id="imgupload" src="{{ url('/storage/'.$post->illustration->filename) }}" alt="your image" />
          @endif
          <div class="ui action input">
              <input type="text" readonly>
              <label for="file" class="ui icon button">
                <i class="cloud upload alternate icon"></i><p>Modifier l'image</p>
              </label>
              <input type="file" name="illustration" id="imgInp" style="display: none;">
          </div>
        </div>

        <div class="ui field sixteen wide">
          <label for="content">Contenu de l'article :</label>
          <textarea id="content" name="content">{!! $post->content !!}</textarea>
        </div>


        <div class="ui field sixteen wide form-buttons buttons-tiny">
          <button class="ui button red" id="delete-edit" type="button">Supprimer</button>
          <button class="ui primary button" type="submit">Modifier</button>
        </div>
      </form>


      <form id="form-delete-edit" action="{{ url('/posts/destroy/'.$post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('DELETE') }}
      </form>
    </div>
  </div>

  <div class="ui mini modal">
    <div class="content">
      <h3>Voulez vraiment supprimer cet article ?</h3>
    </div>
    <div class="actions">
      <div class="ui approve button red approve-delete-edit">Supprimer</div>
      <div class="ui cancel button">Annuler</div>
    </div>
  </div>

  <script>tinymce.init({ selector:'textarea' });</script>

  <script type="text/javascript">
    $(document).ready(function() {

      // DISPLAY CONFIRMATION MODAL
      $('#delete-edit').click(function() {
        $('.mini.modal').modal('show');
      });

      // CONFIRMATION (SUBMIT)
      $('.approve-delete-edit').click(function() {
        $('#form-delete-edit').submit();
      });

    });
  </script>

@endsection
