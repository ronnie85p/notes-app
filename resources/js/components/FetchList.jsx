const FetchList = (props) => {
    const { list = [], Item = (item, i) => <></>, Empty = <></> } = props;

    return list.length ? list.map(Item) : Empty;
};

export default FetchList;
