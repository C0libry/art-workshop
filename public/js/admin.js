let form = document.getElementById('approve_form');
form.addEventListener('submit', approve);

async function approve(event) {
    let formData = new FormData(form);
    event.preventDefault();
    const url = '/booking_approve';
    const options = {
        method: 'POST',
        body: formData,
    };

    try {
        const response = await fetch(url, options);
        const result = await response.text();
        if (response.status === 200 && result)
            event.target.querySelector('ion-icon').setAttribute('name', 'close-outline');
        else
            event.target.querySelector('ion-icon').setAttribute('name', 'checkmark-outline');
        return result;
    } catch (error) {
        console.error(error);
    }
}
