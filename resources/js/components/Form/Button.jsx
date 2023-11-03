const Button = (props) => {
    const { children, design = "default", className = "" } = props;

    return (
        <>
            <button
                type="button"
                {...props}
                className={`btn btn-${design} ${className}`}
            >
                {children}
            </button>
        </>
    );
};

export default Button;
