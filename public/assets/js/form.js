let form_errors = {};

app.Form = function(formElement, options = {}) {
    this.options = {
        url: '',
        method: 'POST',
        contentType: 'multipart/form-data',
        handleResponseErrors: true,
        submitterMuted: true,
        feedbackTpl: '<div class="alert alert-{type}">{message}</div>',
        // feedbackErrorTpl: `<div class="alert alert-danger"></div>`,
        // feedbackSuccessTpl: `<div class="alert alert-success"></div>`,
        // feedbackWarningTpl: `<div class="alert alert-warning"></div>`,
        ...options
    };

    this.formElement = formElement;
    this.formFeedback = formElement.querySelector('.form-feedback');

    /**
     * Отправить запрос
     * 
     * @param {*} event 
     * @returns 
     */
    this.submit = (event) => {
        this.beforeSubmit(event);

        return axios(this.getRequestOptions())
                .then(response => response.data)
                .catch(error => {
                    if (this.options.handleResponseErrors === true && error.response) {
                        const { errors, message } = error.response.data;
                        this.setFeedback(message, 'danger');
                        this.setErrors(errors);
                    }

                    throw error;
                })
                .finally(() => {
                    this.afterSubmit();
                });
    }

    /**
     * Обработать код до отправки запроса
     * 
     * @param {*} event 
     */
    this.beforeSubmit = (event) => {
        this.preventEvent(event);
        this.setFeedback('');
        this.resetErrors();

        this.submitter = this.getSubmitter(event);
        this.submitter.disabled();

        this.formElement.style.pointerEvents = 'none';
        // this.formElement.style.opacity = .8;
    }

    /**
     * Обработать код после отправки запроса
     */
    this.afterSubmit = () => {
        this.submitter.disabled(false);

        this.formElement.style.pointerEvents = '';
        // this.formElement.style.opacity = '';
    }

    /**
     * Установить фидбэк для формы
     * 
     * @param {*} msg 
     * @param {*} type 
     * @returns 
     */
    this.setFeedback = (msg, type = 'default') => {
        if (!this.formFeedback) return;

        this.formFeedback.innerHTML = msg 
            ? this.options.feedbackTpl
                .replace('{type}', type)
                .replace('{message}', msg)
            : '';
    }

    /**
     * Получить конфигурацию для запроса
     * 
     * @returns 
     */
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

    /**
     * Получить метод запроса
     * 
     * @returns 
     */
    this.getRequestMethod = () => {
        let method = this.options.method.toUpperCase();
        if (method == 'PUT') {
            method = 'POST';
        }

        return method;
    };

    /**
     * Получить данные формы
     * 
     * @returns 
     */
    this.getFormData = () => {
        let data = new FormData(this.formElement);
        if (this.options.method.toUpperCase() == 'PUT') {
            data.set('_method', 'PUT');
        }

        data.set('_token', this.getCsrfToken());

        return data;
    }

    /**
     * Получить csrf токен
     */
    this.getCsrfToken = () => {
        return document
            .querySelector("meta[name='csrf']")
            ?.getAttribute("content");
    },

    /**
     * Предотвратить выполнение события по умолчанию
     * 
     * @param {*} event 
     */
    this.preventEvent = (event) => {
        event.preventDefault();
    };

    this.getSubmitter = (event) => {
        const submitter = event.submitter;
        const submitterMuted = this.options.submitterMuted === true;

        return {
            disabled(disabled = true) {
                if (submitterMuted) {
                    submitter.disabled = disabled;
                }
            }
        }
    }

    /**
     * Получить поле по имени
     * 
     * @param {*} name 
     * @returns 
     */
    this.getField = (name) => {
        return name in this.formElement ? this.formElement[name] : null;
    }

    /**
     * Получить родителя (контекст) поля
     * 
     * @param {*} field 
     * @returns 
     */
    this.getFieldParent = (field) => {
        return field.closest('.form-group') || field.parentNode;
    }

    /**
     * Установить статус для поля
     * 
     * @param {*} field 
     * @param {*} msgs 
     * @param {*} status 
     */
    this.setFieldStatus = (field, msgs, status) => {
        field.classList.add(`is-${status}`);

        this.addFieldMessages(field, msgs, status);
    }

    /**
     * Удалить статус поля, и сообщения, если установлен соответствующий параметр
     * 
     * @param {*} field 
     * @param {*} status 
     * @param {*} removeMsgs 
     */
    this.removeFieldStatus = (field, status, removeMsgs = true) => {
        field.classList.remove(`is-${status}`);

        if (removeMsgs === true) {
            this.removeFieldMessages(field, status);
        }
    }

    this.setFieldStatusInvalid = (field, msgs) => {
        this.setFieldStatus(field, msgs, 'invalid');
    }

    this.removeFieldStatusInvalid = (field, removeMsgs = true) => {
        this.removeFieldStatus(field, 'invalid', removeMsgs);
    }

    /**
     * Получить фидбэк поля
     * 
     * @param {*} field 
     * @param {*} status 
     * @returns 
     */
    this.getFieldFeedback = (field, status) => {
        let parent = this.getFieldParent(field);
        if (!parent) return null;

        return parent.querySelector(`.${status}-feedback`);
    }

    /**
     * Добавить сообщения в фидбэк поля
     * 
     * @param {*} field 
     * @param {*} messages 
     * @param {*} status 
     * @returns 
     */
    this.addFieldMessages = (field, messages, status) => {
        let feedback = this.getFieldFeedback(field, status);
        if (!feedback) return;
  
        feedback.innerHTML = '';
        for (let i in messages) {
            feedback.insertAdjacentHTML('BEFOREEND', `<div>${messages[i]}</div>`);
        }
    }

    /**
     * Удалить сообщения поля
     * 
     * @param {*} field 
     * @param {*} status 
     */
    this.removeFieldMessages = (field, status) => {
        let feedback = this.getFieldFeedback(field, status);
        if (feedback) feedback.innerHTML = '';
    }
 
    /**
     * Сброс всех сохраненных ошибок
     * 
     * @returns
     */
    this.resetErrors = () => {
        for (let name in form_errors) {
            let field = this.getField(name);
            if (!field) continue;

            this.removeFieldStatusInvalid(field);
        }

        form_errors = {};
    }

    /**
     * Установить ошибки полям и сохранить их
     * 
     * @param {*} errors 
     */
    this.setErrors = (errors) => {
        for (let name in errors) { 
            let field = this.getField(name);
            if (!field) continue;

            this.setFieldStatusInvalid(field, errors[name]);

            form_errors[name] = {
                msgs: errors[name],
                field
            }
        }

        for (let name in form_errors) {
            let obj = form_errors[name];

            obj.field.addEventListener('input', () => {
                this.removeFieldStatusInvalid(obj.field);
            }, false);
        }
    }

    return this;
}