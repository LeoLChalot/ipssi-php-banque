const PASSWORD_FIELD_ID = 'mdp';
const PASSWORD_CONFIRM_FIELD_ID = 'mdp-confirmation';
const SUBMIT_BUTTON_ID = 'submit';

const caracteresElement = document.getElementById('caracteres');
const majusculesElement = document.getElementById('majuscules');
const minusculesElement = document.getElementById('minuscules');
const chiffresElement = document.getElementById('chiffres');
const specialElement = document.getElementById('special');

const passwordField = document.getElementById(PASSWORD_FIELD_ID);
const passwordConfirmField = document.getElementById(PASSWORD_CONFIRM_FIELD_ID);
const submitButton = document.getElementById(SUBMIT_BUTTON_ID);

function checkPassword() {
    const password = document.getElementById(PASSWORD_FIELD_ID).value;
    const passwordConfirm = document.getElementById(PASSWORD_CONFIRM_FIELD_ID).value;
    const submitButton = document.querySelector('#' + SUBMIT_BUTTON_ID);

    function hasSpaces(password) {
        return /\s/.test(password);
    }

    // Fonctions pour vérifier les critères
    function hasMinLength(password) {
        return password.length >= 8;
    }

    function hasUpperCase(password) {
        return /[A-Z]/.test(password);
    }

    function hasLowerCase(password) {
        return /[a-z]/.test(password);
    }

    function hasNumber(password) {
        return /\d/.test(password);
    }

    function hasSpecialChar(password) {
        return /[!@#$%^&*()_+{}[\]:;<>,.?~\\|/§]/.test(password);
    }

    // Mettre à jour les couleurs des éléments en fonction des résultats

    caracteresElement.style.color = hasMinLength(password) ? 'green' : 'red';
    majusculesElement.style.color = hasUpperCase(password) ? 'green' : 'red';
    minusculesElement.style.color = hasLowerCase(password) ? 'green' : 'red';
    chiffresElement.style.color = hasNumber(password) ? 'green' : 'red';
    specialElement.style.color = hasSpecialChar(password) ? 'green' : 'red';



    // Activer le bouton de soumission si tous les critères sont valides
    submitButton.disabled = (
        !hasSpaces(password) &&
        hasMinLength(password) &&
        hasUpperCase(password) &&
        hasLowerCase(password) &&
        hasNumber(password) &&
        hasSpecialChar(password) &&
        password === passwordConfirm
    ) ? false : true;
}

passwordField.addEventListener('input', checkPassword);

