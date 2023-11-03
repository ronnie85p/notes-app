const Group = (props) => {
    const { children } = props;

    return (
        <>
            <div className="mb-3" {...props}>
                {children}
            </div>
        </>
    );
};

export default Group;
