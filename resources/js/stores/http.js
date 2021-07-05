import axios from 'axios';

function interceptHttpError(error) {
    if(error.response?.status === 401) {
        window.location.href =  "/login";
    }
    return Promise.reject(error);
}

const http = {
    get: (url, config) => {
        return axios.get(url, config).catch(interceptHttpError);
    },
    delete: (url, config) => {
        return axios.delete(url, config).catch(interceptHttpError);
    },
    post: (url, data, config) => {
        return axios.post(url, data, config).catch(interceptHttpError);
    },
    put: (url, data, config) => {
        return axios.post(url, data, config).catch(interceptHttpError);
    }
};

export default http;