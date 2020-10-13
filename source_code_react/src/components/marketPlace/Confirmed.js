import React from "react";
import Logo from "../../images/logo.png";
import { Link } from "react-router-dom";

function Confirmed() {
  return (
    <div className="login-page">
      <div className="content">
        <div className="logo">
          <img src={Logo} alt="logo" />
        </div>
        <div className="card">
          <div className="card-body">
            <div className="head">
              <h3>Thanks for confirmation</h3>
            </div>
            <Link className="back-link" to="/">
              back to login
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Confirmed;
