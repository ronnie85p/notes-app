const Header = (props) => {
    const { children, className } = props;
    return (
        <div {...props} className={`card-header ${className}`}>
            {children}
        </div>
    );
};

export default Header;
