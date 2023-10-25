const Label = (props) => {
    const { children, text = "" } = props;
    return <label {...props}>{text ? text : children}</label>;
};

export default Label;
