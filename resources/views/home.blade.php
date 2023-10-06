@extends('layout')

@section('head')
    <title>Home</title>
@endsection

@section('main_content')
    <div class="contacts">
        <div class="contacts__info">
            <div class="contacts__info-block">
                <div class="contacts__info-text">Служба поддержки: </div>
                <ion-icon name="call-outline"></ion-icon>
                <div class="contacts__info-text">+7 (978) 888-88-88</div>
            </div>

            <div class="contacts__info-block">
                <ion-icon name="mail-outline"></ion-icon>
                <div class="contacts__info-text">TvorcheskiCheh@mail.ru</div>
            </div>
        </div>

        <div class="contacts__icons">
            <a href=""><ion-icon name="logo-vk"></ion-icon></a>
        </div>
    </div>
@endsection
