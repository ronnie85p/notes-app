app.Form = function(formElement, options = {}) {
    this.options = {
        url: '',
        method: 'POST',
        contentType: 'multipart/form-data',
        ...options
    };

    this.formElement = formElement;

    this.init = () => {
        return this;
    }

    this.submit = (event) => {
        this.preventEvent(event);

        try {
            return axios(this.getRequestOptions())
                .then(response => response.data);
        } catch (error) {
            console.log('error', error)
        }
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

    this.getFieldFeedback = (field, status) => {
        let parent = this.getFieldParent(field);
        if (!parent) return null;

        return parent.querySelector(`.${status}-feedback`);
    }

    this.setFieldMessages = (field, messages, status) => {
        let feedback = this.getFieldFeedback(field, status);
        if (!feedback) return;
  
        for (let i in messages) {
            feedback.insertAdjacentHTML('BEFOREEND', `<div>${messages[i]}</div>`);
        }
    }

    this.setErrors = (errors) => {
        for (let name in errors) { console.log('name', name)
            let field = this.getField(name);
            if (!field) continue;

            this.setFieldStatus(field, 'invalid');
            this.setFieldMessages(field, errors[name], 'invalid')
        }
    }

    return this.init();
}