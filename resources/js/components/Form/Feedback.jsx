const Feedback = (props) => {
    const { children, type = "invalid", className = "" } = props;

    return (
        <div {...props} className={`${type}-feedback ${className}`}>
            {children}
        </div>
    );
};

export default Feedback;
