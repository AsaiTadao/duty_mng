const APP_TOKEN_KEY = process.env.MIX_APP_TOKEN_KEY || 'lks_session';
const getToken = () => {
    const json = localStorage.getItem(APP_TOKEN_KEY);
    if (!json) {
        return null
    }
    try {
        return JSON.parse(json)
    } catch (e) {
        return json
    }
}
const saveToken = (token) => {
    if (token instanceof Object) {
        token = JSON.stringify(token);
    }
    localStorage.setItem(APP_TOKEN_KEY, token);
}
const removeToken = () => {
    saveToken(null)
}
const LocalStorage = {
    saveToken,
    getToken,
    removeToken
}
export default LocalStorage;
