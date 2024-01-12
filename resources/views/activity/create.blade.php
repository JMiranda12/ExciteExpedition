@extends('layouts.app')

@section('title')
    ExciteExpedition | {{ __("Alojar atividade") }}
@endsection

@section('content')
    <div class="container card">
        <div class="card-header">
            <h2>{{ __("Conta-nos mais acerca da atividade que queres divulgar.") }}</h2>
        </div>
        <div class="card-body">
            <form class="col-auto" method="POST" action="{{ route('activity.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <h3>{{ __("Detalhes:") }}</h3>
                        <label class="row">
                            <span class="bold">{{ __("Título") }}:</span>
                            <input type="text" class="@error('title') is-invalid @enderror" name="title" placeholder="{{ __("Título") }}" value="{{ old('title') }}"/>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>

                        <label class="row">
                            <span class="bold">{{ __("Preço") }}:</span>
                            <input type="number" class="@error('price') is-invalid @enderror" min="0" step="0.01" name="price" placeholder="Preço" value="{{ old('height') }}"/>
                        </label>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror

                        <label class="row">
                            <span class="bold">{{ __("Descrição") }}:</span>
                            <textarea type="text" class="@error('description') is-invalid @enderror" rows="4" name="description">{{ old('description') }}</textarea>
                        </label>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror

                        <label class="row">
                            <span class="bold">{{ __("Fotografias") }}:</span>
                            <input type="file" name="photos[]" multiple accept="image/*" class="@error('photos.*') is-invalid @enderror">
                            <small>{{ __("Upload multiple photos. Allowed formats: jpeg, png, jpg, gif. Max file size: 2048 KB each.") }}</small>

                            @error('photos.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </label>

                    </div>

                </div>
                <div>

                    <div class="col-1"></div>

                    <div class="col-4">
                        <label class="row">
                            <span class="bold">
                                {{ __("Linguagem") }}:
                            </span>
                            <select class="selector rounded form-select-sm @error('language_id') is-invalid @enderror" name="language_id">
                                <option disabled @if(!old('language_id') or old('language_id') == -1) selected @endif value="-1"> {{ __("Escolha uma linguagem") }} </option>
                                @foreach($possibleLanguages as $language)
                                    <option value="{{ $language->id }}" @if(old('language_id') == $language->id) selected @endif>{{ $language->name }}</option>
                                @endforeach
                            </select>
                            @error('language_id')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>
                        <label class="row">
                            <span class="bold">
                                {{ __("País") }}:
                            </span>
                            <select class="selector rounded form-select-sm @error('country_id') is-invalid @enderror" name="country_id">
                                <option disabled @if(!old('country_id') or old('country_id') == -1) selected @endif value="-1"> {{ __("Escolha um país") }} </option>
                                @foreach($possibleCountries as $country)
                                    <option value="{{ $country->id }}" @if(old('country_id') == $country->id) selected @endif>{{ $country->country }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>
                        <label class="row">
                            <span class="bold">
                                {{ __("Category") }}:
                            </span>
                            <select class="selector multi-select @error('category_id') is-invalid @enderror" name="category_id" multiple="multiple">
                                <option disabled selected value="-1" > {{ __("Select a category") }} </option>
                                @foreach($possibleCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>

                        <div class="row row-cols-auto mt-3">
                            <input class="btn-primary rounded" type="submit" value="{{ __("Submit") }}"/>
                        </div>

                        @if(session('message'))
                            <div class="alert-info m-5">
                                <span class="bold">{{ session('message') }}}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('.int-only').on('blur keyup change paste', function () {
                var $this = $(this);
                var val = $this.val();
                var valLength = val.length;
                var maxCount = $this.attr('maxlength');
                $this.val($this.val().replace(/[^0-9]/g,''));
                if(valLength>maxCount){
                    $this.val($this.val().substring(0,maxCount));
                }
            })
        })
    </script>
@endsection
