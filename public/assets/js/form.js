let form_errors = {};

app.Form = function(formElement, options = {}) {
    this.options = {
        url: '',
        method: 'POST',
        contentType: 'multipart/form-data',
        ...options
    };

    this.formElement = formElement;

    this.submit = async (event) => {
        this.preventEvent(event);

        this.resetErrors();

        return await axios(this.getRequestOptions())
                .then(response => response.data)
                .catch(error => {
                    if (error.response) {
                        this.setErrors(error.response.data.errors);
                    }

                    throw error;
                })
    }

    this.getRequestOptions = () => {
        return {
            url: this.options.url,
            data: this.getFormData(),
            method: this.getRequestMethod(),
            headers: {
                'Content-Type': this.options.contentType
            },
        };
    }

    this.getRequestMethod = () => {
        let method = this.options.method.toUpperCase();
        if (method == 'PUT') {
            method = 'POST';
        }

        return method;
    };

    this.getFormData = () => {
        let data = new FormData(this.formElement);
        if (this.options.method.toUpperCase() == 'PUT') {
            data.set('_method', 'PUT');
        }

        data.set('_token', this.getCsrfToken());

        return data;
    }

    this.getCsrfToken = () => {
        return document
            .querySelector("meta[name='csrf']")
            ?.getAttribute("content");
    },

    this.handleEvent = (event) => {
        if (this.options.preventEvent === true) {
            this.preventEvent(event);
        }
    }

    this.preventEvent = (event) => {
        event.preventDefault();
    };

    this.getField = (name) => {
        return name in this.formElement ? this.formElement[name] : null;
    }

    this.getFieldParent = (field) => {
        return field.closest('.form-group') || field.parentNode;
    }

    this.setFieldStatus = (field, status) => {
        field.classList.add(`is-${status}`);
    }

    this.removeFieldStatus = (field, status) => {
        field.classList.remove(`is-${status}`);
    }

    this.getFieldFeedback = (field, status) => {
        let parent = this.getFieldParent(field);
        if (!parent) return null;

        return parent.querySelector(`.${status}-feedback`);
    }

    this.setFieldMessages = (field, messages, status) => {
        let feedback = this.getFieldFeedback(field, status);
        if (!feedback) return;
  
        feedback.innerHTML = '';
        for (let i in messages) {
            feedback.insertAdjacentHTML('BEFOREEND', `<div>${messages[i]}</div>`);
        }
    }

    this.removeFieldMessages = (field, status) => {
        let feedback = this.getFieldFeedback(field, status);
        if (feedback) feedback.innerHTML = '';
    }
 
    this.resetErrors = () => {
        for (let name in form_errors) {
            let field = this.getField(name);
            if (!field) continue;

            this.removeFieldStatus(field, 'invalid');
            this.removeFieldMessages(field, 'invalid');
        }

        form_errors = {};
    }

    this.setErrors = (errors) => {
        for (let name in errors) { 
            let field = this.getField(name);
            if (!field) continue;

            this.setFieldStatus(field, 'invalid');
            this.setFieldMessages(field, errors[name], 'invalid')

            form_errors[name] = {
                msgs: errors[name],
                field
            }
        }

        for (let name in form_errors) {
            let obj = form_errors[name];

            obj.field.addEventListener('input', () => {
                this.removeFieldStatus(obj.field, 'invalid');
                this.removeFieldMessages(obj.field, 'invalid')
            }, false);
        }
    }

    return this;
}