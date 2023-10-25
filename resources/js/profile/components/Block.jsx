const Block = (props) => {
    const { title, children } = props;

    return (
        <>
            <div className="h5">{title}</div>

            {children}
        </>
    );
};

export default Block;
