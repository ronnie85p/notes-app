import { useState } from "react";

const useData = () => {
    const [values, setValues] = useState(null);

    return { values, setValues };
};

export { useData };
