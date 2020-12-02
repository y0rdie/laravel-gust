export default class {

    constructor () {
        this.errors = {};
        this.message = null;
    }

    set (errors, message) {
        this.errors = errors || {};
        this.message = message || null;
    }

    has (field) {
        return Object.keys(this.errors).includes(field);
    }

    get (field) {
        if (this.has(field)) {
            const error = this.errors[field];
            return Array.isArray(error) && error.length > 0 ? error[0] : error;
        }
    }

    clear (field) {
        if (field) {
            Vue.delete(this.errors, field);
        } else {
            this.errors = {};
            this.message = null;
        }
    }
}
