var select = document.getElementById("pa_tipo-de-cortes");

if (select) {
    var optionExists = false;
    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].value === "corte-completo" || select.options[i].value === "envasado") {
            optionExists = true;
            break;
        }
    }

    if (optionExists) {
        miFuncion();
        var elementosQty = document.querySelectorAll('.qty');
        elementosQty.forEach(function (elemento) {
            elemento.style.display = 'none';
        });
    }
}

function miFuncion() {
    var tdElement = document.querySelector(".product-weight-cc");
    var tdText = tdElement.textContent;
    var valorNumerico = parseFloat(tdText);
    var tdElementTwo = document.querySelector(".product-weight-e");
    var tdTextTwo = tdElementTwo.textContent;
    var valorNumericoTwo = parseFloat(tdTextTwo);
    const inputElement = document.querySelector('.qty');
    const selectElement = document.getElementById('pa_tipo-de-cortes');
    const weightNeededElement = document.getElementById('weight_needed');

    selectElement.addEventListener('change', function () {
        if (selectElement.value === 'corte-completo') {
            inputElement.style.display = 'block';
            weightNeededElement.value = valorNumerico;
            weightNeededElement.style.color = 'grey';
            weightNeededElement.disabled = true;
            const labelElement = document.querySelector(`label[for="${weightNeededElement.id}"]`);
            if (labelElement) {
                labelElement.textContent = 'Cantidad fijada (kg)';
            }
        } else if (selectElement.value === 'envasado') {
            inputElement.style.display = 'block';
            weightNeededElement.value = valorNumericoTwo;
            weightNeededElement.style.color = 'grey';
            weightNeededElement.disabled = true;
            const labelElement = document.querySelector(`label[for="${weightNeededElement.id}"]`);
            if (labelElement) {
                labelElement.textContent = 'Cantidad fijada (kg)';
            }
        } else {
            inputElement.style.display = 'none';
            weightNeededElement.value = 0;
            weightNeededElement.disabled = false;
            weightNeededElement.style.color = '';
            const labelElement = document.querySelector(`label[for="${weightNeededElement.id}"]`);
            if (labelElement) {
                labelElement.textContent = 'Ingresar cantidad (kg)';
            }
        }
    });
}