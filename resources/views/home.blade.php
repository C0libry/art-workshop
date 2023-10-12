@extends('layout')

@section('head')
    <title>Home</title>
    <script type="text/javascript" src="{{ asset('js/home.js') }}" defer></script>
@endsection

@section('main_content')
    <div id="rooms" class="rooms-wrapper">
        @foreach ($rooms as $room)
            <div class="room">
                <img src="{{ $room->image }}">
                <span>{{ $room->name }}</span>
                {{-- <span>{{ $room->description }}</span> --}}
            </div>
        @endforeach
    </div>
    <div id="calendar-1" class="demos__item-calendar"></div>
    <button id="order">Забронировать</button>
    <form id="bookingForm" method="POST">
        @csrf
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
                    <option value="institute_other">Другое</option>
                    <option value="institute_maritame_college">Морской Колледж</option>
                    <option value="institute_postgraduate">Аспирантура</option>
                    <option value="institute_iit">ИИТ</option>
                    <option value="institute_ilep">ИЯЭиП</option>
                    <option value="institute_yi">ЮИ</option>
                    <option value="institute_mi">МИ</option>
                    <option value="institute_irits">ИРиИТС</option>
                    <option value="institute_ifenu">ИФЭиУ</option>
                    <option value="institute_pi">ПИ</option>
                    <option value="institute_ionmo">ИОНиМО</option>
                    <option value="institute_gpi">ГПИ</option>
                    <option value="institute_ifmc">ИФМиЗ</option>
                    <option value="institute_irg">ИРГ</option>
                    <option value="institute_ipi">ИПИ</option>
                </select>
            </div>
            <div class="formstep">
                <select name="course" required>
                    <option value="" disabled selected>Выберите курс</option>
                    <option value="course_other">Другое</option>
                    <option value="course_1">1 курс</option>
                    <option value="course_2">2 курс</option>
                    <option value="course_3">3 курс</option>
                    <option value="course_4">4 курс</option>
                    <option value="course_1_mage">1 курс магистратура</option>
                    <option value="course_2_mage">2 курс магистратура</option>
                </select>
            </div>
            <div class="formstep">
                Телефон:<input name="phone" pattern="((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,20}" required>
            </div>
            <div class="formstep">
                Контакты:<input name="social_network" required>
            </div>
        </div>
        <button class="orderform">Забронировать</button>
    </form>
    <x-footer />
@endsection
