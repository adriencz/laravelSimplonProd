@extends('layouts.master')

@section('body')

      <form class="ui fourteen wide mobile ten wide tablet seven wide computer column form-create" method="post" action="{{ url('/admin/login') }}" enctype="multipart/form-data">
        @csrf
        {{ method_field('POST') }}
        <h2><i class="ui unlock icon"></i> Administation</h2>

        {{-- FORM and AUTH ERRORS --}}
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
          <label for="title">Nom d'administrateur :</label>
          <input class="title-create" type="text" name="email" value="" id="title" placeholder="Entrez le nom d'administrateur">
        </div>

        <div class="ui field sixteen wide">
          <label for="file">Mot de passe :</label>
          <input class="title-create" type="password" name="password" value="" id="title" placeholder="Saisissez votre mot de passe">
        </div>

        <div class="ui field sixteen wide form-buttons">
          <button class="ui teal button" type="submit">Se connecter</button>
        </div>

      </form>
@endsection
