import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const priceMask = document.querySelector('.price-mask');
const form = priceMask.closest('form');

const onlyDigits = (string) => {
    return string.split("").filter(s => /\d/.test(s)).join("").padStart(3, "0");
}

const maskCurrency = (valor, locale = 'pt-BR', currency = 'BRL') => {
    return new Intl.NumberFormat(locale, {
      style: 'currency',
      currency
    }).format(valor);
};  

const mascaraMoeda = (event) => {
    const digits = onlyDigits(event.target.value);      
    const digitsFloat = digits.slice(0, -2) + "." + digits.slice(-2);

    event.target.value = maskCurrency(digitsFloat);
};
    
if (priceMask) {
    priceMask.addEventListener('input', mascaraMoeda);
}  

if (form) {
    form.addEventListener('submit', (event) => {      
        event.preventDefault();
        const digits = onlyDigits(priceMask.value)              
        const digitsFloat = digits.slice(0, -2) + "." + digits.slice(-2);      

        priceMask.value = digitsFloat;                 
        form.submit();
    });
}