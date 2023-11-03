import Header from "./Card/Header";
import Body from "./Card/Body";
import Footer from "./Card/Footer";

const Card = (props) => {
    const { children, className } = props;
    return (
        <div {...props} className={`card ${className}`}>
            {children}
        </div>
    );
};

Card.Header = Header;
Card.Body = Body;
Card.Footer = Footer;

export default Card;
export { Header, Body, Footer };
