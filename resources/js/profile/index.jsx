import "../bootstrap";
import { createRoot } from "react-dom/client";
import App from "./App";

const root = createRoot(document.getElementById("profile"));
root.render(<App />);
