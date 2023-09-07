//This code add extra functionality for Measurement Price Calculator Plugin by SkyVerge
//https://woocommerce.com/es-es/products/measurement-price-calculator/

// By default, this plugin does not allow a <input> of units to be activated when selecting any
// variation of the specified product and the <input> quantity of the calculator is deactivated (kg, mts, etc.)

// What we do with this code is to enable this option, taking advantage of the functionality itself
// native to Woocommerce but keeping the functionalities of the price calculator
// depending on the variation we select.

// First, it checks if there is a <select> (whose options will be the variations of
// our product) with a specific ID and save it in a variable.
// This is so that the functionality does not apply to all products in the store.
var select = document.getElementById("ADD_SELECT_ID");

if (select) {
    // Check if the option with that value exists in the <select>
    var optionExists = false;
    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].value === "VARIATION_VALUE") {
        // If you need this functionality to be activated when other variations are selected
        // use the OR operator to add more values ​​like this:
        // if (select.options[i].value === "VARIATION_VALUE" || select.options[i].value === "VARIATION_VALUE_2" || ...)  
            optionExists = true;
            break;
        }
    }

    // If the <select> exists and the option exists (or if the values ​​exist), execute the functionality
    if (optionExists) {
        showWoocommerceUnitInput();
        var elementsQty = document.querySelectorAll('.qty');
        // Find the native Woocommerce quantity <input> and hide or show it
        // depending on whether optionExists is true or false.
        elementsQty.forEach(function (element) {
            element.style.display = 'none';
        });
    }
}

// Function to execute
function showWoocommerceUnitInput() {
    // In order to execute the function, it is necessary that within the product page,
    // you manage to show the value of the unit product that you want to calculate (kg, mts, etc.)
    // if you use a plugin like JetEngine or Advanced Custom Fields you can enter dynamically
    // said value with the use of fields or dynamic labels.
    
    // You will also need to give it a CSS class to be able to identify it.

    // First we look for the value of that dynamic field and save it in a variable:
    var tdElement = document.querySelector(".CUSTOM_CSS_CLASS_OF_VALUE");
    
    // If it is a string of numeric and alphabetic values, we take only the numeric value
    var tdText = tdElement.textContent;
    var numericValue = parseFloat(tdText);

    // We define the constants with which we are going to work

    // We store the native Woocommerce units <input> in a constant.
    const inputElement = document.querySelector('.qty');

    // We store the <select> of product variations in a constant.
    const selectElement = document.getElementById('ADD_SELECT_ID');

    // We save the quantity <input> from the calculator.
    // The ID of the <input> can vary, depending on the unit of measure you're working with.
    // In this example, we will work with the unit of weight:
    const weightNeededElement = document.getElementById('weight_needed');

    selectElement.addEventListener('change', function () {
        if (selectElement.value === 'VARIATION_VALUE') {
            // If you need this functionality to be activated when other variations are selected
            // use the OR operator to add more values ​​like this:
            // if (selectElement.value === 'VARIATION_VALUE' || if (selectElement.value === 'VARIATION_VALUE_2' || ...) 
            
            // We show the native Woocommerce units <input>.
            inputElement.style.display = 'block';

            // We update the value of the calculator's quantity <input> by the value of the weight of a unit.
            weightNeededElement.value = numericValue;

            // We lock the value of the calculator's quantity <input> so that custom values ​​cannot be entered.
            weightNeededElement.disabled = true;
            // With this we can show the weight of a unit and enable the native Woocommerce <input> so that they can be added
            // products per unit.

            // OPTIONAL: Change the <label> text of the calculator amount <input> to a custom text.

            // We look up the <label> of the quantity <input> of the calculator and store it in a constant.
            const labelElement = document.querySelector(`label[for="${weightNeededElement.id}"]`);

            // We change the text for a personalized one.
            if (labelElement) {
                labelElement.textContent = 'ADD_CUSTOM_TEXT';
            }
        } else {
            // If the conditions are not met, the default values ​​are restored.
            inputElement.style.display = 'none';
            weightNeededElement.value = 0;
            weightNeededElement.disabled = false;
            weightNeededElement.style.color = '';
            const labelElement = document.querySelector(`label[for="${weightNeededElement.id}"]`);
            if (labelElement) {
                labelElement.textContent = '';
            }
        }
    });
}


