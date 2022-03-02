export const validateHhMm = (value) => {
    var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(value);
    return isValid;
}
export const validateYYMMDD = (value) => {
    var isValid = /^\d{4}-\d{2}-\d{2}$/.test(value);
    return isValid;
}
