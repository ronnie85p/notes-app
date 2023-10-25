const Body = (props) => {
    const { children, className } = props;
    return (
        <div {...props} className={`card-body ${className}`}>
            {children}
        </div>
    );
};

export default Body;
