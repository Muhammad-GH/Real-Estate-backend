import React, { Component } from "react";
import axios from "axios";
import { Helper, url } from "../../../helper/helper";

export default class SendInvoice extends Component {
  state = {
    email: "",
  };

  handleChange = (event) => {
    const { name, value } = event.target;
    this.setState({ [name]: value });
  };

  handleSubmit = async (event) => {
    event.preventDefault();

    const token = await localStorage.getItem("token");
    const data = new FormData();
    data.set("email", this.state.email);
    data.set("invoice", this.props.pdf);
    axios
      .post(`${url}/api/invoice/send`, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((res) => {
        alert("Sent!!");
      })
      .catch((err) => {
        alert("Failed");
      });
  };

  render() {
    return (
      <div>
        <div
          className="modal fade"
          id="send-invoice"
          tabIndex="-1"
          role="dialog"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div className="modal-dialog modal-lg modal-dialog-centered">
            <div className="modal-content">
              <div className="modal-body">
                <div className="row">
                  <div className="col-md-11">
                    <div className="form-group mb-5">
                      <div className="profile flex">
                        <div className="content">
                          <h4>Enter a email Address</h4>
                        </div>
                      </div>
                    </div>
                    <div className="form-group ">
                      <input
                        className="form-control"
                        placeholder="Email"
                        name="email"
                        onChange={this.handleChange}
                      />
                    </div>
                    <button
                      type="button"
                      onClick={this.handleSubmit}
                      className="btn btn-outline-dark mt-3"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      Save
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}
