let href = window.location.href;
let form = document.getElementById('bookingForm');
let order = document.getElementById('order');

order.addEventListener("click", show_form);
form.addEventListener('submit', booking_room);
document.querySelector('#timebegin').addEventListener('change', timebegin_blur);
document.querySelectorAll('.room').forEach(element => {
    element.addEventListener('click', select_room);
});

document.querySelector('#bookingForm').style.display = "none";

async function booking_room(event) {
    let formData = new FormData(form);
    event.preventDefault();
    const url = '/booking_room';
    const options = {
        method: 'POST',
        body: formData,
    };

    try {
        const response = await fetch(url, options);
        const result = await response.text();
        console.log(result);
        document.querySelector('#bookingForm').style.display = "none";
        return result;
    } catch (error) {
        console.error(error);
    }
}

function show_form() {

    // Проверяем, что аудитория была выбрана
    if (document.querySelector('#room_id').value === '') {
        alert('Выберите аудиторию');
        return;
    }

    // Проверяем, что дата была выбрана
    if (!document.querySelector('.calendarev-day-selected')) {
        alert('Выберите дату');
        return;
    }

    // Формируем даты
    let date = new Date();
    let now = new Date();

    // Заполняем даты
    date.setDate(+document.querySelector('.calendarev-day-selected').innerText);
    date.setMonth(+document.querySelector('.calendarev-month').value);
    date.setFullYear(+document.querySelector('.calendarev-years').value);
    now.setHours(0);

    // Проверка на выбранную дату
    if (now > date) {
        alert("Вы не можете записаться на прошедший день");
        return;
    }

    document.querySelector('#bookingForm').style.display = "block";
    document.querySelector('#show_booking_date').innerText = date.toLocaleDateString();
    document.querySelector('#booking_date').value = date.toLocaleDateString('ru');
}

function timebegin_blur() {
    let begin = document.querySelector('#timebegin').value;
    let end = document.querySelector('#timeend').value;
    if (+begin >= +end) {
        document.querySelector('#timeend').querySelector('[value="' + (+begin + 1) + '"]').selected = true;
    }
    document.querySelectorAll('.timeend__option').forEach(element => {
        if (+begin >= +element.value) {
            element.disabled = true;
            element.style.display = "none";
        } else {
            element.disabled = false;
            element.style.display = "block";
        }
    });
}

function select_room(event) {
    if (element = document.querySelector('.room--selected'))
        element.classList.remove('room--selected');
    event.currentTarget.classList.add('room--selected');
    document.querySelector('#room_id').value = event.currentTarget.id;
}
