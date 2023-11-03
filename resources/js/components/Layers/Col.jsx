const Col = (props) => {
    const { children, col = "", className = "" } = props;
    const _col = col ? `-${col}` : "";
    return (
        <div {...props} className={`col${_col} ${className}`}>
            {children}
        </div>
    );
};

export default Col;
