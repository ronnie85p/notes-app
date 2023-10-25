import Label from "./Label";

const Checkbox = (props) => {
    const { label, error, className = "" } = props;
    return (
        <>
            <input
                {...props}
                className={`${className}${error ? " is-invalid" : ""}`}
                type="checkbox"
                value="1"
            />

            {label ? <Label htmlFor={props.id}>{label}</Label> : <></>}
        </>
    );
};

export default Checkbox;
