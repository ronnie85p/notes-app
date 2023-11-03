const Message = (props) => {
    const {
        children,
        className = "",
        design = "default",
        visible = false,
    } = props;

    return (
        <>
            {visible ? (
                <>
                    <div className={`alert alert-${design} ${className}`}>
                        {children}
                    </div>
                </>
            ) : (
                <></>
            )}
        </>
    );
};

export default Message;
