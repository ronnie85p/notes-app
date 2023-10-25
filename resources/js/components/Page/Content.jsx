const Content = ({ children }) => {
    return (
        <section
            className="page-content"
            style={{ backgroundColor: "#f4f6f9" }}
        >
            {children}
        </section>
    );
};

export default Content;
