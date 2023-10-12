let href = window.location.href;
let form = document.getElementById('bookingForm');
let order = document.getElementById('order');

order.addEventListener("click", show_form);
form.addEventListener('submit', booking_room);
document.querySelector('#timebegin').addEventListener('change', timebegin_blur);
document.querySelector('#timeend').addEventListener('change', timeend_blur);

console.log(href);
console.log('test');

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
    document.querySelector('#booking_date').value = date.toLocaleDateString();
    document.querySelector('.dateform').innerText = date.toLocaleDateString();
}

// function form_time() {
//     // for (let i = 0; i < 15; i++) {}
//     let begin = document.querySelector('#timebegin').value;
//     let end = document.querySelector('#timeend').value;
//     // document.querySelector('.timebegin__option').value
//     if (begin >= end) {
//         if (end < 21) {
//             end++;
//         } else {
//             begin--;
//         }
//     }
// }

function timebegin_blur() {
    let begin = document.querySelector('#timebegin').value;
    let end = document.querySelector('#timeend').value;
    console.log(begin + " " + end);
    if (+begin >= +end) {
        document.querySelector('#timeend').querySelector('[value="' + (+begin + 1) +'"]').selected = true;
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

function timeend_blur() {
}