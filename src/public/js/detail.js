    const dateInput = document.getElementById('date');
    const timeInput = document.getElementById('time');
    const numberInput = document.getElementById('number');

    const selectedDate = document.getElementById('selected-date');
    const selectedTime = document.getElementById('selected-time');
    const selectedNumber = document.getElementById('selected-number');

    dateInput.addEventListener('input', function() {
        selectedDate.textContent = dateInput.value ? dateInput.value : '未選択';
    });

    timeInput.addEventListener('input', function() {
        selectedTime.textContent = timeInput.value ? timeInput.value : '未選択';
    });

    numberInput.addEventListener('input', function() {
        selectedNumber.textContent = numberInput.value ? numberInput.value + '人' : '未選択';
    });