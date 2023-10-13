@extends('layout')

@section('head')
    <title>Home</title>
    <script type="text/javascript" src="{{ asset('js/home.js') }}" defer></script>
@endsection

@section('main_content')
    <main>
        <div id="rooms" class="rooms-wrapper">
            @foreach ($rooms as $room)
                <div id="{{ $room->id }}" class="room {{ $room->address }}">
                    <img src="{{ $room->image }}">
                    <div>
                        <span>{{ $room->name }}</span>
                        <span>{{ $room->address }}</span>
                        {{-- <span>{{ $room->description }}</span> --}}
                    </div>
                </div>
            @endforeach
        </div>
        <div id="calendar-1" class="demos__item-calendar"></div>
        <button class="my-btn" id="order">Забронировать</button>
        <div class="pop-up-wrapper">
            <form id="bookingForm" class="booking-form" method="POST">
                @csrf
                <input id="room_id" type="hidden" name="room_id" value="">
                <div id="show_booking_date" class="dateform"></div>
                <input id="booking_date" type="hidden" name="booking_date" value="">
                <div class="timeform">c
                    <select id="timebegin" class="timebegin" name="booking_start">
                        @for ($i = 8; $i < 20; $i++)
                            <option class="timebegin__option" value="{{ $i }}">{{ $i . ':00' }}</option>
                        @endfor
                    </select>
                    по
                    <select id="timeend" class="timeend" name="booking_end">
                        @for ($i = 9; $i < 21; $i++)
                            <option class="timeend__option" value="{{ $i }}">{{ $i . ':00' }}</option>
                        @endfor
                    </select>
                </div>
                <div class="groupformstep">
                    <div class="formstep">
                        ФИО:<input
                            name="fullname"pattern="(^[A-Z][a-z]+ [A-Z][a-z]+( [A-Z][a-z]+)?$)|(^[А-Я][а-я]+ [А-Я][а-я]+( [А-Я][а-я]+)?$)"
                            required>
                    </div>
                    <div class="formstep">
                        Возраст:<input name="age" pattern="^\d+$" required>
                    </div>
                    <div class="formstep">
                        Институт:
                        <select name="institute" required>
                            <option value="" disabled selected>Выберите Институт</option>
                            <option value="Другое">Другое</option>
                            <option value="Морской Колледж">Морской Колледж</option>
                            <option value="Аспирантура">Аспирантура</option>
                            <option value="ИИТ">ИИТ</option>
                            <option value="ИЯЭиП">ИЯЭиП</option>
                            <option value="ЮИ">ЮИ</option>
                            <option value="МИ">МИ</option>
                            <option value="ИРиИТС">ИРиИТС</option>
                            <option value="ИФЭиУ">ИФЭиУ</option>
                            <option value="ПИ">ПИ</option>
                            <option value="ИОНиМО">ИОНиМО</option>
                            <option value="ГПИ">ГПИ</option>
                            <option value="ИФМиЗ">ИФМиЗ</option>
                            <option value="ИРГ">ИРГ</option>
                            <option value="ИПИ">ИПИ</option>
                        </select>
                    </div>
                    <div class="formstep">
                        <select name="course" required>
                            <option value="" disabled selected>Выберите курс</option>
                            <option value="Другое">Другое</option>
                            <option value="1 курс">1 курс</option>
                            <option value="2 курс">2 курс</option>
                            <option value="3 курс">3 курс</option>
                            <option value="4 курс">4 курс</option>
                            <option value="1 курс магистратура">1 курс магистратура</option>
                            <option value="2 курс магистратура">2 курс магистратура</option>
                        </select>
                    </div>
                    <div class="formstep">
                        Телефон:<input name="phone" pattern="((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,20}" required>
                    </div>
                    <div class="formstep">
                        Контакты:<input name="social_network" required>
                    </div>
                </div>
                <button class="my-btn orderform">Забронировать</button>
            </form>
        </div>
    </main>
    <x-footer />
@endsection
