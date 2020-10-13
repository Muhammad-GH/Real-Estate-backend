import React from "react";
import ReactDOM from "react-dom";
import App from "./App";

import "bootstrap/dist/css/bootstrap.min.css";
// import 'jquery/dist/jquery.min.js'
import "bootstrap/dist/js/bootstrap.min.js";
import "react-datetime/css/react-datetime.css";
import "./js/custom";
import "./js/jquery.multiselect";
import "./locales/i18n";

ReactDOM.render(<App />, document.getElementById("root"));
