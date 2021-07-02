import axios from 'axios';
axios.defaults.headers.common['Content-Type'] = 'application/json';

const AxiosConstants = {
    headers: { "Content-Type": "application/json" }
}

function get(url) {
    return axios.get(url);
}

function post(url) {
    return axios.post(url);
}

function put(url) {
    return axios.put(url);
}


const AxiosFunctions = {
    get,
    post,
    put,
}

export {
    AxiosFunctions
};