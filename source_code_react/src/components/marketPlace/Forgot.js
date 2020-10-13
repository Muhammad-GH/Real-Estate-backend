import React, { Component } from "react";
import Button from "../shared/Button";
import Logo from "../../images/logo.png";
import axios from "axios";
import { Helper, url } from "../../helper/helper";
import { HashRouter as Router, Link } from "react-router-dom";
import Alert from "react-bootstrap/Alert";
import { withTranslation } from "react-i18next";

class Forgot extends Component {
  state = {
    email: "",
    errors: "",
    show_errors: false,
    show_msg: false,
  };

  handleChange = (event) => {
    this.setState({ email: event.target.value });
  };

  handleSubmit = (event) => {
    event.preventDefault();
    const { t } = this.props;
    if (!this.state.email)
      this.setState({ errors: t("success.all_fields_are_required") });

    const email = {
      email: this.state.email,
    };
    axios
      .post(`${url}/api/password/email?`, { email: email.email })
      .then((res) => {
        this.setState({ show_msg: true });
      })
      .catch((err) => {
        const { t } = this.props;
        this.setState({
          show_errors: true,
          errors: t("success.email_not_found"),
        });
        console.log(err);
      });
  };

  render() {
    const { t, i18n } = this.props;

    let alert;
    if (this.state.show_errors === true) {
      alert = (
        <div style={{ paddingTop: "10px" }}>
          <Alert variant="danger" style={{ fontSize: "13px" }}>
            {this.state.errors}
          </Alert>
        </div>
      );
    }
    if (this.state.show_msg === true) {
      alert = (
        <div style={{ paddingTop: "10px" }}>
          {" "}
          <Alert variant="success" style={{ fontSize: "13px" }}>
            Email sent!
          </Alert>
        </div>
      );
    }

    return (
      <div className="login-page">
        <div className="content">
          <div className="logo">
            <img src={Logo} alt="" />
          </div>
          <div className="card">
            <div className="card-body">
              <div className="head">
                <h3>{t("login.for_msg")}</h3>
              </div>
              <form onSubmit={this.handleSubmit}>
                <div className="form-group">
                  {/* <EmailId /> */}
                  <input
                    className="form-control"
                    onChange={this.handleChange}
                    name="email"
                    type="email"
                    placeholder="Email id"
                  />
                  <div className="invalid-feedback">
                    Please provide a valid email.
                  </div>
                </div>
                <Button title="Reset" />
                {alert ? alert : null}
              </form>
              <Link className="back-link" to="/">
                {t("login.back_msg")}
              </Link>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default withTranslation()(Forgot);
