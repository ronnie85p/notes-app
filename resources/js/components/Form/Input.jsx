import Feedback from "./Feedback";

const Input = (props) => {
    const { error, feedbackProps, type = "text", className = "" } = props;

    return (
        <>
            <input
                {...props}
                type={type}
                className={`form-control ${className}${
                    error ? " is-invalid" : ""
                }`}
            />

            {error ? (
                <Feedback type="invalid" {...feedbackProps}>
                    {error}
                </Feedback>
            ) : (
                <></>
            )}
        </>
    );
};

Input.Password = (props) => {
    return <Input {...props} type="password" />;
};

export default Input;
