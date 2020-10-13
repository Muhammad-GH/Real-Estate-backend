import React, { Component } from "react";
import Button from "../shared/Button";
import Logo from "../../images/logo.png";
import axios from "axios";
import { HashRouter as Router, Link, Redirect } from "react-router-dom";
import { Helper, url } from "../../helper/helper";
import Alert from "react-bootstrap/Alert";
import { withTranslation } from "react-i18next";

class Login extends Component {
  constructor(props) {
    super(props);
    const token = localStorage.getItem("token");
    console.log(token);
    let loggedIn = true;

    if (token == null) {
      loggedIn = false;
    }
    this.state = {
      loggedIn,
    };
  }

  state = {
    email: "",
    password: "",
    err: "",
    loggedIn: false,
  };

  handleChange1 = (event) => {
    this.setState({ email: event.target.value });
  };
  handleChange2 = (event) => {
    this.setState({ password: event.target.value });
  };

  handleSubmit = (event) => {
    event.preventDefault();

    if (!this.state.email || !this.state.password) {
      const { t } = this.props;
      return this.setState({ err: t("success.all_fields_are_required") });
    }

    const creds = {
      email: this.state.email,
      password: this.state.password,
    };
    const { history } = this.props;
    console.log(creds);

    axios
      .post(`${url}/api/login?email=${creds.email}&password=${creds.password}`)
      .then((res) => {
        console.log(res.data.success.token);
        localStorage.setItem("token", res.data.success.token);
        history.push("/feeds");
      })
      .catch((err) => {
        const { t } = this.props;
        this.setState({ err: t("success.authentication_failed") });
        console.log(err.response);
      });
  };
  render() {
    const { t, i18n } = this.props;

    if (this.state.loggedIn === true) {
      return <Redirect to="/index" />;
    }

    let alert;
    if (this.state.err) {
      alert = (
        <div style={{ paddingTop: "10px" }}>
          <Alert variant="danger" style={{ fontSize: "15px" }}>
            {this.state.err}
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
          <div className="card" style={{ marginTop: "-10%" }}>
            <div className="card-body">
              <div className="head">
                <h3>{t("login.welcome")}</h3>
                <h4>{t("login.login")}</h4>
              </div>
              <form onSubmit={this.handleSubmit}>
                <div className="form-group">
                  <input
                    className="form-control"
                    onChange={this.handleChange1}
                    name="email"
                    type="email"
                    placeholder="Email id"
                  />

                  <div className="invalid-feedback">
                    Please provide valid crede.
                  </div>
                </div>
                <div className="form-group">
                  <input
                    className="form-control"
                    onChange={this.handleChange2}
                    name="password"
                    type="password"
                    placeholder="Password"
                  />
                </div>
                <Button title="Sign in" />
                {alert ? alert : null}
              </form>

              <Link className="back-link" to="/forgot">
                {t("login.for_msg")}
              </Link>
            </div>
          </div>

          <div className="info">
            <p className="text-center">
              {t("login.reg_msg")}
              <Link className="btn btn-outline-blue" to="/register">
                {t("login.get_started")}
              </Link>
            </p>
          </div>
        </div>
      </div>
    );
  }
}

export default withTranslation()(Login);
