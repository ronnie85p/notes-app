import { useState, useEffect } from "react";
import axios from "axios";

const useRequest = (props) => {
    const options = {
        method: "GET",
        responseType: "json",
        headers: {
            "Content-Type": props.contentType || "application/json",
            "X-CSRF-TOKEN": document
                .querySelector("meta[name='csrf-token']")
                ?.getAttribute("content"),
        },
        ...props,
    };

    // const [options, setOptions] = useState({
    //     method: "GET",
    //     responseType: "json",
    //     headers: {
    //         "Content-Type": props.contentType || "application/json",
    //         "X-CSRF-TOKEN": document
    //             .querySelector("meta[name='csrf-token']")
    //             ?.getAttribute("content"),
    //     },
    //     ...props,
    // });
    const [response, setResponse] = useState(null);
    const [error, setError] = useState(null);
    const [errors, setErrors] = useState({});
    const [isSending, setIsSending] = useState(0);

    const send = (data) => {
        setIsSending(1);
        setErrors({});
        setError(null);
        return axios({ ...options, data })
            .then((_response) => {
                setResponse(_response);

                if (_response.data?.result?.url) {
                    window.location.href = _response.data?.result?.url;
                }

                return _response;
            })
            .catch((_error) => {
                const data = _error.response?.data;

                if (data) {
                    if (data.message) {
                        _error.message = data.message;
                    }

                    if (data.errors) {
                        const errors = [];
                        for (let k in data.errors) {
                            errors[k] = data.errors[k][0];
                        }

                        setErrors(errors);
                    }
                }

                setError(_error);
            })
            .finally(() => setIsSending(0));
    };

    useEffect(() => {
        // etc...
    }, []);

    return { response, error, errors, isSending, send };
};

const FetchRequest = (props) => {
    const { request, children, Fallback, Error } = props;

    useEffect(() => {
        request.send();
    }, []);

    if (request.isSending) {
        return Fallback ? Fallback : <></>;
    }

    if (request.error) {
        return Error ? Error(request.error) : <></>;
    }

    return <>{children}</>;
};

const getResponse = (request, key = "") => {
    if (request.response) {
        return key ? request.response[key] : request.response;
    }

    return {};
};

export { useRequest, FetchRequest, getResponse };
