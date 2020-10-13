import React, { Component } from "react";
import Button from "../shared/Button";
import Logo from "../../images/logo.png";
import axios from "axios";
import { Helper, url } from "../../helper/helper";
import Alert from "react-bootstrap/Alert";

class Reset extends Component {
  state = {
    email: "",
    password: "",
    password_confirmation: "",
    status: null,
  };

  handleChange = (event) => {
    const { name, value } = event.target;
    this.setState({ [name]: value });
  };

  handleSubmit = (event) => {
    event.preventDefault();

    if (this.state.password !== this.state.password_confirmation) {
      return alert(`passwords don't match`);
    }

    const data = new FormData();
    data.set("email", this.state.email);
    data.set("token", this.props.match.params.token);
    data.set("password", this.state.password);
    data.set("password_confirmation", this.state.password_confirmation);

    axios
      .post(`${url}/api/password/reset`, data)
      .then((res) => {
        this.props.history.push("/");
      })
      .catch((err) => {
        console.log(err);
        this.setState({ status: 422 });
      });

    for (var pair of data.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
  };

  render() {
    let alert;
    if (this.state.status === 422) {
      alert = (
        <Alert variant="danger" style={{ fontSize: "13px" }}>
          Please try again...
        </Alert>
      );
    }

    return (
      <div className="login-page">
        <div className="content">
          <div className="logo">
            <img src={Logo} alt="logo" />
          </div>
          <div className="card">
            <div className="card-body">
              <div className="head">
                <h3>Reset password</h3>
              </div>
              <form onSubmit={this.handleSubmit}>
                <div className="form-group">
                  <input
                    className="form-control"
                    onChange={this.handleChange}
                    name="email"
                    type="email"
                    placeholder="Email id"
                    required
                  />
                </div>
                <div className="form-group">
                  <input
                    className="form-control"
                    onChange={this.handleChange}
                    name="password"
                    type="password"
                    placeholder="password"
                    required
                  />
                </div>
                <div className="form-group">
                  <input
                    className="form-control"
                    onChange={this.handleChange}
                    name="password_confirmation"
                    type="password"
                    placeholder="confirm password"
                    required
                  />
                </div>
                <Button title="Reset" />
                <div style={{ fontSize: "13px", marginTop: "15px" }}>
                  {alert ? alert : null}
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default Reset;
