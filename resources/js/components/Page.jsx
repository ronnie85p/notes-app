import Header from "./Page/Header";
import Footer from "./Page/Footer";
import Content from "./Page/Content";

const Page = ({ children }) => {
    return <main className="page">{children}</main>;
};

const Wrapper = (props) => {
    const { children } = props;

    return (
        <Page>
            <Header></Header>
            <Content>{children}</Content>
            <Footer></Footer>
        </Page>
    );
};

Page.Header = Header;
Page.Footer = Footer;
Page.Content = Content;
Page.Wrapper = Wrapper;

export default Page;
export { Header, Footer, Content };
