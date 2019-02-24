@extends('layouts.master')

@section('body')

  <div class="ui sixteen wide column">
    <div class="ui grid centered">
      <form class="ui sixteen wide mobile sixteen wide tablet thirteen wide column computer form-create" action="{{ url('/posts/store') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('POST') }}

        <h2><i class="plus circle icon"></i> Creation d'un article</h2>

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
          <input class="title-create" type="text" name="title" value="" id="title" placeholder="Tapez un titre pour ovtre article ...">
        </div>

        <label for="file">Illustration de l'article :</label>

        <div class="ui field ten wide file-button-container">
          <img id="imgupload" src="/img/upload-default.png" alt="your image" />
          <div class="ui action input">
              <input type="text" readonly>
              <label for="file" class="ui icon button">
                <i class="cloud upload alternate icon"></i><p>Open File</p>
              </label>
              <input type="file" id="imgInp" name="illustration" style="display: none;">
          </div>
        </div>

        <div class="ui field sixteen wide">
          <label for="content">Contenu de l'article :</label>
          <textarea id="content" name="content">Next, use our Get Started docs to setup Tiny!</textarea>
        </div>

        <div class="ui field sixteen wide form-buttons buttons-tiny">
          <button class="ui button red" type="reset">Effacer</button>
          <button class="ui primary button" type="submit">Création</button>
        </div>

      </form>
    </div>
  </div>

  <script>tinymce.init({ selector:'textarea' });</script>

@endsection
