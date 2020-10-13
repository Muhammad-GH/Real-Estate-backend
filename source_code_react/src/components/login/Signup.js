import React, { Component } from "react";
import EmailId from "../marketPlace/EmailId";
import Button from "../shared/Button";
import Logo from "../../images/logo.png";
import axios from "axios";
import { Helper, url } from "../../helper/helper";
import Alert from "react-bootstrap/Alert";
import { withTranslation } from "react-i18next";
import Spinner from "react-bootstrap/Spinner";

class Signup extends Component {
  state = {
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
    password: "",
    c_password: "",
    subtype: "",
    errors: [],
    show_errors: false,
    status: null,
    loading: false,
  };

  handleChange1 = (event) => {
    this.setState({ first_name: event.target.value });
  };
  handleChange2 = (event) => {
    this.setState({ last_name: event.target.value });
  };
  handleChange3 = (event) => {
    this.setState({ email: event.target.value });
  };
  handleChange4 = (event) => {
    this.setState({ phone: event.target.value });
  };
  handleChange5 = (event) => {
    this.setState({ password: event.target.value });
  };
  handleChange6 = (event) => {
    this.setState({ c_password: event.target.value });
  };
  handleChange7 = (event) => {
    this.setState({ subtype: event.target.value });
  };

  handleSubmit = (event) => {
    event.preventDefault();
    this.setState({ status: null, show_errors: false });

    if (this.state.password !== this.state.c_password) {
      const { t } = this.props;
      return this.setState({ errors: t("success.pass_mat") });
    }
    this.setState({ loading: true });
    axios
      .post(`${url}/api/register?`, {
        first_name: this.state.first_name,
        last_name: this.state.last_name,
        email: this.state.email,
        phone: this.state.phone,
        password: this.state.password,
        c_password: this.state.c_password,
        subtype: this.state.subtype,
      })
      .then((res) => {
        this.setState({ loading: false });
        const { history } = this.props;
        history.push("/");
      })
      .catch((err) => {
        console.log(err.response);
        if (err.response.status === 401) {
          const { t } = this.props;
          this.setState({ errors: t("success.all_fields_are_required") });
        }
        if (err.response.status === 500) {
          this.setState({ status: 500 });
        }
        this.setState({ show_errors: true, loading: false });
      });
  };

  render() {
    const { t, i18n } = this.props;

    let alert, loading;
    if (this.state.show_errors === true) {
      alert = (
        <div style={{ paddingTop: "10px" }}>
          <Alert variant="danger" style={{ fontSize: "13px" }}>
            {this.state.errors}
          </Alert>
        </div>
      );
    }
    if (this.state.status === 500) {
      alert = (
        <div style={{ paddingTop: "10px" }}>
          <Alert variant="danger" style={{ fontSize: "13px" }}>
            {t("success.unique")}
          </Alert>
        </div>
      );
    }
    if (this.state.loading === true) {
      loading = (
        <Spinner animation="border" role="status">
          <span className="sr-only">Loading...</span>
        </Spinner>
      );
    }

    return (
      <div className="login-page">
        <div className="content">
          <div className="logo">
            <img src={Logo} />
          </div>
          <div className="card" style={{ marginTop: "-10%" }}>
            <div className="card-body">
              <div className="head">
                <h3>{t("login.welcome")}</h3>
                <p>{t("login.tag")}</p>
              </div>
              <form onSubmit={this.handleSubmit}>
                <div className="form-group">
                  <input
                    onChange={this.handleChange1}
                    className="form-control"
                    name="first_name"
                    type="text"
                    placeholder="First Name"
                  />
                </div>
                <div className="form-group">
                  <input
                    onChange={this.handleChange2}
                    className="form-control"
                    name="last_name"
                    type="text"
                    placeholder="Last Name"
                  />
                </div>
                <div className="form-group">
                  {/* <EmailId /> */}
                  <input
                    className="form-control"
                    onChange={this.handleChange3}
                    name="email"
                    type="email"
                    placeholder="Email id"
                  />
                  <div className="invalid-feedback">
                    Please provide a valid email.
                  </div>
                </div>
                <div className="form-group">
                  <input
                    onChange={this.handleChange4}
                    className="form-control"
                    type="phone"
                    name="phone"
                    placeholder="Phone no"
                  />
                </div>
                <div className="form-group">
                  <input
                    onChange={this.handleChange5}
                    className="form-control"
                    type="password"
                    name="password"
                    placeholder="Password"
                  />
                  <span class="icon-eye show-pwd"></span>
                </div>
                <div className="form-group">
                  <input
                    onChange={this.handleChange6}
                    className="form-control"
                    type="password"
                    name="c_password"
                    placeholder="Confirm Password"
                  />
                </div>
                <h4 className="text-center">{t("login.are_you")}</h4>
                <div className="form-group">
                  <select
                    onChange={this.handleChange7}
                    name="subtype"
                    value={this.state.subtype}
                    className="form-control"
                  >
                    <option value="">--Select--</option>
                    <option value="Service Provider">Service Provider </option>
                    <option value="Provider item">Provider item</option>
                  </select>
                </div>
                {loading ? loading : <Button title="Register" />}
                {alert ? alert : null}
              </form>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default withTranslation()(Signup);
