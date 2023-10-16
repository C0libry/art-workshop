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
        <button class="my-btn my-btn-margin" id="order">Забронировать</button>
        <div class="pop-up-wrapper">
            <form id="bookingForm" class="pop-up-form" method="POST">
                @csrf
                <input id="room_id" type="hidden" name="room_id" value="">
                <label id="show_booking_date" class="dateform form-label">Возраст</label>
                <input id="booking_date" type="hidden" name="booking_date" value="">
                <div class="time-form">c
                    <select id="timebegin" class="form-select" name="booking_start">
                        @for ($i = 8; $i < 20; $i++)
                            <option class="timebegin__option" value="{{ $i }}">{{ $i . ':00' }}</option>
                        @endfor
                    </select>
                    по
                    <select id="timeend" class="form-select" name="booking_end">
                        @for ($i = 9; $i < 21; $i++)
                            <option class="timeend__option" value="{{ $i }}">{{ $i . ':00' }}</option>
                        @endfor
                    </select>
                </div>
                <label class="form-label">ФИО</label>

                <input class="form-control block mt-1 w-full" name="fullname"
                    pattern="(^[A-Z][a-z]+ [A-Z][a-z]+( [A-Z][a-z]+)?$)|(^[А-Я][а-я]+ [А-Я][а-я]+( [А-Я][а-я]+)?$)"
                    required>
                <label class="form-label">ФИО</label>

                <input class="form-control block mt-1 w-full" name="age" pattern="^\d+$" required>
                <label class="form-label">Возраст</label>

                <select class="form-select" name="institute" required>
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
                <label class="form-label">Институт</label>

                <select class="form-select" name="course" required>
                    <option value="" disabled selected>Выберите курс</option>
                    <option value="Другое">Другое</option>
                    <option value="1 курс">1 курс</option>
                    <option value="2 курс">2 курс</option>
                    <option value="3 курс">3 курс</option>
                    <option value="4 курс">4 курс</option>
                    <option value="1 курс магистратура">1 курс магистратура</option>
                    <option value="2 курс магистратура">2 курс магистратура</option>
                </select>
                <label class="form-label">Курс</label>

                <input class="form-control block mt-1 w-full" name="phone"
                    pattern="((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,20}" required>
                <label class="form-label">Телефон</label>

                <input class="form-control block mt-1 w-full" name="social_network" required>
                <label class="form-label">Контакты</label>

                <button class="my-btn my-btn-margin">Забронировать</button>
            </form>
        </div>
    </main>
    <x-footer />
@endsection
