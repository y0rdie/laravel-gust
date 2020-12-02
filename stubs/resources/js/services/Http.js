import axios from 'axios';
import Form from './Form';

axios.defaults.headers.common = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
};

axios.defaults.withCredentials = true;

export default {
    async get (url, config = {}) {
        return this.send('get', url, {}, config);
    },

    async post (url, data = {}, config = {}) {
        return this.send('post', url, data, config);
    },

    async put (url, data = {}, config = {}) {
        return this.send('put', url, data, config);
    },

    async patch (url, data = {}, config = {}) {
        return this.send('patch', url, data, config);
    },

    async delete (url, data = {}, config = {}) {
        return this.send('delete', url, data, config);
    },

    async send (method, url, data = {}, config = {}) {
        if (data instanceof Form) {
            data = data.export()
        }

        const response = await axios({ method, url, data, ...config });

        return response.data;
    },
}
