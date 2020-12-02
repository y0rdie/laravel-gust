import FormErrors from './FormErrors'

export default class {

    constructor (initialData = {}, submitCallback = null) {
        this._initialData = initialData;
        this._submitCallback = submitCallback;
        this.errors = new FormErrors();
        this.reset();
    }

    reset () {
        this.busy = false;
        this.successful = false;
        this.errors.clear();
        Object.assign(this, this._initialData);
    }

    async submit (...args) {
        if (this.busy || ! this._submitCallback) {
            return;
        }

        this.beforeStart();

        const result = await this._submitCallback(this, ...args).catch(error => {
            this.onFailure(error);

            throw error;
        });

        this.onSuccess();

        return result;
    }

    export () {
        return { ...this }
    }

    beforeStart () {
        this.busy = true;
        this.successful = false;
        this.errors.clear();
    }

    onSuccess () {
        this.busy = false;
        this.successful = true;
    }

    onFailure (error) {
        this.busy = false;

        if (error.response && error.response.data) {
            const { errors, message } = error.response.data;

            this.setErrors(errors, message);
        }
    }

    setErrors (errors, message) {
        this.errors.set(errors, message);
    }
}
