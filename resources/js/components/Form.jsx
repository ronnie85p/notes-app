import { useRequest } from "./request";
import Button from "./Form/Button";
import Input from "./Form/Input";
import Checkbox from "./Form/Checkbox";
import Feedback from "./Form/Feedback";
import Group from "./Form/Group";
import Message from "./Form/Message";
import Label from "./Form/Label";

const shadowStyle = {
    position: "absolute",
    top: 0,
    bottom: 0,
    right: 0,
    left: 0,
    zIndex: 111,
    backgroundColor: "rgba(255,255,255, .4)",
};

const formStyle = {
    position: "relative",
};

const useForm = (props) => {
    const { onSubmit, onSuccess, onFailure, onDone } = props;
    const request = useRequest({
        method: "POST",
        contentType: "multipart/form-data",
        url: props.action,
        ...props,
    });

    const submit = (form) => {
        const data = new FormData(form);
        if (onSubmit && onSubmit({ data, request }) === false) {
            return false;
        }

        request
            .send(new FormData(form))
            .then((response) => {
                onSuccess && onSuccess(response.data, response);

                return response;
            })
            .catch(onFailure)
            .finally(onDone);
    };

    return {
        submit,
        ...{
            isSubmitting: request.isSending,
            errors: request.errors,
            message: request.error?.message,
        },
    };
};

const Form = (props) => {
    const {
        children,
        disabled,
        onSubmit,
        onKeyDown,
        onFocus,
        preventDefault = true,
        preventEnterSubmit = false,
    } = props;

    const _handleSubmit = (e) => {
        if (preventDefault) {
            e.preventDefault();
        }

        onSubmit && onSubmit(e);
    };

    const _handleKeyDown = (e) => {
        if (preventEnterSubmit) {
            if (e.keyCode === 13) {
                e.preventDefault();
            }
        }

        onKeyDown && onKeyDown(e);
    };

    const _handleFocus = (e) => {
        e.target.classList.remove("is-invalid", "is-valid");
        onFocus && onFocus(e);
    };

    return (
        <>
            <form
                style={formStyle}
                onSubmit={_handleSubmit}
                onKeyDown={_handleKeyDown}
                onFocus={_handleFocus}
            >
                {disabled ? <div style={shadowStyle}></div> : <></>}
                {children}
            </form>
        </>
    );
};

Form.Button = Button;
Form.Input = Input;
Form.Checkbox = Checkbox;
Form.Feedback = Feedback;
Form.Group = Group;
Form.Message = Message;

export default Form;
export {
    Button,
    Input,
    Checkbox,
    Feedback,
    Group,
    Label,
    Message,
    Form,
    useForm,
};
